<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyAssetModel extends Model
{
    protected $table            = 'CompanyAsset';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'user_id',
        'total_assets',
        'assets_assigned',
        'assets_remaining',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'user_id'           => 'required|integer',
        'total_assets'      => 'permit_empty|integer',
        'assets_assigned'   => 'permit_empty|integer',
        'assets_remaining'  => 'permit_empty|integer',
    ];

    protected $validationMessages = [];

    protected $skipValidation = false;
}