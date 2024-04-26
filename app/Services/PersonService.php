<?php

namespace App\Services;

use App\Repositories\PersonRepository;

class PersonService
{
    protected $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return $this->personRepository->getAll();
    }

    // Tìm bản ghi theo ID
    public function findById($id)
    {
        return $this->personRepository->find($id);
    }

    // Tạo bản ghi mới
    public function create(array $data)
    {
        // dd($data);
        return $this->personRepository->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        return $this->personRepository->update($id, $data);
    }

    // Xóa bản ghi
    public function delete($id)
    {
        return $this->personRepository->delete($id);
    }
    public function getPersonByCompanyId($company_id)
    {
        return $this->personRepository->getPersonByCompanyId($company_id);
    }
    public function getAllPaginated($perPage = 5)
    {
        return $this->personRepository->getAllPaginated($perPage);
    }
}
