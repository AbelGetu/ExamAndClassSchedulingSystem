<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Period;
use App\Models\Semester;
use App\Models\ClassYear;
use App\Models\Timetable;
use App\Models\Department;
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
        $academic_calendars = AcademicCalendar::orderBy('created_at', 'desc')->get();
        $semesters = Semester::orderBy('name')->get();
        $class_years = ClassYear::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('timetables.index')->with([
            'academic_calendars' => $academic_calendars,
            'semesters' => $semesters,
            'class_years' => $class_years,
            'departments' => $departments,
            'student_class' => null,
            'days' => Day::orderBy('order')->get(),
            'periods' => Period::orderBy('order')->get()
        ]);
    }

    public function getTimetables(Request $request)
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
            // foreach($student_class->class_section_allocations as $class_section_allocation)
            // {
            //     $timetable = collect();
            //     $timetable->put('academic_calendar_name', $student_class->academic_calendar->name);
            //     $timetable->put('semester_name', $student_class->semester->name);
            //     $timetable->put('class_year_name', $student_class->class_year->name);
            //     $timetable->put('department_name', $student_class->department->name);
            //     $timetable->put('section_name', $class_section_allocation->section->name);
            //     $timetable->put('room_name', $class_section_allocation->section_allocation->room->name);

            //     $teacher_allocation_ids = $class_section_allocation->teacher_allocations->pluck('id')->toArray();

            //     foreach($teacher_allocation_ids as $teacher_allocation_id)
            //     {

            //     }
                
            //     // I don't know how to do this
            //     // $schedules = collect();

            //     // $days = Day::orderBy('order')->get();
            //     // foreach($days as $day)
            //     // {
            //     //     $schedule = collect();
            //     //     $periods = Period::orderBy('order')->get();

            //     //     foreach($periods as $period)
            //     //     {
            //     //         // Check for timetable
            //     //         $timetable_info = Timetable::whereIn('teacher_allocation_id', $teacher_allocation_ids)->where([
            //     //             'day_id' => $day->id,
            //     //             'period_id' => $period->id
            //     //         ])->with([
            //     //             'teacher_allocation.user', 'subject'
            //     //         ])->first();

            //     //         if($timetable_info != null) {
            //     //             $schedule->put($day->name.$period->name, $timetable_info->subject->name . " | " . $timetable_info->subject->code);
            //     //             $schedules->push($schedule);
            //     //         } else {
            //     //             $schedules->push($schedule);
            //     //         }                        
            //     //     }

            //     //     dd($schedules);
            //     }
            // }

            $academic_calendars = AcademicCalendar::orderBy('created_at', 'desc')->get();
            $semesters = Semester::orderBy('name')->get();
            $class_years = ClassYear::orderBy('name')->get();
            $departments = Department::orderBy('name')->get();

            return view('timetables.index')->with([
                'academic_calendars' => $academic_calendars,
                'semesters' => $semesters,
                'class_years' => $class_years,
                'departments' => $departments,
                'student_class' => $student_class,
                'days' => Day::orderBy('order')->get(),
                'periods' => Period::orderBy('order')->get()
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
                            
                            foreach($teacher_allocations as $teacher_allocation)
                            {
                                $periods_per_week = $teacher_allocation->period_per_week;
                                                             
                                    // check for how many periods per week are not allocated
                                    $check_for_unallocated_periods = $this->check_for_unallocated_periods($teacher_allocation);
                                    if($check_for_unallocated_periods) {
                                        $days = Day::orderBy('order')->get();
                                        
                                        foreach($days as $day)
                                        {
                                            // check for subject if already allocated
                                            $check_for_already_allocated_subject = $this->check_for_already_allocated_subject($teacher_allocation->id, $day->id, $teacher_allocation->subject_id, $class_section_allocation->section_allocation->room_id);
                                            if($check_for_already_allocated_subject) {
                                                continue;                                                
                                            } else {
                                                $periods = Period::orderBy('order')->get();
                                                foreach($periods as $period)
                                                {
                                                    $is_teacher_free = $this->is_teacher_free($teacher_allocation->user_id, $period->id, $day->id);
                                                    if($is_teacher_free) {
                                                        $is_period_free = $this->is_period_free($period->id, $day->id, $class_section_allocation->id);
                                                        if($is_period_free) {
                                                            $is_room_free = $this->is_room_free($period->id, $day->id, $class_section_allocation->id);
                                                                if($is_room_free) {
                                                                    // $check_for_unallocated_periods = $this->check_for_unallocated_periods($teacher_allocation);
                                                                    $check_for_already_allocated_subject = $this->check_for_already_allocated_subject($teacher_allocation->id, $day->id, $teacher_allocation->subject_id, $class_section_allocation->section_allocation->room_id);
                                                                    if(!$check_for_already_allocated_subject) {
                                                                        $count_allocated_periods = TimeTable::where('teacher_allocation_id', $teacher_allocation->id)->count();
                                                                        if($count_allocated_periods < $periods_per_week) {
                                                                            $timetable = new Timetable;
                                                                            $timetable->teacher_allocation_id = $teacher_allocation->id;
                                                                            $timetable->day_id = $day->id;
                                                                            $timetable->period_id = $period->id;
                                                                            $timetable->day_order = $day->order;
                                                                            $timetable->period_order = $period->order;
                                                                            $timetable->room_id = $class_section_allocation->section_allocation->room_id;
                                                                            $timetable->subject_id = $teacher_allocation->subject_id;
                                                                            $timetable->save();
                                                                        }
                                                                       
                                                                    }
                                                                    
                                                                } else {
                                                                    continue;
                                                                } 
                                                        } else {
                                                            continue;
                                                        }
                                                    }  else {
                                                        continue;
                                                    }                                                  
                                                       
                                                    // dd("is teacher free", $is_teacher_free);
                                                    // dd("is period free", $is_period_free);
                                                    // dd("is room free", $is_room_free);
                                                        // if($is_teacher_free == true && $is_period_free == true && $is_room_free == true) {
                                                           
                                                            

                                                        //     dd('timetable created');
                                                            
                                                        // }
                                                }
                                            }
                                            
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

    public function check_for_already_allocated_subject($teacher_allocation_id, $day_id, $subject_id, $room_id)
    {
    //    $teacher_allocation_ids = TeacherAllocation::where([
    //     'class_section_allocation_id' => $class_section_allocation_id,
    //     'subject_id' => $subject_id
    //     ])->pluck('id')->toArray();

         $timetables = Timetable::where([
            'day_id' => $day_id,
            'room_id' => $room_id,
            'teacher_allocation_id' => $teacher_allocation_id,
            'subject_id' => $subject_id
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
