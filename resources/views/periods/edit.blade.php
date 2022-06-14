@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Edit period</h4>
    </div>

    <form action="{{ route('periods.update', $period->id) }}" method="POST">
        <div class="card card-body w-75">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $period->name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="order">Order</label>
                        <input type="number" min="1" class="form-control" placeholder="Order" name="order" value="{{ $period->order }}" required>
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