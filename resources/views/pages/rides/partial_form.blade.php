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
        {{ Form::select('source_city', $cities, empty($ride) ? 1256 : $ride->source_city_id, ['class' => 'selectpicker form-control', 'data-live-search="true"', 'required' ]) }}
    </div>
</div>


{{-- Field destination city --}}
<div class="form-group{{ $errors->has('dest_city') ? ' has-error' : '' }}">
    {{ Form::labelField('dest_city', __('form.ride_label_dest_city')) }}
    <div class="col-md-6">
        {{ Form::select('dest_city', $cities, empty($ride) ? 1375 : $ride->dest_city_id, ['class' => 'selectpicker form-control', 'data-live-search="true"', 'required' ]) }}
    </div>
</div>


{{-- Field nb_seats offered --}}
<div class="form-group{{ $errors->has('nb_seats_offered') ? ' has-error' : '' }}">
    {{ Form::labelField('nb_seats_offered', __('form.ride_label_nb_seats_offered')) }}
    <div class="col-md-6">
        {{ Form::number('nb_seats_offered', null, ['class' => 'form-control', 'required autofocus min=1 max='. ($car->nb_seats-1) ]) }}
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
        <select id="luggage_size" name="luggage_size" required class="form-control" data-live-search="true">
            @foreach ($luggage_sizes as $size)
                <option value="{{$size}}"@if(! empty($ride)) {{$ride->luggage_size == $size ? 'selected': ''}} @endif>@lang($size)</option>
            @endforeach
        </select>
    </div>
</div>



@section('scripts')
    {{-- Datetime picker --}}
    <script type="text/javascript" src="{{ URL::asset('lib/moment/min/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('lib/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}" ></script>
    <script src="{{ URL::asset('lib/moment/locale/'. $locale . '.js')}}/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">


        var defaultDate = 
        @if(empty($ride))
            moment().add(1, 'days');
        @else 
            moment('{{$ride->start_time}}');
        @endif

        $(function () {
            $('.datetimepicker').datetimepicker({
                locale: '{{$locale}}',
                format: 'DD/MM/YYYY HH:mm',
                collapse:false,
                sideBySide:true,
                stepping: 15,
                defaultDate: defaultDate
            });
        });

        $('.datetimepicker input').click(function(event){
           $('.datetimepicker ').data("DateTimePicker").show();
        });
    </script>
@endsection