<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    // Tìm bản ghi theo ID
    public function findById($id)
    {
        return $this->userRepository->find($id);
    }

    // Tạo bản ghi mới
    public function create(array $data)
    {
        // dd($data);
        return $this->userRepository->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    // Xóa bản ghi
    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}
