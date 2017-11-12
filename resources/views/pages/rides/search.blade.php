@extends('forms.default_form', ['form_title' => __('form.ride_search')])

@include('forms.macros')


@section('stylesheets')
	{{-- Slider lib: https://cdnjs.com/libraries/bootstrap-slider --}}
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
    {{-- Datetime picker --}}
    <link rel="stylesheet" href="{{ URL::asset('lib/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@endsection


@section('form')
{{ Form::open(['class' => 'form-horizontal', 'method'=> 'POST', 'route' => ['rides.filter']]) }}

	{{-- Field source city --}}
	<div class="form-group{{ $errors->has('source_city') ? ' has-error' : '' }}">
	    {{ Form::labelField('source_city', __('form.ride_label_source_city')) }}
	    <div class="col-md-6">
	        <select id="source_city" name="source_city" class="selectpicker form-control" required autofocus data-live-search="true">
	            @foreach ($cities as $city)
	                <option value="{{$city->id}}">{{$city->city}}</option>
	            @endforeach
	        </select>
	    </div>
	</div>

	{{-- Field destination city --}}
	<div class="form-group{{ $errors->has('dest_city') ? ' has-error' : '' }}">
	    {{ Form::labelField('dest_city', __('form.ride_label_dest_city')) }}
	    <div class="col-md-6">
	        <select id="dest_city" name="dest_city" class="selectpicker form-control" required autofocus data-live-search="true">
	            @foreach ($cities as $city)
	                <option value="{{$city->id}}">{{$city->city}}</option>
	            @endforeach
	        </select>
	    </div>
	</div>

	{{-- Field nb_seats offered --}}
	<div class="form-group{{ $errors->has('nb_seats_offered') ? ' has-error' : '' }}">
	    {{ Form::labelField('nb_seats_offered', __('form.ride_label_nb_seats_offered_minimal')) }}
	    <div class="col-md-6">
	        {{ Form::number('nb_seats_offered', null, ['class' => 'form-control', 'autofocus value=1 min=1 max=10']) }}
	        {!! Form::inputError('nb_seats_offered', $errors) !!}
	    </div>
	</div>

	{{-- Field start_time from --}}
	<div class="form-group{{ $errors->has('start_time_from') ? ' has-error' : '' }}">
	    {{ Form::labelField('start_time_from', __('form.ride_label_start_time_from')) }}
	    <div class="col-md-6">
	        <div class='input-group date datetimepicker'>
	            <input id='start_time_from' name='start_time_from' type='text' class="form-control" />
	            <span class="input-group-addon">
	                <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	        </div>
	        {!! Form::inputError('start_time_from', $errors) !!}
	    </div>
	</div>

	{{-- Field start_time to --}}
	<div class="form-group{{ $errors->has('start_time_to') ? ' has-error' : '' }}">
	    {{ Form::labelField('start_time_to', __('form.ride_label_start_time_to')) }}
	    <div class="col-md-6">
	        <div class='input-group date datetimepicker'>
	            <input id='start_time_to' name='start_time_to' type='text' class="form-control" />
	            <span class="input-group-addon">
	                <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	        </div>
	        {!! Form::inputError('start_time_to', $errors) !!}
	    </div>
	</div>
	
	{{-- Price Range --}}
	<div class="form-group{{ $errors->has('luggage_size') ? ' has-error' : '' }}">
    	{{ Form::labelField('price_range', __('form.ride_label_price_range')) }}
		<div class="col-md-6">
			<input id="price_range-enabled" checked type="checkbox"/>
			<b style="padding-right: 10px">0$</b>
			<input id="price_range" name="price_range" type="text" class="form-control" value="" data-slider-min="0" data-slider-max="300" data-slider-step="5" data-slider-value="[0,100]"/>
			<b style="padding-left: 10px">300$</b>
	    </div>
	</div>

	{{-- Field Luggage size --}}
	<div class="form-group{{ $errors->has('luggage_size') ? ' has-error' : '' }}">
	    {{ Form::labelField('luggage_size', __('form.ride_label_luggage_minimal_size')) }}
	    <div class="col-md-6">
	        <select id="luggage_size" name="luggage_size" class="form-control" data-live-search="true">
	            @foreach ($luggage_sizes as $size)
	                <option value="{{$size}}">@lang($size)</option>
	            @endforeach
	        </select>
	    </div>
	</div>

	{{-- Submit --}}
	<div class="form-group">
	    <div class="col-md-6 col-md-offset-4">
	        {{ Form::submit(__('form.save'), ['class' => 'btn btn-primary']) }}
	    </div>
	</div>
{{ Form::close() }}
@endsection

@section('scripts')

	{{-- Slider --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>
	<script type="text/javascript">
		$("#price_range").slider({
			tooltip: 'show',
			tooltip_position: 'bottom',
		});

		$("#price_range-enabled").click(function() {
			if(this.checked) {
				// With JQuery
				$("#price_range").prop('disabled', false);
				$("#price_range").slider("enable");
			}
			else {
				// With JQuery
				$("#price_range").prop('disabled', true);
				$("#price_range").slider("disable");
			}
		});
	</script>


	{{-- Datetime picker --}}
    <script type="text/javascript" src="{{ URL::asset('lib/moment/min/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('lib/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}" ></script>
    <script src="{{ URL::asset('lib/moment/locale/'. $locale . '.js')}}/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker({
                locale: '{{$locale}}',
                format: 'DD/MM/YYYY HH:mm',
                collapse:false,
                sideBySide:true,
                stepping: 15,
                defaultDate: moment().add(1, 'days')
            });
        });

        document.getElementById("source_city").selectedIndex = 1254; // Chicoutimi
        document.getElementById("dest_city").selectedIndex = 1373; // Montreal
        document.getElementById("luggage_size").selectedIndex = 1; // Montreal
    </script>
@endsection