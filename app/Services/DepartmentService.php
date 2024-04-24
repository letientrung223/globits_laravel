<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return $this->departmentRepository->getAll();
    }

    // Tìm bản ghi theo ID
    public function findById($id)
    {
        return $this->departmentRepository->find($id);
    }

    public function getByCompanyId($company_id)
    {
    	return $this->departmentRepository->getByCompanyId($company_id);
    }

    // Tạo bản ghi mới
    public function create(array $data)
    {
        // dd($data);
        return $this->departmentRepository->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        return $this->departmentRepository->update($id, $data);
    }

    // Xóa bản ghi
    public function delete($id)
    {
        return $this->departmentRepository->delete($id);
    }
}
