<?php

namespace App\Http\Controllers;
use App\Services\PersonService;
use App\Models\Person;
use App\Services\CompanyService;

use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest;


class PersonController extends Controller
{
    protected $personService;
    protected $companyService;

    public function __construct(PersonService $personService,CompanyService $companyService)
    {
        $this->personService = $personService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = $this->personService->getAll();
        $companies=$this->companyService->getAll();
        return view('persons.persons', compact('persons','companies'));
    }

    public function getPerson($id)
    {
        $person = $this->personService->findById($id);

        return view('persons.person', compact('person'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persons.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(PersonRequest $request)
    {
        $data = $request->validated();
        $company_id = $request->input('company_id');
        $data['company_id']=$company_id;
        // dd($data);
        $this->personService->create($data);
        return redirect()->route('persons')->with('success', 'Country created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = $this->personService->findById($id);
        $companies=$this->companyService->getAll();

        // dd($person);
        return view('persons.edit', compact('person','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, $id)
    {
        $data = $request->validated();
        $company_id = $request->input('company_id');
        $data['company_id']=$company_id;
        // dd($data);
        $this->personService->update($id, $data);
        return redirect()->route('persons')->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->personService->delete($id);
        return redirect()->route('persons')->with('success', 'Country deleted successfully.');
    }
}
