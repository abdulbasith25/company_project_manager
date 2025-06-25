<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to prevent errors during insertion
        // This is important if you have relationships between your tables
        $this->db->disableForeignKeyChecks();

        // Call your seeders in the correct order based on dependencies
        // Roles must exist before users, and projects/users before tasks.
        $this->call('RoleSeeder');
        $this->call('UserSeeder');    // UserSeeder internally calls ProjectSeeder
        // ProjectSeeder internally calls TaskSeeder
        // If you did NOT chain them using $this->call() in individual seeders,
        // you would list them all here like:
        // $this->call('ProjectSeeder');
        // $this->call('TaskSeeder');

        // Re-enable foreign key checks after all seeding is done
        $this->db->enableForeignKeyChecks();

        echo "Database seeding complete!\n";
    }
}
