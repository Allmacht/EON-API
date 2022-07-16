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

    public function update(string $id, array $params)
    {
        User::find($id)->update($params);
    }
}
