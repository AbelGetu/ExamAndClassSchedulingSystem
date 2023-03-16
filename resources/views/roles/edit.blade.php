@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Create new Role</h4>
    </div>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        <div class="card card-body w-75">
            <div class="form-group mb-3">
                <label for="name">Role Name</label>
                <input type="text" class="form-control" placeholder="Role Name" name="name" value="{{ $role->name }}" required>
            </div>
    
            <div class="form-group mb-3">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection