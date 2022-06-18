@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Class Section Allocations</h4>
        <a href="{{ route('class_section_allocations.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($class_section_allocations->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Department</th>
            <th scope="col">Section</th>
            <th scope="col">Year</th>
            <th scope="col">Academic Calendar</th>
            <th scope="col">Semester</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($class_section_allocations as $key => $class_section_allocation)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $class_section_allocation->student_class->department->name }}</td>
                <td>{{ $class_section_allocation->section->name }}</td>
                <td>{{ $class_section_allocation->student_class->class_year->name }}</td>
                <td>{{ $class_section_allocation->student_class->academic_calendar->name }}</td>
                <td>{{ $class_section_allocation->student_class->semester->name }}</td>
                <td class="d-flex gap-2">            
                    <form action="{{ route('class_section_allocations.destroy', $class_section_allocation->id) }}" method="POST">
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