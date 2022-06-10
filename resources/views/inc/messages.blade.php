@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success m-2">
        <button type="button" class="close" data-dismiss="alert">×</button>
       {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger m-2">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{session('error')}}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info m-2">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{session('info')}}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning m-2">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{session('warning')}}
    </div>
@endif
