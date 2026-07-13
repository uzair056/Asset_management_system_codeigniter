<?php

namespace App\Models;

use CodeIgniter\Model;

class Asset extends Model
{
    protected $table            = 'assets';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['name', 'type', 'serial_number', 'status', 'purchase_date', 'notes'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';
}
