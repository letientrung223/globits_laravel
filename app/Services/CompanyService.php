<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return $this->companyRepository->getAll();
    }

    // Tìm bản ghi theo ID
    public function findById($id)
    {
        return $this->companyRepository->find($id);
    }

    // Tạo bản ghi mới
    public function create(array $data)
    {
        // dd($data);
        return $this->companyRepository->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        return $this->companyRepository->update($id, $data);
    }

    // Xóa bản ghi
    public function delete($id)
    {
        return $this->companyRepository->delete($id);
    }
}
