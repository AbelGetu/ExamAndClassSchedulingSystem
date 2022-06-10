@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Institutes</h4>

        @if ($institutes->count() == 0)
            <a href="{{ route('institutes.create') }}" class="btn btn-primary">+ Add New</a>
        @endif
    </div>

    @if ($institutes->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">City</th>
            <th scope="col">State</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($institutes as $key => $institute)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $institute->name }}</td>
                <td>{{ $institute->address }}</td>
                <td>{{ $institute->city }}</td>
                <td>{{ $institute->state }}</td>
                <td>{{ $institute->phone }}</td>
                <td>{{ $institute->email }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('institutes.edit', $institute->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('institutes.destroy', $institute->id) }}" method="POST">
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