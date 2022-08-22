<?php

namespace App\Interfaces;

use App\Models\Client;

interface ClientRepositoryInterface
{
    public function store(array $params): Client;
}
