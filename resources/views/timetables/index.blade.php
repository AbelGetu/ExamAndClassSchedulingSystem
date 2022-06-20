@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Timetables</h4>
        <a href="{{ route('timetables.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    <form action="{{ route('get_timetable') }}" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="academic_calendar">Select Academic Calendar</label>
                    <select name="academic_calendar" class="form-control" required>
                        <option value="">-- Select Academic Calendar ---</option>
                        @foreach ($academic_calendars as $academic_calendar)
                            <option value="{{ $academic_calendar->id }}">{{ $academic_calendar->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="semester">Select Semester</label>
                    <select name="semester" class="form-control" required>
                        <option value="">-- Select Semester ---</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="class_year">Select Class Year</label>
                    <select name="class_year" class="form-control" required>
                        <option value="">-- Select Class Year ---</option>
                        @foreach ($class_years as $class_year)
                            <option value="{{ $class_year->id }}">{{ $class_year->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="department">Select Department</label>
                    <select name="department" class="form-control" required>
                        <option value="">-- Select Department ---</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-primary mt-4">Show</button>
                </div>
            </div>
        </div>
       
    </form>

    @if ($student_class != null)
        <div class="card card-body m-2">
            <h4 class="card-title">{{ $student_class->department->name }} | {{ $student_class->academic_calendar->name }} | {{ $student_class->semester->name }} | {{ $student_class->class_year->name }}</h4>
            @if ($student_class->class_section_allocations->count() > 0)
                @foreach ($student_class->class_section_allocations as $class_section_allocation)
                    <div class="card card-body">
                        <h5>Section: {{ $class_section_allocation->section->name }} [Room: {{$class_section_allocation->section_allocation->room->name}}]</h5>

                        @foreach ($class_section_allocation->teacher_allocations as $teacher_allocation)
                            <p class="lead">{{$teacher_allocation->user->name}} | {{ $teacher_allocation->subject->name }}</p>
                            <div class="d-flex gap-1">
                                @foreach ($teacher_allocation->timetables()->orderBy('day_order')->orderBy('period_order')->get() as $timetable)
                                <div class="card card-body">
                                    {{ $timetable->day->name }} [{{ $timetable->period->name }}]
                                </div>
                                @endforeach
                            </div>
                            
                                    
                                
                           
                        @endforeach
                    </div>
                    
                @endforeach
            @else
                <p class="lead">No Section Found</p>
            @endif
        </div>
    @else
        <div class="card card-body m-2">
            <h4>No Data Found</h4>
        </div>
    @endif
</div>
@endsection