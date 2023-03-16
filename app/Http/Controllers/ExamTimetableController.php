<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Semester;
use App\Models\ClassYear;
use App\Models\Department;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\ExamTimetable;
use App\Models\AcademicCalendar;
use App\Models\TeacherAllocation;
use App\Models\ClassSectionAllocation;

class ExamTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academic_calendars = AcademicCalendar::orderBy('created_at', 'desc')->get();
        $semesters = Semester::orderBy('name')->get();
        $class_years = ClassYear::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('exam_timetables.index')->with([
            'academic_calendars' => $academic_calendars,
            'semesters' => $semesters,
            'student_class' => null,
            'class_years' => $class_years,
            'departments' => $departments,
        ]);
    }

    public function getExamTimetables(Request $request)
    {
        $academic_calendar_id = $request->academic_calendar;
        $semester_id = $request->semester;
        $class_year_id = $request->class_year;
        $department_id = $request->department;
        $timetables = collect();
        $student_class = StudentClass::where([
            'academic_calendar_id' => $academic_calendar_id,
            'semester_id' => $semester_id,
            'class_year_id' => $class_year_id,
            'department_id' => $department_id
        ])->first();

        if($student_class == null) {
            return redirect()->back()->with('error', 'No timetable found for the selected criteria.');
        } else {
            $academic_calendars = AcademicCalendar::orderBy('created_at', 'desc')->get();
            $semesters = Semester::orderBy('name')->get();
            $class_years = ClassYear::orderBy('name')->get();
            $departments = Department::orderBy('name')->get();

            return view('exam_timetables.index')->with([
                'academic_calendars' => $academic_calendars,
                'semesters' => $semesters,
                'class_years' => $class_years,
                'departments' => $departments,
                'student_class' => $student_class
            ]);
        }
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

        return view('exam_timetables.create')->with([
            'class_years' => $class_years,
            'academic_calendars' => $academic_calendars,
            'semesters' => $semesters
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
            'class_year' => 'required',
            'academic_calendar' => 'required',
            'semester' => 'required', 
            'exam_start_date' => 'required'   
        ]);
 
       $academic_calendar_id = $request->academic_calendar;
       $semester_id = $request->semester;
       $class_year_id = $request->class_year;
       $exam_start_date = $request->exam_start_date;

       // Find Student Classes
       $student_classes = StudentClass::where([
        'academic_calendar_id' => $academic_calendar_id,
        'semester_id' => $semester_id,
        'class_year_id' => $class_year_id
       ])->get();

      if($student_classes->count() == 0) {
            return redirect()->back()->with('error', 'No Student Classes found for the selected criteria.');
        } else {
            $student_class_ids = $student_classes->pluck('id')->toArray();
            $class_section_allocation_counts = ClassSectionAllocation::whereIn('student_class_id', $student_class_ids)->count();
            if($class_section_allocation_counts == 0) {
                return redirect()->back()->with('error', 'No Class Section Allocations found for the selected criteria.');
            } else {
                foreach($student_classes as $student_class)
                {
                    // Find class section allocation
                    $class_section_allocations = ClassSectionAllocation::where('student_class_id', $student_class->id)->get();
                    // check for teacher allocation
                    $teacher_allocation_counts = TeacherAllocation::whereIn('class_section_allocation_id', $class_section_allocations->pluck('id'))->count();

                    if($teacher_allocation_counts == 0) {
                        return redirect()->back()->with('error', 'No Teacher Allocations found for the selected criteria.');
                    } else {
                        foreach($class_section_allocations as $class_section_allocation)
                        {
                            // Find teacher allocations
                            $teacher_allocations = TeacherAllocation::where('class_section_allocation_id', $class_section_allocation->id)->orderBy('period_per_week', 'desc')->get();
                            if($teacher_allocations->count() == 0) {
                                return redirect()->back()->with('error', 'No Teacher Allocations found for the selected criteria.');
                            }

                            $start_date = Carbon::parse($exam_start_date);
                            ;
                            foreach($teacher_allocations as $key => $teacher_allocation)
                            {
                                if($key != 0) {
                                    $start_date = $start_date->addDays(2);
                                }     

                                // Check if exam timetable already exists
                                $check_for_exam_timetable = ExamTimetable::where('teacher_allocation_id', $teacher_allocation->id)->first(); 
                                
                                if($check_for_exam_timetable == null) {
                                    $exam_timetable = new ExamTimetable;
                                    $exam_timetable->teacher_allocation_id = $teacher_allocation->id;
                                    $exam_timetable->exam_date = $start_date;
                                    $exam_timetable->save();
                                } else {
                                    $check_for_exam_timetable->exam_date = $start_date;
                                    $check_for_exam_timetable->save();
                                }
                            }   
                    }   
                }
            }
        }

        return redirect()->route('exam_timetables.index')->with('success', 'Exam timetable generated successfully.');
    }
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
        //
    }
}
