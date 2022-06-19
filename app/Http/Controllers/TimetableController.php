<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Period;
use App\Models\Semester;
use App\Models\ClassYear;
use App\Models\Timetable;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AcademicCalendar;
use App\Models\TeacherAllocation;
use App\Models\ClassSectionAllocation;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timetables = Timetable::orderBy('day_order', 'asc')->orderBy('period_order')->with([
            'teacher_allocation'
        ])->get();

        return view('timetables.index')->with('timetables', $timetables);
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

        return view('timetables.create')->with([
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
        ]);
 
       $academic_calendar_id = $request->academic_calendar;
       $semester_id = $request->semester;
       $class_year_id = $request->class_year;

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
            $class_section_allocation_counts = ClassSectionAllocation::whereIn('id', $student_class_ids)->count();
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
                            
                            foreach($teacher_allocations as $teacher_allocation)
                            {
                                $periods_per_week = $teacher_allocation->period_per_week;
                                while($periods_per_week > 0) {
                                    // check for how many periods per week are not allocated
                                    $check_for_unallocated_periods = $this->check_for_unallocated_periods($teacher_allocation);
                                    if($check_for_unallocated_periods == true) {
                                        $days = Day::orderBy('order')->get();
                                        foreach($days as $day)
                                        {
                                            // check for subject if already allocated
                                            $check_for_already_allocated_subject = $this->check_for_already_allocated_subject($class_section_allocation->id, $day->id, $teacher_allocation->subject_id);
                                            if(!$check_for_already_allocated_subject) {
                                                $periods = Period::orderBy('order')->get();
                                                foreach($periods as $period)
                                                {
                                                    $is_teacher_free = $this->is_teacher_free($teacher_allocation->user_id, $period->id, $day->id);
                                                   
                                                        $is_period_free = $this->is_period_free($period->id, $day->id, $class_section_allocation->id);
                                                        $is_room_free = $this->is_room_free($period->id, $day->id, $class_section_allocation->id);
                                                       
                                                        if($is_teacher_free == true && $is_period_free == true && $is_room_free == true) {
                                                           
                                                            $timetable = new Timetable;
                                                            $timetable->teacher_allocation_id = $teacher_allocation->id;
                                                            $timetable->day_id = $day->id;
                                                            $timetable->period_id = $period->id;
                                                            $timetable->day_order = $day->order;
                                                            $timetable->period_order = $period->order;
                                                            $timetable->room_id = $class_section_allocation->section_allocation->room_id;
                                                            $timetable->save();
                                                        }
                                                }
                                            }
                                            
                                    }

                                    $periods_per_week--;
                                }
                            }
                        }
                    }   
                }
            }
        }

        return redirect()->route('timetables.index')->with('success', 'Timetable generated successfully.');
    }
    }

    public function check_for_already_allocated_subject($class_section_allocation_id, $day_id, $subject_id)
    {
       $teacher_allocation_ids = TeacherAllocation::where([
        'class_section_allocation_id' => $class_section_allocation_id,
        'subject_id' => $subject_id
        ])->pluck('id')->toArray();

         $timetables = Timetable::whereIn('teacher_allocation_id', $teacher_allocation_ids)->where([
            'day_id' => $day_id
         ])->get();

        if($timetables->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function check_for_unallocated_periods($teacher_allocation)
    {
        $allocated_periods = Timetable::where('teacher_allocation_id', $teacher_allocation->teacher_allocation_id)->get();
        $allocated_periods_count = $allocated_periods->count();
        if($allocated_periods_count === $teacher_allocation->periods_per_week) {
            return false;
        } else {
            return true;
        }
    }

    public function is_teacher_free($user_id, $period_id, $day_id)
    {
        $teacher_allocations = TeacherAllocation::where('user_id', $user_id)->get();
        $check_if_teacher_is_free = Timetable::whereIn('teacher_allocation_id', $teacher_allocations->pluck('id'))->where([
            'period_id' => $period_id,
            'day_id' => $day_id
        ])->get();
        if($check_if_teacher_is_free->count() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_period_free($period_id, $day_id, $class_section_allocation_id)
    {
        $teacher_allocation_ids = TeacherAllocation::where('class_section_allocation_id', $class_section_allocation_id)->pluck('id')->toArray();
        $check_if_period_is_free = Timetable::whereIn('teacher_allocation_id', $teacher_allocation_ids)->where([
            'period_id' => $period_id,
            'day_id' => $day_id
        ])->get();

        if($check_if_period_is_free->count() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_room_free($room_id, $day_id, $class_section_allocation_id)
    {
        $teacher_allocation_ids = TeacherAllocation::where('class_section_allocation_id', $class_section_allocation_id)->pluck('id')->toArray();
        $check_if_room_is_free = Timetable::whereIn('teacher_allocation_id', $teacher_allocation_ids)->where([
            'room_id' => $room_id,
            'day_id' => $day_id
        ])->get();

        if($check_if_room_is_free->count() == 0) {
            return true;
        } else {
            return false;
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
