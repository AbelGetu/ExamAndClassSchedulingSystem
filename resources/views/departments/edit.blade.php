@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Edit Department</h4>
    </div>

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="department">Select department</label>
                <select name="department" class="form-control" required>
                    <option value="">-- Select department ---</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $department->name }}" required>
            </div>
    
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $department->email }}">
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{ $department->phone }}">
            </div>


            <div class="form-group mb-3">
                <label for="website">Website</label>
                <input type="text" class="form-control" placeholder="Website" name="website" value="{{ $department->website }}">
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