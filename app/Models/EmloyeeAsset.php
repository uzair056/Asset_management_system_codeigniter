<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeAssetModel extends Model
{
    protected $table            = 'EmployeeAsset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'asset_assigned',
        'asset_return',
        'department_id',
        'fine',
        'pending_fine',
        'reason_of_fine',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}