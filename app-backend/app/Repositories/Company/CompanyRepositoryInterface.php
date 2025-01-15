<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface CompanyRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Company $model);
}
