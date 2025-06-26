<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table      = 'projects';
    protected $primaryKey = 'id';


    // Ensure 'created_at' is allowed, even if not explicitly sent from controller
    protected $allowedFields = ['title', 'description', 'created_at','created_by','updated_by','deleted_by'];

    // MODIFIED: Disable CodeIgniter's automatic timestamp handling for this model
    protected $useTimestamps = false;
    // We can comment out these if useTimestamps is false, or keep them as documentation
    // protected $createdField  = 'created_at';
    // protected $updatedField  = false;

    /**
     * Fetches all projects and optionally joins tasks to get assigned employee names.
     * Note: This might fetch duplicate project rows if a project has multiple tasks,
     * or no tasks assigned yet. For displaying unique projects, a distinct query
     * or post-processing might be needed, but for listing project details alongside tasks, this is fine.
     *
     * @return array
     */
    public function getAllProjectsWithAssignedEmployees(): array
    {
        // Select all project fields, and relevant task and user fields
        return $this->select('projects.*, tasks.id as task_id, tasks.title as task_title, tasks.status as task_status, users.name as assigned_employee_name')
                    ->join('tasks', 'tasks.project_id = projects.id', 'left') // Left join to include projects even if they have no tasks
                    ->join('users', 'users.id = tasks.assigned_to', 'left') // Left join to include tasks even if assigned_to is null
                    ->findAll(); // Get all results
    }
}
