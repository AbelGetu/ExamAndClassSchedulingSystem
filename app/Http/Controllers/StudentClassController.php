<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\ClassYear;
use App\Models\Department;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AcademicCalendar;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_classes = StudentClass::orderBy('created_at')->with([
            'class_year', 'academic_calendar', 'semester', 'department'
        ])->get();

        return view('student_classes.index')->with('student_classes', $student_classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class_years = ClassYear::orderBy('name')->get();
        $academic_calendars = AcademicCalendar::orderBy('name')->get();
        $semesters = Semester::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();


        return view('student_classes.create')->with([
            'class_years' => $class_years,
            'academic_calendars' => $academic_calendars,
            'semesters' => $semesters,
            'departments' => $departments
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
            'class_year_id' => 'required|integer|exists:class_years,id',
            'academic_calendar_id' => 'required|integer|exists:academic_calendars,id',
            'semester_id' => 'required|integer|exists:semesters,id',
            'department_id' => 'required|integer|exists:departments,id',
        ]);

        $student_class = new StudentClass;
        $student_class->class_year_id = $request->class_year_id;
        $student_class->academic_calendar_id = $request->academic_calendar_id;
        $student_class->semester_id = $request->semester_id;
        $student_class->department_id = $request->department_id;
        $student_class->save();

        return redirect()->route('student_classes.index')->with('success', 'Student Class created successfully.');
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
        $student_class = StudentClass::findOrFail($id);
        $class_years = ClassYear::orderBy('name')->get();
        $academic_calendars = AcademicCalendar::orderBy('name')->get();
        $semesters = Semester::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('student_classes.edit')->with([
            'student_class' => $student_class,
            'class_years' => $class_years,
            'academic_calendars' => $academic_calendars,
            'semesters' => $semesters,
            'departments' => $departments
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
        $this->validate($request, [
            'class_year_id' => 'required|integer|exists:class_years,id',
            'academic_calendar_id' => 'required|integer|exists:academic_calendars,id',
            'semester_id' => 'required|integer|exists:semesters,id',
            'department_id' => 'required|integer|exists:departments,id',
        ]);

        $student_class = StudentClass::findOrFail($id);
        $student_class->class_year_id = $request->class_year_id;
        $student_class->academic_calendar_id = $request->academic_calendar_id;
        $student_class->semester_id = $request->semester_id;
        $student_class->department_id = $request->department_id;
        $student_class->save();

        return redirect()->route('student_classes.index')->with('success', 'Student Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_class = StudentClass::findOrFail($id);
        $student_class->delete();

        return redirect()->route('student_classes.index')->with('success', 'Student Class deleted successfully.');
    }
}
