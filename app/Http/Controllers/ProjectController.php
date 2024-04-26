<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ProjectService;
use App\Http\Requests\ProjectRequest;

use App\Services\CompanyService;
use App\Services\PersonService;

class ProjectController extends Controller
{
    protected $personService;
    protected $companyService;
    public function __construct(ProjectService $projectService,PersonService $personService,CompanyService $companyService)
    {
        $this->personService = $personService;
        $this->companyService = $companyService;
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $projects = $this->projectService->getAllPaginated(2);
        $companies=$this->companyService->getAll();
        $persons = $this->personService->getAll();
        return view('projects.projects', compact('persons','companies','projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(ProjectRequest $request)
{
    $data = $request->validated();

    // Kiểm tra xem có tồn tại person_id trong request hay không
    if ($request->has('person_id')) {
        // Lấy instance của Project từ dữ liệu được tạo ra sau khi gửi request
        $project = $this->projectService->create($data);

        // Sử dụng phương thức sync() trên mối quan hệ person()
        // để thêm các person_id vào bảng trung gian person_project
        $project->person()->sync($request->person_id); 
    } else {
        // Nếu không có person_id được gửi trong request, chỉ tạo project mà không đính kèm person
        $this->projectService->create($data);
    }

    return redirect()->route('projects')->with('success', 'Project created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = $this->projectService->findById($id);
        $companies=$this->companyService->getAll();

        // dd($project);
        return view('projects.edit', compact('project','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $data = $request->validated();        
       
        if ($request->has('person_id')) {
            $project = $this->projectService->update($id, $data);   
            $project->person()->sync($request->person_id); 
        }else{
            $this->userService->update($id, $data);   
        }
        // Gọi phương thức update của service
        return redirect()->route('projects')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->projectService->delete($id);
        return redirect()->route('projects')->with('success', 'Project deleted successfully.');
    }
}
