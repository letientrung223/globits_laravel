<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    protected $model;

    public function __construct(Country $country)
    {
        $this->model = $country;
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
        $country = $this->model->find($id);
        if ($country) {
            $country->update($data);
            return $country;
        }
        return null;
    }

    // Xóa bản ghi
    public function delete($id)
    {
        $country = $this->model->find($id);
        if ($country) {
            $country->delete();
            return true;
        }
        return false;
    }
}
