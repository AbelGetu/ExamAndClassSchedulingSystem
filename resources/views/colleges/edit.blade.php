@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Edit College</h4>
    </div>

    <form action="{{ route('colleges.update', $college->id) }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="institute">Select Institute</label>
                <select name="institute" class="form-control" required>
                    <option value="">-- Select Institute ---</option>
                    @foreach ($institutes as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $college->name }}" required>
            </div>
    
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $college->email }}">
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{ $college->phone }}">
            </div>

            <div class="form-group mb-3">
                <label for="website">Website</label>
                <input type="text" class="form-control" placeholder="Website" name="website" value="{{ $college->website }}">
            </div>

            <div class="form-group mb-3">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection