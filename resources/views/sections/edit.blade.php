@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Update section</h4>
    </div>

    <form action="{{ route('sections.update', $section->id) }}" method="POST">
        <div class="card card-body w-75">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $section->name }}" required>
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