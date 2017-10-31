@if (session('status_success'))
    <div class="alert alert-success">
        {{ session('status_success') }}
    </div>
@endif

@if (session('status_danger'))
    <div class="alert alert-danger">
        {{ session('status_danger') }}
    </div>
@endif