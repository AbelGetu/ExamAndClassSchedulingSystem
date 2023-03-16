<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\ExamAllocation;
use App\Models\ClassSectionAllocation;

class ExamAllocationController extends Controller
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
        $exam_allocations = ExamAllocation::orderBy('created_at', 'desc')->with([
            'subject', 'class_section_allocation.student_class'
        ])->get();

        return view('exam_allocations.index')->with('exam_allocations', $exam_allocations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::orderBy('name')->get();
        $class_section_allocations = ClassSectionAllocation::orderBy('created_at', 'desc')->with([
            'student_class', 'section'
        ])->get();

        return view('exam_allocations.create')->with([
            'subjects' => $subjects,
            'class_section_allocations' => $class_section_allocations
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
            'subject' => 'required',
            'class' => 'required',
            'weight' => 'required'
        ]);

        // check if class section exists
        $old_section_class_allocation = ExamAllocation::where([
            'subject_id' => $request->subject,
            'class_section_allocation_id' => $request->class,
        ])->first();

        if ($old_section_class_allocation) {
            return redirect()->back()->with('error', 'Exam allocation already exists');
        }

        $exam_allocation = new ExamAllocation;
        $exam_allocation->subject_id = $request->subject;
        $exam_allocation->class_section_allocation_id = $request->class;
        $exam_allocation->weight = $request->weight;
        $exam_allocation->save();

        return redirect()->route('exam_allocations.index')->with('success', 'Exam allocation created successfully');
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
        $exam_allocation = ExamAllocation::find($id);
        
        $exam_allocation->delete();

        return redirect()->route('exam_allocations.index')->with('success', 'Exam allocation deleted successfully');
    }
}
