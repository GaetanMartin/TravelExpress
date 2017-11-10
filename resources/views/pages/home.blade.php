@extends('layouts.default')

@section('stylesheets')
	<!-- Datatables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection

@section('content')


<table id="table_rides" class="table">
  <thead>
  <tr>
     <th>Depart</th>
     <th>Source City</th>
     <th>Dest City</th>
     <th>Price</th>
     <th>Nb seats</th>
     <th>Luggage size</th>
     <th>Preferences</th>
  </tr>
  </thead>
  <tbody>
  	@foreach ($rides as $ride)
  		<tr>
       <td>{{$ride->start_time->format('d/m/Y H:i')}}</td>
       <td>{{$ride->source_city}}</td>
	     <td>{{$ride->dest_city}}</td>
       <td>{{$ride->price}}</td>
       <td>{{$ride->nb_seats_offered}}</td>
       <td>{{__($ride->luggage_size)}}</td>
	     <td>@include('helpers.preferences.inline', ['preference'=> $ride->preference])</td>
  		</tr>
  	@endforeach
  </tbody>
</table>

@endsection

@section('scripts')
	<!-- Datatables -->
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/date-euro.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"></script>

	<script type="text/javascript">
		$(document).ready(function() {
      $('#table_rides').dataTable( {
        @if($locale == 'fr')
          "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
          }, 
        @endif
         columnDefs: [
           { type: 'date-euro', targets: 0 } // Correct order with date euro format
         ]
      });
    });
	</script>
@endsection