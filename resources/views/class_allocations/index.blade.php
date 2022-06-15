@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Class Allocations</h4>
        <a href="{{ route('class_allocations.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($class_allocations->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Room</th>
            <th scope="col">Building</th>
            <th scope="col">Academic Calendar</th>
            <th scope="col">Semester</th>
            <th scope="col">Department</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($class_allocations as $key => $class_allocation)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $class_allocation->room->name }}</td>
                <td>{{ $class_allocation->room->building->name }}</td>
                <td>{{ $class_allocation->student_class->academic_calendar->name }}</td>
                <td>{{ $class_allocation->student_class->semester->name }}</td>
                <td>{{ $class_allocation->student_class->department->name }}</td>
                <td class="d-flex gap-2">   
                    <form action="{{ route('class_allocations.destroy', $class_allocation->id) }}" method="POST">
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