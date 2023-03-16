@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new class section</h4>
    </div>

    <form action="{{ route('class_section_allocations.store') }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="class">Select Class</label>
                <select name="class" class="form-control" required>
                    <option value="">-- Select class ---</option>
                    @foreach ($student_classes as $student_class)
                        <option value="{{ $student_class->id }}">{{ $student_class->department->name }} | {{ $student_class->academic_calendar->name }} | {{ $student_class->semester->name }} | {{ $student_class->class_year->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="class">Select Section</label>
                <select name="section" class="form-control" required>
                    <option value="">-- Select section ---</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>
           

            <div class="form-group mb-3">
                @csrf
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection