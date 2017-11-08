@if (session('status_success'))
    <div class="alert alert-success alert-dismissable fade in text-center">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('status_success') }}
    </div>
@endif

@if (session('status_danger'))
    <div class="alert alert-danger alert-dismissable fade in text-center">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('status_danger') }}
    </div>
@endif