<?php

namespace App\Repositories\Client;

use App\Models\Client;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface ClientRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Client $model);
}
