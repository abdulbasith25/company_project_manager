<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'title' => 'Admin'],
            ['id' => 2, 'title' => 'Employee'],
            ['id' => 3, 'title' => 'HR'],
        ];

        // Using query builder to insert data
        $this->db->table('roles')->insertBatch($roles);

        $this->call('UserSeeder'); // Call the UserSeeder after roles are created
    }
}