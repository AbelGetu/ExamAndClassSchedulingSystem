@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Teacher Allocations</h4>
        <a href="{{ route('teacher_allocations.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($teacher_allocations->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Subject</th>
            <th scope="col">Periods per week</th>
            <th scope="col">Teacher</th>
            <th scope="col">Academic Calendar</th>
            <th scope="col">Semester</th>
            <th scope="col">Department</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($teacher_allocations as $key => $teacher_allocation)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $teacher_allocation->subject->name }}</td>
                <td>{{ $teacher_allocation->periods_per_week }}</td>
                <td>{{ $teacher_allocation->user->name }}</td>
                <td>{{ $teacher_allocation->student_class->academic_calendar->name }}</td>
                <td>{{ $teacher_allocation->student_class->semester->name }}</td>
                <td>{{ $teacher_allocation->student_class->department->name }}</td>
                <td class="d-flex gap-2">   
                    <form action="{{ route('teacher_allocations.destroy', $teacher_allocation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>                 
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    @else
        <div class="card card-body">
            <h6 class="m-2">No Data Found</h6>
        </div>
    @endif
</div>
@endsection