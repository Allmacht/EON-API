<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function me(string $id): User
    {
        return User::findOrfail($id);
    }

    public function update(string $id, array $params): bool
    {
        User::find($id)->update($params);

        return true;
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::whereEmail($email)->sole();
    }
}
