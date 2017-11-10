@section('stylesheets')
    {{-- Datetime picker --}}
    <link rel="stylesheet" href="{{ URL::asset('lib/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@endsection

<p class="text-center"><strong>{{$car->getName()}}</strong></p>

{{-- Field start_time --}}
<div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
    {{ Form::labelField('start_time', __('form.ride_label_start_time')) }}
    <div class="col-md-6">
        <div class='input-group date datetimepicker'>
            <input id='start_time' name='start_time' type='text' class="form-control" required autofocus />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        {!! Form::inputError('start_time', $errors) !!}
    </div>
</div>

{{-- Field source city --}}
<div class="form-group{{ $errors->has('source_city') ? ' has-error' : '' }}">
    {{ Form::labelField('source_city', __('form.ride_label_source_city')) }}
    <div class="col-md-6">
        <select id="source_city" name="source_city" class="selectpicker form-control" data-live-search="true">
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
        <select id="dest_city" name="dest_city" class="selectpicker form-control" data-live-search="true">
            @foreach ($cities as $city)
                <option value="{{$city->id}}">{{$city->city}}</option>
            @endforeach
        </select>
    </div>
</div>


{{-- Field nb_seats offered --}}
<div class="form-group{{ $errors->has('nb_seats_offered') ? ' has-error' : '' }}">
    {{ Form::labelField('nb_seats_offered', __('form.ride_label_nb_seats_offered')) }}
    <div class="col-md-6">
        {{ Form::number('nb_seats_offered', null, ['class' => 'form-control', 'required autofocus value=3 min=1 max='. ($car->nb_seats-1) ]) }}
        {!! Form::inputError('nb_seats_offered', $errors) !!}
    </div>
</div>

{{-- Field price offered --}}
<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    {{ Form::labelField('price', __('form.ride_label_price')) }}
    <div class="col-md-6">
        {{ Form::number('price', null, ['class' => 'form-control', 'step="any" required autofocus min=0']) }}
        {!! Form::inputError('price', $errors) !!}
    </div>
</div>

{{-- Field Luggage size --}}
<div class="form-group{{ $errors->has('luggage_size') ? ' has-error' : '' }}">
    {{ Form::labelField('luggage_size', __('form.ride_label_luggage_size')) }}
    <div class="col-md-6">
        <select id="luggage_size" name="luggage_size" class="form-control" data-live-search="true">
            <option value="1">@lang('form.luggage_size_small')</option>
            <option value="2">@lang('form.luggage_size_medium')</option>
            <option value="3">@lang('form.luggage_size_large')</option>
        </select>
    </div>
</div>


{{-- Submit --}}
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {{ Form::submit(__('form.save'), ['class' => 'btn btn-primary']) }}
    </div>
</div>



@section('scripts')
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

        $('.datetimepicker input').click(function(event){
           $('.datetimepicker ').data("DateTimePicker").show();
        });
    </script>
@endsection