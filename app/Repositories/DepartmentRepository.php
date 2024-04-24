<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository
{
    protected $model;

    public function __construct(Department $department)
    {
        $this->model = $department;
    }
    
    public function getByCompanyId($companyId)
    {
        return $this->model->where('company_id', $companyId)->get();
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
        // dd("Đã tới đây");
        return $this->model->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        $department = $this->model->find($id);
        if ($department) {
            $department->update($data);
            return $department;
        }
        return null;
    }

    // Xóa bản ghi
    public function delete($id)
    {
        $department = $this->model->find($id);
        if ($department) {
            $department->delete();
            return true;
        }
        return false;
    }
}
