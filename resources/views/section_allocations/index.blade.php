@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Section Allocations</h4>
        <a href="{{ route('section_allocations.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($section_allocations->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Department</th>
            <th scope="col">Section</th>
            <th scope="col">Year</th>
            <th scope="col">Academic Calendar</th>
            <th scope="col">Semester</th>
            <th scope="col">Room</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($section_allocations as $key => $section_allocation)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $section_allocation->class_section_allocation->student_class->department->name }}</td>
                <td>{{ $section_allocation->class_section_allocation->section->name }}</td>
                <td>{{ $section_allocation->class_section_allocation->student_class->class_year->name }}</td>
                <td>{{ $section_allocation->class_section_allocation->student_class->academic_calendar->name }}</td>
                <td>{{ $section_allocation->class_section_allocation->student_class->semester->name }}</td>
                <td>{{ $section_allocation->room->name }}</td>
                <td class="d-flex gap-2">            
                    <form action="{{ route('section_allocations.destroy', $section_allocation->id) }}" method="POST">
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