<?php

namespace App\Http\Controllers;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    // Hiển thị danh sách department
    public function index()
    {
        $departments = $this->departmentService->getAll();
        return view('departments.departments', compact('departments'));
    }

    // Hiển thị form tạo mới department
    public function create()
    {
        return view('departments.create');
    }

    // Lưu department mới vào cơ sở dữ liệu
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $this->departmentService->create($data);
        return  back()->with('success', 'Department created successfully.');
    }

    // Hiển thị form chỉnh sửa thông tin department
    public function edit($id)
    {
        $department = $this->departmentService->findById($id);
        $departments = $this->departmentService->getAll();
        // dd($department);
        return view('departments.edit', compact('department','departments'));
    }

    // Cập nhật thông tin department trong cơ sở dữ liệu
    public function update(DepartmentRequest $request, $id)
    {
        $data = $request->validated();
        $this->departmentService->update($id, $data);
        return redirect()->route('companies.edit', ['id' => $data['company_id']])->with('success', 'Department updated successfully.');
    }

    // Xóa department khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        $this->departmentService->delete($id);
        // return redirect()->route('departments')->with('success', 'Department deleted successfully.');
        return back()->with('success', 'Department deleted successfully.');

    }
}
