@if(session('alert-danger'))
    <div class="alert alert-danger text-center">
        {{ session('alert-danger') }}
    </div>
@endif

@if(session('alert-warning'))
    <div class="alert alert-warning text-center">
        {{ session('alert-warning') }}
    </div>
@endif

@if(session('alert-success'))
    <div class="alert alert-success text-center">
        {{ session('alert-success') }}
    </div>
@endif
