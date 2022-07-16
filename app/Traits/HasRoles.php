<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\UserHasRole;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait HasRoles
{
    public static function scopeRole(Builder $query, ...$roles): Builder
    {
        $roles = collect($roles)->flatten()->reduce(function ($array, $role) {
            if (empty($role)) {
                return $array;
            }

            $role = Role::whereName($role)->first();
            if (! $role instanceof Role) {
                return $array;
            }

            $array[] = $role->getKey();

            return $array;
        });

        return $query->whereHas('roles', function (Builder $subQuery) use ($roles) {
            $subQuery->whereIn('role_id', $roles);
        });
    }

    public function hasRole(string $role): bool
    {
        $roles = $this->getRoleNames();

        return in_array($role, $roles);
    }

    public function hasAnyRole(...$roles): bool
    {
        $user_roles = $this->getRoleNames();

        $result = array_intersect($roles, $user_roles);

        return count($result) > 0;
    }

    public function getKeyRoles(...$roles): array
    {
        $roles = collect($roles)->flatten()->reduce(function ($array, $role) {
            if (empty($role)) {
                return $array;
            }

            $role = $this->getStoredRole($role);
            if (! $role instanceof Role) {
                return $array;
            }

            $array[] = $role->getKey();

            return $array;
        });

        return (array) $roles;
    }

    public function roles(): HasMany
    {
        return $this->hasMany(UserHasRole::class);
    }

    public function getRoleNames(): array
    {
        $user = $this->load('roles');

        $roleNames = [];

        foreach ($user->roles as $role) {
            $role = $this->getStoredRole($role->role_id);
            if (! $role instanceof Role) {
                continue;
            }

            $roleNames[] = $role->name;
        }

        return $roleNames;
    }

    public function assignRole(...$roles): bool
    {
        $roles = $this->getKeyRoles($roles);

        $transactions = $this->syncRoles((array) $roles);

        return $transactions ?? false;
    }

    public function getStoredRole($role): Role
    {
        $query = Role::query();

        Str::isUuid($role) ? $query->where('id', $role) : $query->whereName($role);

        $role = $query->first();

        return $role;
    }

    public function syncRoles(array $roles): bool
    {
        DB::beginTransaction();

        UserHasRole::whereBelongsTo($this)->delete();

        collect($roles)->map(function ($role) {
            try {
                UserHasRole::create([
                    'user_id' => $this->id,
                    'role_id' => $role,
                ]);
            } catch (Exception $err) {
                DB::rollBack();
            }
        });

        DB::commit();

        return UserHasRole::whereBelongsTo($this)->count() === count($roles);
    }
}
