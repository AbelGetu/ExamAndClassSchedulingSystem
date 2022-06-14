@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Classes</h4>

        <a href="{{ route('student_classes.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($student_classes->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Department</th>
            <th scope="col">Class Year</th>
            <th scope="col">Academic Calendar</th>
            <th scope="col">Semester</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($student_classes as $key => $student_class)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $student_class->department->name }}</td>
                <td>{{ $student_class->class_year->name }}</td>
                <td>{{ $student_class->academic_calendar->name }}</td>
                <td>{{ $student_class->semester->name }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('student_classes.edit', $student_class->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('student_classes.destroy', $student_class->id) }}" method="POST">
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