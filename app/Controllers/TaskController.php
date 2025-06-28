<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\ProjectModel; // For fetching projects for task assignment
use App\Models\UserModel;    // For fetching employees for task assignment
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface; // Required for $this->request->getGet()

class TaskController extends Controller
{
    protected $taskModel;
    protected $projectModel;
    protected $userModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
        $this->projectModel = new ProjectModel();
        $this->userModel = new UserModel();
    }

    /**
     * Displays the dedicated "All Tasks" page with a filterable list of tasks.
     * This page does NOT show summary boxes; those are on the dashboards.
     *
     * @return string The rendered tasks list view.
     */
    public function index(): string
    {
        $session = service('session');
        $currentUserId = $session->get('id'); // Get the ID of the logged-in user
        $currentUserRole = $session->get('userRole'); // Get the role of the logged-in user

        // Get the status filter from the URL
        $statusFilter = $this->request->getGet('status');

        // Determine which tasks to fetch based on user role
        // Admin and HR see all tasks, Employees see only their assigned tasks.
        if ($currentUserRole == 1 || $currentUserRole == 3) { // Admin or HR
            $tasksQuery = $this->taskModel->getAllTasksWithDetailsAndByNames();
        } else { // Employee (role_id 2)
            $tasksQuery = $this->taskModel->getAllTasksWithDetailsAndByNames($currentUserId);
        }

        // Apply filter if status is provided and valid
        if (!empty($statusFilter) && in_array($statusFilter, ['Pending', 'In Progress', 'Completed', 'Blocked'])) {
            // Re-filter the array if it's already fetched, or add a where clause if fetching fresh
            // For simplicity with getAllTasksWithDetailsAndByNames, let's refilter if the base query fetches all.
            // A more efficient way for employee would be to add where clause directly to getAllTasksWithDetailsAndByNames.
            // As getAllTasksWithDetailsAndByNames already supports assignedToUserId, we can directly apply the status filter to the builder.
            $builder = $this->taskModel->select('tasks.*,
                                                  projects.title as project_title,
                                                  assigned_to_user.name as assigned_to_name,
                                                  created_by_user.name as created_by_name,
                                                  updated_by_user.name as updated_by_name,
                                                  deleted_by_user.name as deleted_by_name')
                                       ->join('projects', 'projects.id = tasks.project_id', 'left')
                                       ->join('users as assigned_to_user', 'assigned_to_user.id = tasks.assigned_to', 'left')
                                       ->join('users as created_by_user', 'created_by_user.id = tasks.created_by', 'left')
                                       ->join('users as updated_by_user', 'updated_by_user.id = tasks.updated_by', 'left')
                                       ->join('users as deleted_by_user', 'deleted_by_user.id = tasks.deleted_by', 'left');

            if ($currentUserRole == 2) { // Only filter by assigned_to for employees
                $builder->where('tasks.assigned_to', $currentUserId);
            }
            $builder->where('tasks.status', $statusFilter);
            $allTasks = $builder->findAll();

        } else {
            // If no status filter or invalid filter, use the initial query result (all for admin/hr, assigned for employee)
            $allTasks = $tasksQuery;
        }

        // Fetch projects and employees for dropdowns in Add/Edit Task modals
        $projects = $this->projectModel->findAll();
        $employees = $this->userModel->where('role_id', 2)->findAll(); // Assuming role_id 2 is Employee

        $data = [
            'userName'            => $session->get('userName'),
            'tasks'               => $allTasks, // The filtered/unfiltered list of tasks
            'projects'            => $projects,
            'employees'           => $employees,
            'validation'          => service('validation'),
            'request'             => $this->request,
            'currentStatusFilter' => $statusFilter, // Pass for sidebar active state
            'currentUserRole'     => $currentUserRole // Pass for conditional display in view
        ];

        return view('tasks/index', $data);
    }

    /**
     * Handles the creation of a new task.
     * This might be called from a modal form submission on the tasks index page.
     * Accessible by Admin and HR.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        $session = service('session');
        $validation = service('validation');

        $currentUserRole = $session->get('userRole');

        // --- CHANGE 1: Initialize $statusFilter at the start of the method ---
        $statusFilter = $this->request->getGet('status');
        
        // Check if user has permission (Admin or HR)
        if (!in_array($session->get('userRole'), [1,3])) {
            $session->setFlashdata('error', 'You do not have permission to create tasks.');
            return redirect()->to('/tasks');
        }

        // Validation rules for task creation
        $rules = [
            'task_title'       => 'required|min_length[3]|max_length[255]',
            'task_description' => 'permit_empty|max_length[5000]',
            'remarks'     => 'permit_empty|max_length[5000]',
            'file'        => 'permit_empty|max_length[255]',
            'priority'    => 'required|in_list[Low,Medium,High]',
            'status'      => 'required|in_list[Pending,In Progress,Completed,Blocked]',
            'project_id'  => 'required|numeric|is_not_unique[projects.id]',
            'assigned_to' => 'required|numeric|is_not_unique[users.id]', // Must be a valid user ID
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('task_title'),
            'description' => $this->request->getPost('task_description'),
            'remarks'     => $this->request->getPost('remarks'),
            'file'        => $this->request->getPost('file'),
            'priority'    => $this->request->getPost('priority'),
            'status'      => $this->request->getPost('status'),
            'project_id'  => $this->request->getPost('project_id'),
            'assigned_to' => $this->request->getPost('assigned_to'),
            // 'created_by' will be set by the model callback
        ];

        if ($this->taskModel->insert($data)) {
            $session->setFlashdata('success', 'Task "' . esc($data['title']) . '" created successfully!');
        } else {
            log_message('error', 'Task creation failed: ' . json_encode($this->taskModel->errors()));
            $session->setFlashdata('error', 'Failed to create task. Please check logs or try again.');
        }

        // Redirect back to the tasks page, preserving the current filter if any
        return redirect()->to('/tasks' . ($statusFilter ? '?status=' . urlencode($statusFilter) : ''));
    }

    /**
     * Handles updating an existing task.
     * This might be called from a modal form submission on the tasks index page.
     * Accessible by Admin and HR.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update()
    {
        $session = service('session');
        $validation = service('validation');
        $taskId = $this->request->getPost('task_id');
        $statusFilter = $this->request->getGet('status'); // Get status filter to redirect back correctly

        // Check if user has permission (Admin or HR)
        if (!in_array($session->get('userRole'), [1, 3])) {
            $session->setFlashdata('error', 'You do not have permission to update tasks.');
            return redirect()->to('/tasks');
        }

        $existingTask = $this->taskModel->find($taskId);
        if (!$existingTask) {
            $session->setFlashdata('error', 'Task not found for update.');
            return redirect()->to('/tasks');
        }

        $rules = [
            'task_id'     => 'required|numeric|is_not_unique[tasks.id,id,{task_id}]', // Ensure the ID exists
            'title'       => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[5000]',
            'remarks'     => 'permit_empty|max_length[5000]',
            'file'        => 'permit_empty|max_length[255]',
            'priority'    => 'required|in_list[Low,Medium,High]',
            'status'      => 'required|in_list[Pending,In Progress,Completed,Blocked]',
            'project_id'  => 'required|numeric|is_not_unique[projects.id]',
            'assigned_to' => 'required|numeric|is_not_unique[users.id]',
        ];

        if (! $this->validate($rules)) {
            // Store input and errors in session to re-populate form/modal
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'remarks'     => $this->request->getPost('remarks'),
            'file'        => $this->request->getPost('file'),
            'priority'    => $this->request->getPost('priority'),
            'status'      => $this->request->getPost('status'),
            'project_id'  => $this->request->getPost('project_id'),
            'assigned_to' => $this->request->getPost('assigned_to'),
            // 'updated_by' will be set by the model callback
        ];

        if ($this->taskModel->update($taskId, $data)) {
            $session->setFlashdata('success', 'Task "' . esc($data['title']) . '" updated successfully!');
        } else {
            log_message('error', 'Task update failed for ID ' . $taskId . ': ' . json_encode($this->taskModel->errors()));
            $session->setFlashdata('error', 'Failed to update task. Please check logs or try again.');
        }

        // Redirect back to the tasks page, preserving the current filter if any
        return redirect()->to('/tasks' . ($statusFilter ? '?status=' . urlencode($statusFilter) : ''));
    }

    /**
     * Handles the deletion of a task (hard delete).
     * Accessible by Admin and HR.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete()
    {
        $session = service('session');
        $taskId = $this->request->getPost('task_id');
        $statusFilter = $this->request->getGet('status'); // Get status filter to redirect back correctly

        // Check if user has permission (Admin or HR)
        if (!in_array($session->get('userRole'), [1, 3])) {
            $session->setFlashdata('error', 'You do not have permission to delete tasks.');
            return redirect()->to('/tasks');
        }

        if (empty($taskId) || !is_numeric($taskId)) {
            $session->setFlashdata('error', 'Invalid task ID provided for deletion.');
            return redirect()->to('/tasks');
        }

        // Optional: Manually set deleted_by before hard delete if you want this audit trail.
        $loggedInUserId = $session->get('id');
        if ($loggedInUserId !== null) {
            $this->taskModel->update($taskId, ['deleted_by' => $loggedInUserId]);
        } else {
            log_message('info', 'Task deletion by unauthenticated user for task ID ' . $taskId);
        }

        // Perform hard delete
        if ($this->taskModel->delete($taskId)) {
            $session->setFlashdata('success', 'Task deleted permanently.');
        } else {
            log_message('error', 'Failed to delete task ID ' . $taskId . ': ' . json_encode($this->taskModel->errors()));
            $session->setFlashdata('error', 'Failed to delete task. Please check logs or try again.');
        }

        // Redirect back to the tasks page, preserving the current filter if any
        return redirect()->to('/tasks' . ($statusFilter ? '?status=' . urlencode($statusFilter) : ''));
    }

    /**
     * Handles the update of a task status, typically via AJAX from employee dashboard or directly from task list.
     * Accessible by Admin, HR, and Employee (for their own tasks).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|\CodeIgniter\HTTP\Response
     */
    public function updateTaskStatus()
    {
        $session = service('session');
        $taskId = $this->request->getPost('task_id');
        $status = $this->request->getPost('status');
        $currentUserId = $session->get('id');
        $currentUserRole = $session->get('userRole');
        $statusFilter = $this->request->getGet('status'); // Get status filter to redirect back correctly


        if (empty($taskId) || !is_numeric($taskId) || empty($status)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data.']);
            }
            $session->setFlashdata('error', 'Invalid data provided for status update.');
            return redirect()->to('/tasks'); // Default redirect if not AJAX
        }

        // Check if task exists
        $task = $this->taskModel->find($taskId);
        if (!$task) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Task not found.']);
            }
            $session->setFlashdata('error', 'Task not found.');
            return redirect()->to('/tasks');
        }

        // Permission check: Admin/HR can update any task, Employee can only update their assigned tasks
        if (!in_array($currentUserRole, [1,2,3]) && $task['assigned_to'] != $currentUserId) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Unauthorized: You can only update your own assigned tasks.']);
            }
            $session->setFlashdata('error', 'Unauthorized: You can only update your own assigned tasks.');
            return redirect()->to('/tasks');
        }

        // Update task status
        $data = ['status' => $status];
        // 'updated_by' and 'updated_at' will be set by the TaskModel callbacks

        if ($this->taskModel->update($taskId, $data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Task status updated.']);
            }
            $session->setFlashdata('success', 'Task status updated successfully.');
        } else {
            log_message('error', 'Task status update failed for ID ' . $taskId . ': ' . json_encode($this->taskModel->errors()));
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update task status.']);
            }
            $session->setFlashdata('error', 'Failed to update task status. Please try again.');
        }

        // Redirect only if it's not an AJAX request, preserving current filter
        return $this->request->isAJAX() ? $this->response->setStatusCode(200) : redirect()->to('/tasks' . ($statusFilter ? '?status=' . urlencode($statusFilter) : ''));
    }
}
