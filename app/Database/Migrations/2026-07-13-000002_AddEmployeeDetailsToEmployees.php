<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmployeeDetailsToEmployees extends Migration
{
    public function up(): void
    {
        // Older projects may have created `employees` without these columns.
        if (!$this->db->tableExists('employees')) {
            return;
        }

        $fields = [];

        if (!$this->db->fieldExists('employee_name', 'employees')) {
            $fields['employee_name'] = [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
                'after' => 'user_id',
            ];
        }

        if (!$this->db->fieldExists('email', 'employees')) {
            $fields['email'] = [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
                'after' => 'designation',
            ];
        }

        if (!$this->db->fieldExists('phone', 'employees')) {
            $fields['phone'] = [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
                'after' => 'email',
            ];
        }

        if (!$this->db->fieldExists('photo', 'employees')) {
            $fields['photo'] = [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'phone',
            ];
        }

        if ($fields !== []) {
            $this->forge->addColumn('employees', $fields);
        }
    }

    public function down(): void
    {
        if (!$this->db->tableExists('employees')) {
            return;
        }

        $toDrop = [];
        foreach (['employee_name', 'email', 'phone', 'photo'] as $field) {
            if ($this->db->fieldExists($field, 'employees')) {
                $toDrop[] = $field;
            }
        }

        if ($toDrop !== []) {
            $this->forge->dropColumn('employees', $toDrop);
        }
    }
}

