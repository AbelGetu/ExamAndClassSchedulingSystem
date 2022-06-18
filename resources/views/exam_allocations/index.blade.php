@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Exam Allocations</h4>
        <a href="{{ route('exam_allocations.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($exam_allocations->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Department</th>
            <th scope="col">Course</th>
            <th scope="col">Weight</th>
            <th scope="col">Section</th>
            <th scope="col">Year</th>
            <th scope="col">Academic Calendar</th>
            <th scope="col">Semester</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($exam_allocations as $key => $exam_allocation)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $exam_allocation->class_section_allocation->student_class->department->name }}</td>
                <td>{{ $exam_allocation->subject->name }}</td>
                <td>{{ $exam_allocation->weight }}</td>
                <td>{{ $exam_allocation->class_section_allocation->section->name }}</td>
                <td>{{ $exam_allocation->class_section_allocation->student_class->class_year->name }}</td>
                <td>{{ $exam_allocation->class_section_allocation->student_class->academic_calendar->name }}</td>
                <td>{{ $exam_allocation->class_section_allocation->student_class->semester->name }}</td>
                <td class="d-flex gap-2">            
                    <form action="{{ route('exam_allocations.destroy', $exam_allocation->id) }}" method="POST">
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