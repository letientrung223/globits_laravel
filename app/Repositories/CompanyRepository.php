<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    protected $model;

    public function __construct(Company $company)
    {
        $this->model = $company;
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
        $company = $this->model->find($id);
        if ($company) {
            $company->update($data);
            return $company;
        }
        return null;
    }

    // Xóa bản ghi
    public function delete($id)
    {
        $company = $this->model->find($id);
        if ($company) {
            $company->delete();
            return true;
        }
        return false;
    }
}
