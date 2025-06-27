<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Controller;

class EmployeeController extends Controller
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    /**
     * Displays the Employee Dashboard with assigned tasks and task summaries.
     *
     * @return string The rendered employee dashboard view.
     */
    public function index(): string
    {
        $session = session();
        $employeeId = $session->get('userId'); // Using 'userId' as per your provided code

        // Fetch tasks assigned to this employee, including project titles
        $assignedTasks = $this->taskModel->getAssignedTasksForEmployee($employeeId);

        // NEW: Fetch task counts for the current employee's assigned tasks
        $totalAssignedTasks      = $this->taskModel->countAllTasks($employeeId);
        $pendingAssignedTasks    = $this->taskModel->countTasksByStatus('Pending', $employeeId);
        $inProgressAssignedTasks = $this->taskModel->countTasksByStatus('In Progress', $employeeId);
        $completedAssignedTasks  = $this->taskModel->countTasksByStatus('Completed', $employeeId);
        $blockedAssignedTasks    = $this->taskModel->countTasksByStatus('Blocked', $employeeId);

        $data = [
            'userName'                => $session->get('userName'),
            'assignedTasks'           => $assignedTasks,
            // NEW: Pass the task summary counts to the view
            'totalAssignedTasks'      => $totalAssignedTasks,
            'pendingAssignedTasks'    => $pendingAssignedTasks,
            'inProgressAssignedTasks' => $inProgressAssignedTasks,
            'completedAssignedTasks'  => $completedAssignedTasks,
            'blockedAssignedTasks'    => $blockedAssignedTasks,
            'validation'              => service('validation')
        ];

        return view('dashboards/employee', $data);
    }

    /**
     * Handles the update of a task's status.
     * Only allows update if the task belongs to the logged-in employee.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function updateTaskStatus()
    {
        $session = session();
        $validation = service('validation');

        // Define validation rules
        $rules = [
            'task_id' => 'required|numeric',
            'status'  => 'required|in_list[Pending,In Progress,Completed,Blocked]', // Adjust based on your actual statuses
        ];

        // Check if validation passes
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $taskId = $this->request->getPost('task_id');
        $newStatus = $this->request->getPost('status');
        $employeeId = $session->get('userId'); // Using 'userId' as per your provided code

        $task = $this->taskModel->find($taskId);

        if (!$task || $task['assigned_to'] != $employeeId) {
            $session->setFlashdata('error', 'Unauthorized attempt to update task or task not found.');
            return redirect()->back();
        }

        // Prepare data for update
        $data = [
            'status' => $newStatus,
            'updated_at' => date('Y-m-d H:i:s'), // Explicitly set updated_at
        ];

        // Perform the update
        if ($this->taskModel->update($taskId, $data)) {
            $session->setFlashdata('success', 'Task status updated successfully!');
        } else {
            log_message('error', 'Task status update failed for task ID ' . $taskId . ': ' . json_encode($this->taskModel->errors()));
            $session->setFlashdata('error', 'Failed to update task status. Please try again.');
        }

        return redirect()->to('/dashboard/employee');
    }
}
