<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    protected $model;

    public function __construct(Project $project)
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
    public function getProjectByCompanyId($companyId)
    {
        return $this->model->where('company_id', $companyId)->get();
    }
}
