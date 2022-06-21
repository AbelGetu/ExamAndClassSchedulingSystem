@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>My Timetables</h4>
    </div>

    @if ($teacher_allocations->count() > 0)
        @foreach ($teacher_allocations as $teacher_allocation)
            <p class="lead">{{$teacher_allocation->user->name}} | {{ $teacher_allocation->subject->name }} | Section: {{ $teacher_allocation->class_section_allocation->section->name }} [Room: {{$teacher_allocation->class_section_allocation->section_allocation->room->name}}] | {{ $teacher_allocation->class_section_allocation->student_class->department->name }} | {{ $teacher_allocation->class_section_allocation->student_class->academic_calendar->name }} | {{ $teacher_allocation->class_section_allocation->student_class->semester->name }} | {{ $teacher_allocation->class_section_allocation->student_class->class_year->name }}</p>
            <div class="d-flex gap-1">
                @foreach ($teacher_allocation->timetables()->orderBy('day_order')->orderBy('period_order')->get() as $timetable)
                    <div class="card card-body">
                        {{ $timetable->day->name }} [{{ $timetable->period->name }}]
                    </div>
                @endforeach
            </div> 
        @endforeach        
    @else
        <div class="card card-bdoy">
            No Teacher Allocation Found
        </div>
    @endif
</div>
@endsection