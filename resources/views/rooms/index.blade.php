@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Rooms</h4>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if ($rooms->count() > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Building</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $key => $room)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $room->name }}</td>
                <td>{{ $room->building->name }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
            
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
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