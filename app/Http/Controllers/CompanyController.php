<?php

namespace App\Http\Controllers;
use App\Services\CompanyService;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService,DepartmentService $dpmService)
    {
        $this->companyService = $companyService;
        $this->dpmService =$dpmService;
    }

    // Hiển thị danh sách công ty
    public function index()
    {
        $companies = $this->companyService->getAllPaginated(2);
        
        // dd($countries);
        return view('companies.companies', compact('companies'));
    }

    // Hiển thị form tạo mới công ty
    public function create()
    {
        return view('companies.create');
    }

    // Lưu công ty mới vào cơ sở dữ liệu
    public function store(CompanyRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $this->companyService->create($data);
        return redirect()->route('companies')->with('success', 'Company created successfully.');
    }

    // Hiển thị form chỉnh sửa thông tin công ty
    public function edit($id)
    {
        $company = $this->companyService->findById($id);
        $departments = $this->dpmService->getByCompanyId($id);
        // dd($departments);
        return view('companies.edit', compact('company','departments'));
    }

    // Cập nhật thông tin công ty trong cơ sở dữ liệu
    public function update(CompanyRequest $request, $id)
    {
        $data = $request->validated();
        $this->companyService->update($id, $data);
        return redirect()->route('companies')->with('success', 'Company updated successfully.');
    }

    // Xóa công ty khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        $this->companyService->delete($id);
        return redirect()->route('companies')->with('success', 'Company deleted successfully.');
    }
}
