<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ProjectModel; // Import your ProjectModel

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projectModel = new ProjectModel();

        $projects = [
            [
                'title'       => 'Website Redesign',
                'description' => 'Complete overhaul of the company website\'s design and user experience. Focus on modern aesthetics and mobile responsiveness.',
                'created_at'  => date('Y-m-d H:i:s', strtotime('-1 month')), // Example: created 1 month ago
            ],
            [
                'title'       => 'Mobile App Development (iOS & Android)',
                'description' => 'Development of a new cross-platform mobile application to complement existing services. Includes feature set definition and UI/UX design.',
                'created_at'  => date('Y-m-d H:i:s', strtotime('-2 weeks')), // Example: created 2 weeks ago
            ],
            [
                'title'       => 'Internal HR System Upgrade',
                'description' => 'Upgrade and modernization of the internal HR management system to streamline payroll, leave management, and employee records.',
                'created_at'  => date('Y-m-d H:i:s', strtotime('-3 months')),
            ],
            [
                'title'       => 'CRM Integration Project',
                'description' => 'Integration of new CRM software with existing sales and customer support tools to improve lead tracking and customer interaction.',
                'created_at'  => date('Y-m-d H:i:s', strtotime('-1 week')),
            ],
        ];

        foreach ($projects as $projectData) {
            $projectModel->insert($projectData);
        }

        $this->call('TaskSeeder'); // Call TaskSeeder after projects
    }
}