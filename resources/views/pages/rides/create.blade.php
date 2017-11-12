@extends('forms.default_form', ['form_title' => __('form.ride_create')])

@include('forms.macros')

@section('form')
	{!! $ride = null; !!}
    {{ Form::model($ride, ['class' => 'form-horizontal', 'method'=> 'POST', 'route' => ['rides.store']]) }}
        @include('pages.rides.partial_form')


        {{-- Frequency option --}}
        <div id="frequency_div" class="form-group">
			{{ Form::labelField('frequency', __('form.ride_frequency')) }}        			
    		<div class="col-md-6">
    			<div class="row">
    				<div class="col-xs-5">
		    	      <select disabled class="form-control" name="frequency_value" id="frequency_value">
		    	      	@for ($i = 0; $i < 13; $i++)
		    	        	<option value="{{ $i }}">{{ $i }}</option>
		    	      	@endfor
		    	      </select>
    				</div>
    				<div class="col-xs-6">
		    	      <select disabled class="form-control" name="frequency" id="frequency">
			        	<option value="d">@lang('form.day')</option>
		    	        <option value="w">@lang('form.week')</option>
		    	        <option value="m">@lang('form.month')</option>
		    	      </select>
    	  			</div>	
    				<div class="col-xs-1">
			    	  	<a href="#" id="close_frequency">
			    	  	  <span aria-hidden="true">&#10006;</span>
			    	  	</a>
    	  			</div>	
    	  		</div>	
    	  	</div>
    	</div>

        {{-- Submit --}}
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {{ Form::submit(__('form.save'), ['class' => 'btn btn-primary']) }}
                <a id="show_frequency" href="#">@lang('form.ride_repeat')</a>
            </div>
        </div>

    {{ Form::close() }}
@endsection

<script type="text/javascript">
	window.onload = function () { 

		$('#frequency_div').hide();

		$('#show_frequency').click( function(e) {
			e.preventDefault(); 
			$('#frequency_div').show();
			$("#frequency").prop('disabled', false);
			$("#frequency_value").prop('disabled', false);
			$("#frequency").prop('required', true);
			$("#frequency_value").prop('required', true);
			return false; 
		});

		$('#close_frequency').click(function(e) {
			$('#frequency_div').hide();
			$("#frequency").prop('disabled', true);
			$("#frequency_value").prop('disabled', true);
			$("#frequency").prop('required', false);
			$("#frequency_value").prop('required', false);
		});
	}
</script>