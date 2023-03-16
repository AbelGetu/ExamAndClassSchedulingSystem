@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new department</h4>
    </div>

    <form action="{{ route('departments.store') }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="college">Select College</label>
                <select name="college" class="form-control" required>
                    <option value="">-- Select Collge ---</option>
                    @foreach ($colleges as $college)
                        <option value="{{ $college->id }}">{{ $college->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" required>
            </div>
    
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email">
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" placeholder="Phone Number" name="phone">
            </div>

            <div class="form-group mb-3">
                <label for="website">Website</label>
                <input type="text" class="form-control" placeholder="Website" name="website">
            </div>

            <div class="form-group mb-3">
                @csrf
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection