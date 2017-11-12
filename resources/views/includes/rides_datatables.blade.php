@section('stylesheets')
  <!-- Datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection

<div class="table-responsive">
  <table id="table_rides" class="table display">
    <thead>
    <tr>
       <th>@lang('messages.th_action')</th>
       <th>@lang('messages.th_start_time')</th>
       <th>@lang('messages.th_source_city')</th>
       <th>@lang('messages.th_dest_city')</th>
       <th>@lang('messages.th_price')</th>
       <th>@lang('messages.th_nb_seats')</th>
       <th>@lang('messages.th_luggage_size')</th>
       <th class="text-center">@lang('messages.th_preferences')</th>
    </tr>
    </thead>
    <tfoot>
      <tr class="table_one_line">
       <th>@lang('messages.th_action')</th>
       <th class="text-center">@lang('messages.th_start_time')</th>
       <th class="text-center">@lang('messages.th_source_city')</th>
       <th class="text-center">@lang('messages.th_dest_city')</th>
       <th class="text-center">@lang('messages.th_price')</th>
       <th class="text-center">@lang('messages.th_nb_seats')</th>
       <th class="text-center">@lang('messages.th_luggage_size')</th>
       <th class="text-center">@lang('messages.th_preferences')</th>
    </tr>
    </tfoot>
    <tbody>
      @foreach ($rides as $ride)
        <tr class="text-center" style="white-space: nowrap; overflow: hidden;">
         <td><a href="{{route('rides.show', $ride->id)}}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
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
</div>

@section('scripts')
	<!-- Datatables -->
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/date-euro.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

      // Filter column
      $('#table_rides thead th').each( function () {
          var title = $('#table_rides tfoot th').eq( $(this).index() ).text();
          if (title !== "@lang('messages.th_action')" && title !== "@lang('messages.th_preferences')") {
            $(this).html( '<input type="text" style="text-align:center;width:100%;" placeholder="'+title+'"">' );
          }
      });
      // End Filter Column

      var table = $('#table_rides').DataTable( {
         columnDefs: [
           { type: 'date-euro', targets: 1 }, // Correct order with date euro format
           { "width": "5%", "targets": [0] },
           { "width": "10%", "targets": [4,5,6] },
           { "width": "20%", "targets": [1] }
         ],
         @if($locale == 'fr')
            "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
            }, 
         @endif
      });

       
          // DataTable 
      // Filter column
      table.columns().eq( 0 ).each( function ( colIdx ) {
          $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
              table.column( colIdx ).search( this.value ).draw();
          });
      });

    });
	</script>
@endsection