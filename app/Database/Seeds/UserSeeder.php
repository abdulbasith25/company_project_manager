<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel; // Import your UserModel

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        // Sample users matching your schema and roles
        $users = [
            [
                'name'      => 'Admin User',
                'email'     => 'admin@example.com',
                'phone'     => '111-222-3333',
                'password'  => 'admin123', // IMPORTANT: No hashing as per request. NOT secure for production!
                'role_id'   => 1, // Admin role
                'status'    => 1, // Active
                'created_at' => date('Y-m-d H:i:s'), // Explicitly set for seeding
            ],
            [
                'name'      => 'Employee One',
                'email'     => 'employee1@example.com',
                'phone'     => '444-555-6666',
                'password'  => 'employee123', // IMPORTANT: No hashing as per request. NOT secure for production!
                'role_id'   => 2, // Employee role
                'status'    => 1, // Active
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'      => 'Employee Two',
                'email'     => 'employee2@example.com',
                'phone'     => '777-888-9999',
                'password'  => 'employee123', // IMPORTANT: No hashing as per request. NOT secure for production!
                'role_id'   => 2, // Employee role
                'status'    => 1, // Active
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'      => 'HR User',
                'email'     => 'hr@example.com',
                'phone'     => '000-111-2222',
                'password'  => 'hr123', // IMPORTANT: No hashing as per request. NOT secure for production!
                'role_id'   => 3, // HR role
                'status'    => 1, // Active
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Disable timestamping in model for seeding if it causes issues,
        // or ensure `created_at` is in $allowedFields and useTimestamps is enabled.
        // For direct insertion via insertBatch on DB facade, model settings are bypassed.
        // For Model->insert(), ensure `created_at` is in `$allowedFields` and
        // that `useTimestamps = true` or you manually provide it.
        // Given your previous issues, explicitly providing `created_at` here for seeding is safest.

        foreach ($users as $userData) {
            $userModel->insert($userData);
        }

        $this->call('ProjectSeeder'); // Call ProjectSeeder after users
    }
}