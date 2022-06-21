@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Generate new timetable</h4>
    </div>

    <form action="{{ route('exam_timetables.store') }}" method="POST">
        <div class="card card-body w-75">          
         
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
                <label for="exam_start_date">Exam Start Date</label>
                <input type="date" name="exam_start_date" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                @csrf
                <button type="submit" class="btn btn-primary">Generate</button>
            </div>
        </div>
    </form>
</div>
@endsection