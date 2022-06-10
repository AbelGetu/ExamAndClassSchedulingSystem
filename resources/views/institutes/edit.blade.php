@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new Institute</h4>
    </div>

    <form action="{{ route('institutes.update', $institute->id) }}" method="POST">
        <div class="card card-body w-75">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $institute->name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{ $institute->address }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" placeholder="City" name="city" value="{{ $institute->city }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" placeholder="State" name="state" value="{{ $institute->state }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" placeholder="Zip" name="zip" value="{{ $institute->zip }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{ $institute->phone }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">email</label>
                        <input type="text" class="form-control" placeholder="email" name="email" value="{{ $institute->email }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="website">website</label>
                        <input type="text" class="form-control" placeholder="website" name="website" value="{{ $institute->website }}">
                    </div>
                    <div class="form-group mb-3 d-flex justify-content-end">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection