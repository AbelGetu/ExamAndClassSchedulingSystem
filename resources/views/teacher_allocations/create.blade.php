@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new teacher allocation</h4>
    </div>

    <form action="{{ route('teacher_allocations.store') }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="student_class">Select class</label>
                <select name="student_class" class="form-control" required>
                    <option value="">-- Select class ---</option>
                    @foreach ($student_classes as $student_class)
                        <option value="{{ $student_class->id }}">{{ $student_class->academic_calendar->name | $student_class->semester->name | $student_class->department->name }}</option>
                    @endforeach
                </select>
            </div>
           
            <div class="form-group mb-3">
                <label for="subject">Select Subject</label>
                <select name="subject" class="form-control" required>
                    <option value="">-- Select subject ---</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="teacher">Select Teacher</label>
                <select name="teacher" class="form-control" required>
                    <option value="">-- Select teacher ---</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="periods_per_week">Periods per week</label>
                <input type="number" class="form-control" name="periods_per_week" placeholder="periods_per_week" required>
            </div>

            <div class="form-group mb-3">
                @csrf
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection