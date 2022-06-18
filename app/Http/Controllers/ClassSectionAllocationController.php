<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\ClassSectionAllocation;

class ClassSectionAllocationController extends Controller
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
        $class_section_allocations = ClassSectionAllocation::orderBy('created_at', 'desc')->with([
            'section', 'student_class'
        ])->get();

        return view('class_section_allocations.index')->with('class_section_allocations', $class_section_allocations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $section = Section::orderBy('name')->get();
        $student_classes = StudentClass::orderBy('created_at', 'desc')->with([
            'class_year', 'academic_calendar', 'semester', 'department'
        ])->get();

        return view('class_section_allocations.create')->with([
            'sections' => $section,
            'student_classes' => $student_classes
        ]);
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
            'section' => 'required',
            'class' => 'required'
        ]);

        // check if class section exists
        $old_section_class_allocation = ClassSectionAllocation::where([
            'section_id' => $request->section,
            'student_class_id' => $request->class
        ])->first();

        if ($old_section_class_allocation) {
            return redirect()->back()->with('error', 'Class section already exists.');
        }

        $class_section_allocation = new ClassSectionAllocation;
        $class_section_allocation->section_id = $request->section;
        $class_section_allocation->student_class_id = $request->class;
        $class_section_allocation->save();

        return redirect()->route('class_section_allocations.index')->with('success', 'Class section created successfully.');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class_section_allocation = ClassSectionAllocation::find($id);
        $class_section_allocation->delete();

        return redirect()->route('class_section_allocations.index')->with('success', 'Class section deleted successfully.');
    }
}
