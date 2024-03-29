@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Edit Course</h4>
    </div>

    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        <div class="card card-body w-75">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $subject->name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="code">Course Code</label>
                        <input type="text" class="form-control" placeholder="Course Code" name="code" value="{{ $subject->code }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="credit_hour">Credit Hour</label>
                        <input type="text" class="form-control" placeholder="Credit Hour" name="credit_hour" value="{{ $subject->credit_hour }}" required>
                    </div>
                    <div class="form-group mb-3 d-flex justify-content-end">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection