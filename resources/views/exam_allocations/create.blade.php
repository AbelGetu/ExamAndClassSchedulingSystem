@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new exam allocation</h4>
    </div>

    <form action="{{ route('exam_allocations.store') }}" method="POST">
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
                <label for="weight">Weight</label>
                <input type="number" class="form-control" name="weight" placeholder="Weight" required>
            </div>

            <div class="form-group mb-3">
                @csrf
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection