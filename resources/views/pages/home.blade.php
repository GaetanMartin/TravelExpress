@extends('layouts.default')

@section('stylesheets')
	<!-- Datatables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection

@section('content')

<table id="example">
  <thead>
  <tr>
     <th>Depart</th>
     <th>Price</th>
  </tr>
  </thead>
  <tbody>
  	@foreach ($rides as $ride)
  		<tr>
	     <td>{{$ride->start_time}}</td>
	     <td>{{$ride->price}}</td>
  		</tr>
  	@endforeach
  </tbody>
</table>

@endsection

@section('scripts')
	<!-- Datatables -->
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#example').DataTable();
		} );
	</script>
@endsection