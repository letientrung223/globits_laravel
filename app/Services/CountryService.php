<?php

namespace App\Services;

use App\Repositories\CountryRepository;

class CountryService
{
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return $this->countryRepository->getAll();
    }

    // Tìm bản ghi theo ID
    public function findById($id)
    {
        return $this->countryRepository->find($id);
    }

    // Tạo bản ghi mới
    public function create(array $data)
    {
        // dd($data);
        return $this->countryRepository->create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        return $this->countryRepository->update($id, $data);
    }

    // Xóa bản ghi
    public function delete($id)
    {
        return $this->countryRepository->delete($id);
    }
}
