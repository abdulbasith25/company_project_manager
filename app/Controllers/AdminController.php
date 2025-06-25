<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\UserModel;
use App\Models\TaskModel;
use App\Models\RoleModel; // NEW: Import RoleModel
use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $projectModel;
    protected $userModel;
    protected $taskModel;
    protected $roleModel; // NEW: Declare RoleModel

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->userModel = new UserModel();
        $this->taskModel = new TaskModel();
        $this->roleModel = new RoleModel(); // NEW: Initialize RoleModel
    }

    /**
     * Displays the Admin Dashboard with a list of projects and summary counts.
     *
     * @return string The rendered admin dashboard view.
     */
    public function index(): string
    {
        $allProjectData = $this->projectModel->getAllProjectsWithAssignedEmployees();

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
            if ($row['task_id']) {
                $projects[$projectId]['tasks'][] = [
                    'task_id' => $row['task_id'],
                    'task_title' => $row['task_title'],
                    'task_status' => $row['task_status'],
                    'assigned_employee_name' => $row['assigned_employee_name']
                ];
            }
        }

        // Fetch all employees (users with role_id = 2) for task assignment dropdown
        $employees = $this->userModel->where('role_id', 2)->findAll();

        // Fetch all roles for the 'Add User' form
        $roles = $this->roleModel->findAll(); // NEW: Fetch all roles

        // Fetch counts for the dashboard summary boxes
        $totalProjects = $this->projectModel->countAllResults();
        $totalEmployees = $this->userModel->where('role_id', 2)->countAllResults();

        $data = [
            'userName' => session()->get('userName'),
            'projects' => array_values($projects),
            'employees' => $employees,
            'roles' => $roles, // NEW: Pass roles data to the view
            'validation' => service('validation'),
            'totalProjects' => $totalProjects,
            'totalEmployees' => $totalEmployees,
        ];

        return view('dashboards/admin', $data);
    }

    /**
     * Handles the creation of a new project.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function storeProject()
    {
        $session = session();
        $validation = service('validation');

        $rules = [
            'title'       => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[5000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->projectModel->insert($data)) {
            $session->setFlashdata('success', 'Project "' . esc($data['title']) . '" created successfully!');
        } else {
            log_message('error', 'Project insertion failed: ' . json_encode($this->projectModel->errors()));
            $session->setFlashdata('error', 'Failed to create project. Please check logs or try again.');
        }

        return redirect()->to('/admin/dashboard');
    }

    /**
     * Handles the assignment of a new task to an employee for a project.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function storeTask()
    {
        $session = session();
        $validation = service('validation');

        $rules = [
            'project_id'  => 'required|numeric|is_not_unique[projects.id]',
            'task_title'  => 'required|min_length[3]|max_length[255]',
            'task_description' => 'permit_empty|max_length[5000]',
            'priority'    => 'required|in_list[Low,Medium,High]',
            'status'      => 'required|in_list[Pending,In Progress,Completed,Blocked]',
            'assigned_to' => 'required|numeric|is_not_unique[users.id]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/admin/dashboard')->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'project_id'  => $this->request->getPost('project_id'),
            'title'       => $this->request->getPost('task_title'),
            'description' => $this->request->getPost('task_description'),
            'remarks'     => '',
            'file'        => '',
            'priority'    => $this->request->getPost('priority'),
            'status'      => $this->request->getPost('status'),
            'assigned_to' => $this->request->getPost('assigned_to'),
        ];

        if ($this->taskModel->insert($data)) {
            $session->setFlashdata('success', 'Task "' . esc($data['title']) . '" assigned successfully!');
        } else {
            log_message('error', 'Task assignment failed: ' . json_encode($this->taskModel->errors()));
            $session->setFlashdata('error', 'Failed to assign task. Please check logs or try again.');
        }

        return redirect()->to('/admin/dashboard');
    }

    /**
     * NEW: Handles the creation of a new user by Admin.
     * This method is very similar to HrController::storeUser().
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function storeUser()
    {
        $session = session();
        $validation = service('validation');

        $rules = [
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'phone'     => 'permit_empty|max_length[20]',
            'password'  => 'required|min_length[6]',
            'role_id'   => 'required|numeric|in_list[1,2,3]',
            'status'    => 'required|numeric|in_list[0,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/admin/dashboard')->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'password'  => $this->request->getPost('password'),
            'role_id'   => $this->request->getPost('role_id'),
            'status'    => $this->request->getPost('status'),
        ];

        if ($this->userModel->insert($data)) {
            $session->setFlashdata('success', 'User "' . esc($data['name']) . '" added successfully!');
        } else {
            log_message('error', 'User addition failed by Admin: ' . json_encode($this->userModel->errors()));
            $session->setFlashdata('error', 'Failed to add user. Please check logs or try again.');
        }

        return redirect()->to('/admin/dashboard');
    }
}
