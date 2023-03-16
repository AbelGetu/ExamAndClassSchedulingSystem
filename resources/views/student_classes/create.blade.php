@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new class</h4>
    </div>

    <form action="{{ route('student_classes.store') }}" method="POST">
        <div class="card card-body w-75">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="class_year">Select class year</label>
                        <select name="class_year" class="form-control" required>
                            <option value="">-- Select class year ---</option>
                            @foreach ($class_years as $class_year)
                                <option value="{{ $class_year->id }}">{{ $class_year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="academic_calendar">Select academic calendar</label>
                        <select name="academic_calendar" class="form-control" required>
                            <option value="">-- Select academic calendar ---</option>
                            @foreach ($academic_calendars as $academic_calendar)
                                <option value="{{ $academic_calendar->id }}">{{ $academic_calendar->name }}</option>
                            @endforeach
                        </select>
                    </div>
                   
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="semester">Select semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="">-- Select semester ---</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="department">Select department</label>
                        <select name="department" class="form-control" required>
                            <option value="">-- Select department ---</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3 d-flex justify-content-end">
                        @csrf
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection