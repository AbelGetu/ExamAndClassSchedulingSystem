@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Days</h4>

        <a href="{{ route('days.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($days->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Order</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($days as $key => $day)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $day->name }}</td>
                <td>{{ $day->order }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('days.edit', $day->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('days.destroy', $day->id) }}" method="POST">
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