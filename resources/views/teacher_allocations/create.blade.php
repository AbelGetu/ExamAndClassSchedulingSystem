@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new class section</h4>
    </div>

    <form action="{{ route('teacher_allocations.store') }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="class">Select Class</label>
                <select name="class" class="form-control" required>
                    <option value="">-- Select class ---</option>
                    @foreach ($class_section_allocations as $class_section_allocation)
                        <option value="{{ $class_section_allocation->student_class->id }}">
                            {{ $class_section_allocation->student_class->department->name }} | 
                            {{ $class_section_allocation->student_class->academic_calendar->name }} | 
                            {{ $class_section_allocation->student_class->semester->name }} | 
                            {{ $class_section_allocation->section->name }} |
                            {{ $class_section_allocation->student_class->class_year->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="class">Select Subject</label>
                <select name="subject" class="form-control" required>
                    <option value="">-- Select subject ---</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="class">Select Teacher</label>
                <select name="user" class="form-control" required>
                    <option value="">-- Select teacher ---</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="periods_per_week">Periods per week</label>
                <input type="number" name="periods_per_week" class="form-control" placeholder="Periods per week" required>
            </div>
           

            <div class="form-group mb-3">
                @csrf
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection