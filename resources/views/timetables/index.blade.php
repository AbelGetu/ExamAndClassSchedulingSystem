@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Timetables</h4>
        <a href="{{ route('timetables.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

</div>
@endsection