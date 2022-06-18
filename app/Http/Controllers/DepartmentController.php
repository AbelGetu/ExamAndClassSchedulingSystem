<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::orderBy('name')->with('college')->get();

        return view('departments.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colleges = College::orderBy('name')->get();

        return view('departments.create')->with('colleges', $colleges);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'college' => 'required|exists:colleges,id'
        ]);

        $department = new Department;
        $department->name = $request->name;
        $department->phone = $request->phone;
        $department->email = $request->email;
        $department->website = $request->website;
        $department->college_id = $request->college;
        $department->save();

        return redirect('/departments')->with('success', 'Department created successfully');
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
        $department = Department::find($id);
        $colleges = College::orderBy('name')->get();

        return view('departments.edit')->with([
            'department' => $department,
            'colleges' => $colleges
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'college' => 'required|exists:colleges,id'
        ]);

        $department = Department::find($id);
        $department->name = $request->name;
        $department->phone = $request->phone;
        $department->email = $request->email;
        $department->website = $request->website;
        $department->college_id = $request->college;
        $department->save();

        return redirect('/departments')->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();

        return redirect('/departments')->with('success', 'Department deleted successfully');
    }
}
