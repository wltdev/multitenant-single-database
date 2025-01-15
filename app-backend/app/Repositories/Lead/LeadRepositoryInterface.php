<?php

namespace App\Repositories\Lead;

use App\Models\Lead;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface LeadRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Lead $model);

    public function findByBoardColumnId($id);
    public function findAndUpdateByBoardColumnId(int $column_id, array $data);
}
