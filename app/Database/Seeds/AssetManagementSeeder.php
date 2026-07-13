<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AssetManagementSeeder extends Seeder
{
    public function run(): void
    {
        $this->db->table('users')->insertBatch([
            [
                'name' => 'Admin Khan',
                'email' => 'admin@example.com',
                'password' => '123456',
                'role' => 'admin',
            ],
            [
                'name' => 'Ayesha Malik',
                'email' => 'ayesha@example.com',
                'password' => '123456',
                'role' => 'employee',
            ],
            [
                'name' => 'Bilal Hussain',
                'email' => 'bilal@example.com',
                'password' => '123456',
                'role' => 'employee',
            ],
        ]);

        $users = $this->db->table('users')->get()->getResultArray();
        $adminUserId = $users[0]['id'];

        $this->db->table('employees')->insertBatch([
            [
                'user_id' => $adminUserId,
                'employee_name' => 'Admin Khan',
                'department' => 'IT',
                'designation' => 'System Administrator',
                'email' => 'admin@example.com',
                'phone' => '03001234567',
            ],
            [
                'user_id' => $users[1]['id'],
                'employee_name' => 'Ayesha Malik',
                'department' => 'Design',
                'designation' => 'UI Designer',
                'email' => 'ayesha@example.com',
                'phone' => '03007654321',
            ],
            [
                'user_id' => $users[2]['id'],
                'employee_name' => 'Bilal Hussain',
                'department' => 'Finance',
                'designation' => 'Accountant',
                'email' => 'bilal@example.com',
                'phone' => '03009876543',
            ],
        ]);

        $employees = $this->db->table('employees')->get()->getResultArray();

        $this->db->table('assets')->insertBatch([
            ['name' => 'Laptop 14"', 'type' => 'Laptop', 'serial_number' => 'LT-1001', 'status' => 'assigned'],
            ['name' => 'Mouse', 'type' => 'Mouse', 'serial_number' => 'MS-2001', 'status' => 'available'],
            ['name' => 'Monitor 24"', 'type' => 'Monitor', 'serial_number' => 'MN-3001', 'status' => 'assigned'],
            ['name' => 'Phone', 'type' => 'Phone', 'serial_number' => 'PH-4001', 'status' => 'available'],
        ]);

        $assets = $this->db->table('assets')->get()->getResultArray();

        $this->db->table('asset_assignments')->insertBatch([
            [
                'employee_id' => $employees[1]['id'],
                'asset_id' => $assets[0]['id'],
                'assigned_at' => date('Y-m-d H:i:s'),
                'status' => 'assigned',
                'notes' => 'Laptop assigned for development work',
            ],
            [
                'employee_id' => $employees[2]['id'],
                'asset_id' => $assets[2]['id'],
                'assigned_at' => date('Y-m-d H:i:s'),
                'status' => 'returned',
                'returned_at' => date('Y-m-d H:i:s'),
                'notes' => 'Monitor returned after project completion',
            ],
        ]);
    }
}
