@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Academic Calendars</h4>

        <a href="{{ route('academic_calendars.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($academic_calendars->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($academic_calendars as $key => $academic_calendar)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $academic_calendar->name }}</td>
                <td>{{ $academic_calendar->start_date }}</td>
                <td>{{ $academic_calendar->end_date }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('academic_calendars.edit', $academic_calendar->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('academic_calendars.destroy', $academic_calendar->id) }}" method="POST">
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