<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table      = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title', 'description', 'remarks', 'file', 'priority',
        'status', 'project_id', 'assigned_to', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Fetches tasks associated with a specific project, including the assigned employee's name.
     *
     * @param int $projectId
     * @return array
     */
    public function getTasksByProjectIdWithEmployee(int $projectId): array
    {
        return $this->select('tasks.*, users.name as assigned_employee_name')
                    ->join('users', 'users.id = tasks.assigned_to', 'left')
                    ->where('tasks.project_id', $projectId)
                    ->findAll();
    }

    /**
     * Fetches all tasks assigned to a specific employee, including the project title.
     *
     * @param int $employeeId The user ID of the employee.
     * @return array
     */
    public function getAssignedTasksForEmployee(int $employeeId): array
    {
        return $this->select('tasks.*, projects.title as project_title')
                    ->join('projects', 'projects.id = tasks.project_id', 'left') // Join to get project title
                    ->where('tasks.assigned_to', $employeeId)
                    ->findAll();
    }
}
