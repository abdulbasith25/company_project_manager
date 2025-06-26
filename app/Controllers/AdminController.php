<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\UserModel;
use App\Models\TaskModel;
use App\Models\RoleModel;

use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $projectModel;
    protected $userModel;
    protected $taskModel;
    protected $roleModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->userModel = new UserModel();
        $this->taskModel = new TaskModel();
        $this->roleModel = new RoleModel();
    }

    /**
     * Displays the Admin Dashboard with summary counts and the latest project.
     *
     * @return string The rendered admin dashboard view.
     */
    public function index(): string
    {
        // Fetch counts for the dashboard summary boxes
        $totalProjects = $this->projectModel->countAllResults();
        $totalEmployees = $this->userModel->where('role_id', 2)->where('status', 1)->countAllResults();

        // Fetch the latest project based on creation date
        // Order by 'created_at' in descending order and get the first result
        $latestProject = $this->projectModel->orderBy('created_at', 'DESC')->first();

        $data = [
            'userName' => session()->get('userName'),
            'totalProjects' => $totalProjects,
            'totalEmployees' => $totalEmployees,
            'latestProject' => $latestProject, // Pass the latest project data to the view
            'validation' => service('validation'),
        ];

        return view('dashboards/admin', $data);
    }

    // Existing methods (storeTask, storeUser) remain unchanged as per previous modularization.
    // REMOVED: Handles the creation of a new project. (Moved to ProjectController)
    // public function storeProject() { /* ... removed code ... */ }

    // REMOVED: Handles the assignment of a new task to an employee for a project.
    // public function storeTask() { /* ... removed code ... */ }

    // REMOVED: Handles the creation of a new user by Admin. (Moved to UserController)
    // public function storeUser() { /* ... removed code ... */ }
}
