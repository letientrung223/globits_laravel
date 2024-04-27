<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return $this->taskRepository->getAll();
    }

    // Tìm bản ghi theo ID
    public function findById($id)
    {
        return $this->taskRepository->find($id);
    }

    // Tạo bản ghi mới
    public function create(array $data)
    {
        // dd($data);
        return $this->taskRepository->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    // Xóa bản ghi
    public function delete($id)
    {
        return $this->taskRepository->delete($id);
    }
    public function getAllPaginated($perPage = 5)
    {
        return $this->taskRepository->getAllPaginated($perPage);
    }
    //by Company
    public function getTaskByCompanyId($companyId)
    {
        return $this->taskRepository->getTaskByCompanyId($companyId);
    }
    //by Project
    public function getTaskByProjectId($projectId)
    {
        return $this->taskRepository->getTaskByProjectId($projectId);
    }
    //by Person
    public function getTaskByPersonId($personId)
    {
        return $this->taskRepository->getTaskByPersonId($personId);
    }
    //by Status
    public function getTaskByStatus($status)
    {
        return $this->taskRepository->getTaskByStatus($status);
    }
    //by Priority
    public function getTaskByPriority($priority)
    {
        return $this->taskRepository->getTaskByPriority($priority);
    }
    //by Name
    public function getTaskByName($name)
    {
        return $this->taskRepository->getTaskByName($name);
    }
}
