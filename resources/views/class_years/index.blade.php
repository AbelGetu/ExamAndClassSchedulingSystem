@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Class Years</h4>

        <a href="{{ route('class_years.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($class_years->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($class_years as $key => $class_year)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $class_year->name }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('class_years.edit', $class_year->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('class_years.destroy', $class_year->id) }}" method="POST">
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