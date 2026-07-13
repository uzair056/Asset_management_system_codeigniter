<?php

namespace App\Models;

use CodeIgniter\Model;

class AssetAssignment extends Model
{
    protected $table            = 'asset_assignments';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['employee_id', 'asset_id', 'assigned_at', 'returned_at', 'status', 'notes'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';
}
