<?php

namespace App\Models;

use CodeIgniter\Model;

class Employee extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'user_id',
        'employee_name',
        'department',
        'designation',
        'email',
        'phone',
        'photo',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';
}