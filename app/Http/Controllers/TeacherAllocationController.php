<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Subject;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Models\TeacherAllocation;
use App\Models\ClassSectionAllocation;

class TeacherAllocationController extends Controller
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
        $teacher_allocations = TeacherAllocation::orderBy('created_at', 'desc')->with([
            'user', 'subject', 'class_section_allocation'
        ])->get();

        return view('teacher_allocations.index')->with('teacher_allocations', $teacher_allocations);
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

        $teachers = [];
        $teacherRole = Role::where('name', 'teacher')->first();
        if($teacherRole) {
            $teacherIds = UserRole::where('role_id', $teacherRole->id)->pluck('user_id');

            $teachers = User::whereIn('id', $teacherIds)->orderBy('name')->get();
        }

        return view('teacher_allocations.create')->with([
            'subjects' => $subjects,
            'class_section_allocations' => $class_section_allocations,
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
        $request->validate([
            'subject' => 'required',
            'class' => 'required',
            'user' => 'required',
            'periods_per_week' => 'required'
        ]);

        // check if class section exists
        $old_section_class_allocation = TeacherAllocation::where([
            'subject_id' => $request->subject,
            'class_section_allocation_id' => $request->class
        ])->first();

        if ($old_section_class_allocation) {
            return redirect()->back()->with('error', 'Teacher already allocated for this class section');
        }

        $teacher_allocation = new TeacherAllocation;
        $teacher_allocation->subject_id = $request->subject;
        $teacher_allocation->class_section_allocation_id = $request->class;
        $teacher_allocation->user_id = $request->user;
        $teacher_allocation->period_per_week = $request->periods_per_week;
        $teacher_allocation->save();

        return redirect()->route('teacher_allocations.index')->with('success', 'Teacher allocated successfully');
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
