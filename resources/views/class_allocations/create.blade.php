@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new class allocation</h4>
    </div>

    <form action="{{ route('class_allocations.store') }}" method="POST">
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
                <label for="room">Select Room</label>
                <select name="room" class="form-control" required>
                    <option value="">-- Select Room ---</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->building->name | $room->name }}</option>
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