<?php

namespace App\Repositories;

use App\Models\Person;

class PersonRepository
{
    protected $model;

    public function __construct(Person $person)
    {
        $this->model = $person;
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
        $person = $this->model->find($id);
        if ($person) {
            $person->update($data);
            return $person;
        }
        return null;
    }

    // Xóa bản ghi
    public function delete($id)
    {
        $person = $this->model->find($id);
        if ($person) {
            $person->delete();
            return true;
        }
        return false;
    }
    public function getPersonByCompanyId($companyId)
    {
        return $this->model->where('company_id', $companyId)->get();
    }
    public function getAllPaginated($perPage = 5)
    {
        return $this->model->paginate($perPage);
    }
}
