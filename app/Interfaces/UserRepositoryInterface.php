<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function me(string $id): User;

    public function update(string $id, array $params): bool;

    public function getUserByEmail(string $email): ?User;
}
