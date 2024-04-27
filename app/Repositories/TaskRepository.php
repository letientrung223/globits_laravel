<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected $model;

    public function __construct(Task $project)
    {
        $this->model = $project;
    }

    // Lấy tất cả bản ghi
    public function getAll()
    {
        return $this->model->all();
    }

    // Tìm bản ghi theo ID
    public function find($id)
    {
        return $this->model->find($id);
    }

    // Tạo bản ghi mới
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        $project = $this->model->find($id);
        if ($project) {
            $project->update($data);
            return $project;
        }
        return null;
    }

    // Xóa bản ghi
    public function delete($id)
    {
        $project = $this->model->find($id);
        if ($project) {
            $project->delete();
            return true;
        }
        return false;
    }
    public function getAllPaginated($perPage = 5)
    {
        return $this->model->paginate($perPage);
    }
    //by Company
    public function getTaskByCompanyId($companyId)
{
    $tasks = $this->model->select('tasks.*')
        ->join('projects', 'tasks.project_id', '=', 'projects.id')
        ->join('companies', 'projects.company_id', '=', 'companies.id')
        ->where('companies.id', $companyId)
        ->get();
    
    return $tasks;
}
    //by Project
    public function getTaskByProjectId($projectId)
    {
        return $this->model->where('project_id', $projectId)->get();
    }//by Person
    public function getTaskByPersonId($personId)
    {
        return $this->model->where('person_id', $personId)->get();
    }//by Status
    public function getTaskByStatus($status)
    {
        return $this->model->where('status', $status)->get();
    }//by Priority
    public function getTaskByPriority($priority)
    {
        return $this->model->where('priority', $priority)->get();
    }//by Name
    public function getTaskByName($name)
    {
        return $this->model->where('name', 'like', '%' . $name . '%')->get();
    }
}
