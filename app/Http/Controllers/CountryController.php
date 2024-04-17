<?php

namespace App\Http\Controllers;
use App\Services\CountryService;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    // Hiển thị danh sách quốc gia
    public function index()
    {
        $countries = $this->countryService->getAll();
        // dd($countries);
        return view('countries.country', compact('countries'));
    }

    // Hiển thị form tạo mới quốc gia
    public function create()
    {
        return view('countries.create');
    }

    // Lưu quốc gia mới vào cơ sở dữ liệu
    public function store(CountryRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $this->countryService->create($data);
        return redirect()->route('country')->with('success', 'Country created successfully.');
    }

    // Hiển thị form chỉnh sửa thông tin quốc gia
    public function edit($id)
    {
        $country = $this->countryService->findById($id);
        return view('countries.edit', compact('country'));
    }

    // Cập nhật thông tin quốc gia trong cơ sở dữ liệu
    public function update(CountryRequest $request, $id)
    {
        $data = $request->validated();
        $this->countryService->update($id, $data);
        return redirect()->route('country')->with('success', 'Country updated successfully.');
    }

    // Xóa quốc gia khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        $this->countryService->delete($id);
        return redirect()->route('country')->with('success', 'Country deleted successfully.');
    }
}
