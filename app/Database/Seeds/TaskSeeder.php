<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\TaskModel; // Import your TaskModel
use App\Models\ProjectModel; // To get project IDs
use App\Models\UserModel;    // To get employee IDs

class TaskSeeder extends Seeder
{
    public function run()
    {
        $taskModel = new TaskModel();
        $projectModel = new ProjectModel();
        $userModel = new UserModel();

        // Get existing project IDs and employee IDs
        $projectIds = array_column($projectModel->findAll(), 'id');
        // Assuming role_id 2 are employees
        $employeeIds = array_column($userModel->where('role_id', 2)->findAll(), 'id');

        // Ensure we have at least one project and one employee
        if (empty($projectIds) || empty($employeeIds)) {
            echo "Skipping TaskSeeder: No projects or employees found. Please ensure ProjectSeeder and UserSeeder run first and create data.\n";
            return;
        }

        $tasks = [
            [
                'project_id'  => $projectIds[array_rand($projectIds)], // Random project
                'title'       => 'Design Homepage Layout',
                'description' => 'Create wireframes and high-fidelity mockups for the new website homepage.',
                'remarks'     => 'Focus on modern UI trends.',
                'file'        => '',
                'priority'    => 'High',
                'status'      => 'In Progress',
                'assigned_to' => $employeeIds[array_rand($employeeIds)], // Random employee
                'created_at'  => date('Y-m-d H:i:s', strtotime('-2 weeks')),
                'updated_at'  => date('Y-m-d H:i:s', strtotime('-1 week')),
            ],
            [
                'project_id'  => $projectIds[array_rand($projectIds)],
                'title'       => 'Backend API Integration',
                'description' => 'Integrate new user authentication API endpoints with the mobile application.',
                'remarks'     => '',
                'file'        => '',
                'priority'    => 'High',
                'status'      => 'Pending',
                'assigned_to' => $employeeIds[array_rand($employeeIds)],
                'created_at'  => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at'  => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'project_id'  => $projectIds[array_rand($projectIds)],
                'title'       => 'Perform Regression Testing',
                'description' => 'Execute full regression test suite for the HR system after the recent patch.',
                'remarks'     => 'Document all failures with screenshots.',
                'file'        => '',
                'priority'    => 'Medium',
                'status'      => 'Completed',
                'assigned_to' => $employeeIds[array_rand($employeeIds)],
                'created_at'  => date('Y-m-d H:i:s', strtotime('-1 month')),
                'updated_at'  => date('Y-m-d H:i:s', strtotime('-3 weeks')),
            ],
            [
                'project_id'  => $projectIds[array_rand($projectIds)],
                'title'       => 'Develop User Profile Page',
                'description' => 'Implement frontend and backend for user profile page, including data display and update.',
                'remarks'     => '',
                'file'        => '',
                'priority'    => 'Medium',
                'status'      => 'In Progress',
                'assigned_to' => $employeeIds[array_rand($employeeIds)],
                'created_at'  => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at'  => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
        ];

        foreach ($tasks as $taskData) {
            $taskModel->insert($taskData);
        }
    }
}