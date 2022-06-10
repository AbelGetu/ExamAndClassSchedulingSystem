@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new user</h4>
    </div>

    <form action="{{ route('users.store') }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="role">Select Role</label>
                <select name="role" class="form-control" required>
                    <option value="">-- Select Role ---</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" required>
            </div>
    
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>

            <div class="form-group mb-3">
                @csrf
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection