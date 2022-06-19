@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new class section</h4>
    </div>

    <form action="{{ route('section_allocations.store') }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="class_section_allocation">Select Class</label>
                <select name="class_section_allocation" class="form-control" required>
                    <option value="">-- Select class ---</option>
                    @foreach ($class_section_allocations as $class_section_allocation)
                        <option value="{{ $class_section_allocation->id }}">{{ $class_section_allocation->student_class->department->name }} | {{ $class_section_allocation->student_class->academic_calendar->name }} | {{ $class_section_allocation->student_class->semester->name }} | {{ $class_section_allocation->student_class->class_year->name }} - {{ $class_section_allocation->section->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="class">Select Room</label>
                <select name="room" class="form-control" required>
                    <option value="">-- Select room ---</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
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