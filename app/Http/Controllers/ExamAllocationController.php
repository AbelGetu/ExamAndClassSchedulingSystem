<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\ExamAllocation;

class ExamAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam_allocations = ExamAllocation::orderBy('created_at')->with([
            'student_class.academic_calendar', 'student_class.semester', 'student_class.class_year', 'subject'
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
        $student_classes = StudentClass::orderBy('created_at')->with([
            'class_year', 'semester', 'academic_calendar', 'department'
        ])->get();
        $subjects = Subject::orderBy('created_at')->get();

        return view('exam_allocations.create')->with([
            'student_classes' => $student_classes,
            'subjects' => $subjects
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
        $this->validate($request, [
            'student_class' => 'required',
            'subject' => 'required',
            'weight' => 'required'
        ]);

        $exam_allocation = new ExamAllocation;
        $exam_allocation->student_class_id = $request->student_class;
        $exam_allocation->subject_id = $request->subject;
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
        $exam_allocation = ExamAllocation::findOrFail($id);
        $exam_allocation->delete();

        return redirect()->route('exam_allocations.index')->with('success', 'Exam allocation deleted successfully');
    }
}
