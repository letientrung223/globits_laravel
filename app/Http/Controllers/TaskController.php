<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskService;
use App\Services\ProjectService;
use App\Services\PersonService;
use App\Services\CompanyService;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    protected $taskService;
    protected $projectService;
    protected $companyService;
    protected $personService;

    public function __construct(TaskService $taskService,CompanyService $companyService,ProjectService $projectService,PersonService $personService)
    {
        $this->taskService = $taskService;
        $this->projectService = $projectService;
        $this->companyService = $companyService;
        $this->personService = $personService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks=$this->taskService->getAllPaginated(5);
        $projects=$this->projectService->getAll();
        $companies=$this->companyService->getAll();
        $persons=$this->personService->getAll();


        // dd($tasks);
        return view('tasks.tasks', compact('tasks','projects','companies','persons'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterByCompanyId(Request $request)
    {
        $data = $request->query('data');
        $task = $this->taskService->getTaskByCompanyId($data);
        return response()->json(['message' => 'successfully','data' => $task]);        
        
    }
    public function filterByPersonId(Request $request)
    {
        $data = $request->query('data');
        $task = $this->taskService->getTaskByPersonId($data);
        return response()->json(['message' => 'successfully','data' => $task]);        
        
    }
    public function filterByPriority(Request $request)
    {
        $data = $request->query('data');
        $task = $this->taskService->getTaskByPriority($data);
        return response()->json(['message' => 'successfully','data' => $task]);        
        
    }
    public function filterByStatus(Request $request)
    {
        $data = $request->query('data');
        $task = $this->taskService->getTaskByStatus($data);
        return response()->json(['message' => 'successfully','data' => $task]);        
        
    }
    public function filterByProjectId(Request $request)
    {
        $data = $request->query('data');
        $task = $this->taskService->getTaskByProjectId($data);
        return response()->json(['message' => 'successfully','data' => $task]);        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = $request->validated();
        // dd($task);
        $this->taskService->create($task);
        return redirect()->route('tasks')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data = $request->query('data');
        $task = $this->taskService->getTaskByName($data);
        return response()->json(['message' => 'successfully','data' => $task]);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = $this->taskService->findById($id);
        $companies=$this->companyService->getAll();

        return view('tasks.edit', compact('task','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = $request->validated();
        $this->taskService->update($id, $task);
        return redirect()->route('tasks')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->taskService->delete($id);
        return redirect()->route('tasks')->with('success', 'Task deleted successfully.');
    }
    public function delete($id)
    {
        $this->taskService->delete($id);
        return response()->json(['message' => 'Task deleted successfully.']);
    }
}
