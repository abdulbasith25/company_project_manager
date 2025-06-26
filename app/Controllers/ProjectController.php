<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\TaskModel; // Needed to get tasks for projects
use App\Models\UserModel; // Needed for assigned employees in tasks
use CodeIgniter\Controller;

class ProjectController extends Controller
{
    protected $projectModel;
    protected $taskModel;
    protected $userModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->taskModel = new TaskModel();
        $this->userModel = new UserModel(); // For fetching employees for assign task modal
    }

    /**
     * Displays a list of all projects.
     * This will be the dedicated page for viewing all projects.
     * Accessible by Admin (and later HR).
     *
     * @return string The rendered all projects view.
     */
    public function index(): string
    {
        // Use the existing model method to get all projects with their tasks and assigned employee names
        $allProjectData = $this->projectModel->getAllProjectsWithAssignedEmployees();

        // Reorganize data into a nested array: project -> tasks
        $projects = [];
        foreach ($allProjectData as $row) {
            $projectId = $row['id'];
            if (!isset($projects[$projectId])) {
                $projects[$projectId] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'created_at' => $row['created_at'],
                    'tasks' => []
                ];
            }
            // Add task details if task_id exists for this row
            if ($row['task_id']) {
                $projects[$projectId]['tasks'][] = [
                    'task_id' => $row['task_id'],
                    'task_title' => $row['task_title'],
                    'task_status' => $row['task_status'],
                    'assigned_employee_name' => $row['assigned_employee_name']
                ];
            }
        }

        // Fetch all employees (users with role_id = 2) for the assign task dropdown in the modal
        $employees = $this->userModel->where('role_id', 2)->findAll();

        $data = [
            'userName' => session()->get('userName'), // Pass for sidebar/navbar
            'projects' => array_values($projects), // Convert associative array back to indexed array for view
            'employees' => $employees, // Pass for assign task modal
            'validation' => service('validation') // Pass validation service for forms/modals
        ];

        return view('projects/index', $data);
    }

    /**
     * Displays the form for creating a new project.
     * This will be the dedicated page for project creation.
     * Accessible by Admin (and later HR).
     *
     * @return string The rendered project creation form view.
     */
    public function create(): string
    {
        $data = [
            'validation' => service('validation'),
            'userName' => session()->get('userName') // Pass for sidebar/navbar
        ];
        return view('projects/create', $data);
    }

    /**
     * Handles the submission of the new project form.
     * This logic is moved from AdminController.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        $session = session();
        $validation = service('validation');

        $rules = [
            'title'       => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[5000]',
        ];

        if (! $this->validate($rules)) {
            // Redirect back to the create project form with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->projectModel->insert($data)) {
            $session->setFlashdata('success', 'Project "' . esc($data['title']) . '" created successfully!');
            return redirect()->to('/projects'); // Redirect to the all projects list
        } else {
            log_message('error', 'Project creation failed: ' . json_encode($this->projectModel->errors()));
            $session->setFlashdata('error', 'Failed to create project. Please check logs or try again.');
            return redirect()->back()->withInput(); // Redirect back to form with old input
        }
    }
}
