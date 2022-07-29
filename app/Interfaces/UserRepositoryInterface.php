<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function me(string $id);

    public function update(string $id, array $params);

    public function getUserByEmail(string $email);
}
