<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return $this->projectRepository->getAll();
    }

    // Tìm bản ghi theo ID
    public function findById($id)
    {
        return $this->projectRepository->find($id);
    }

    // Tạo bản ghi mới
    public function create(array $data)
    {
        // dd($data);
        return $this->projectRepository->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        return $this->projectRepository->update($id, $data);
    }

    // Xóa bản ghi
    public function delete($id)
    {
        return $this->projectRepository->delete($id);
    }
    public function getAllPaginated($perPage = 5)
    {
        return $this->projectRepository->getAllPaginated($perPage);
    }
    public function getProjectByCompanyId($company_id)
    {
        return $this->projectRepository->getProjectByCompanyId($company_id);
    }
}
