<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
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
        $user = $this->model->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    // Xóa bản ghi
    public function delete($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}
