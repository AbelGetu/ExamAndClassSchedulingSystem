<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\TeacherAllocation;

class TeacherAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher_allocations = TeacherAllocation::orderBy('created_at', 'desc')->with([
            'student_class.academic_calendar', 'student_class.semester', 'student_class.class_year', 'subject'
        ]);
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
        
        $teachers = [];
        $teacher_role = Role::where('name', 'teacher')->first();
        if($teacher_role) {
            $teacher_role_user_ids = UserRole::where('role_id', $teacher_role->id)->pluck('user_id');

            $teachers = User::whereIn('id', $teacher_role_user_ids)->get();
        }

        return view('teacher_allocations.create')->with([
            'student_classes' => $student_classes,
            'subjects' => $subjects,
            'teachers' => $teachers
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
            'periods_per_week' => 'required',
            'teacher' => 'required'
        ]);

        $teacher_allocation = new TeacherAllocation;
        $teacher_allocation->user_id = $request->teacher;
        $teacher_allocation->student_class_id = $request->student_class;
        $teacher_allocation->subject_id = $request->subject;
        $teacher_allocation->periods_per_week = $request->periods_per_week;
        $teacher_allocation->save();
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
        $teacher_allocation = TeacherAllocation::find($id);
        $teacher_allocation->delete();

        return redirect()->route('teacher_allocations.index')->with('success', 'Teacher allocation deleted successfully');
    }
}
