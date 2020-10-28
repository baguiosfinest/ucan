<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('./css/paper-dashboard.min.css?v=2.0.1')}}" rel="stylesheet" />
    <link href="{{ asset('css/app.css')}}" rel="stylesheet" />
    <title>Save to PDF</title>
  </head>
  <body style="font-size: 13px;">
      <table width="100%" class="table table-bordered pdf-table">
        <thead>
          <tr>
            <th class="p-1">#</th>
            <th class="p-1">Name</th>
            <th class="p-1">Scheme ID</th>
            <th class="p-1">Mobile</th>
            <th class="p-1">Address</th>
            <th class="p-1">Qty</th>
            @if ($pickups ?? '')
              <th class="p-1">Date</th>
              <th class="p-1">Time</th>
            @else
            <th class="p-1">Bin Type</th>
            @endif
            <th class="p-1">Instructions</th>
            <th class="p-1">Status</th>
          </tr>
        </thead>
        <tbody>
          @php
            $tables = ($pickups ?? '') ? $pickups : $bins;
          @endphp
          @if(!$tables->isEmpty())
            @foreach ($tables as $table)
                <tr>
                  <td class="p-1">{{ $loop->iteration }}</td>
                  <td class="p-1">{{ $table->name }}</td>
                  <td class="p-1">{{ $table->scheme_id }}</td>
                  <td class="p-1">{{ $table->mobile }}</td>
                  <td class="p-1">{{ $table->address }}</td>
                  <td class="p-1">{{ $table->no_of_bins }}</td>
                  @if ($pickups ?? '')
                    <td class="p-1">{{ $table->expected_date }}</td>
                    <td class="p-1">{{ $table->expected_time }}</td>
                  @else
                    <td class="p-1">{{ $table->bintype }}</td>
                  @endif
                  
                  <td class="p-1">{{ $table->instructions }}</td>
                  <td class="p-1"><input type="checkbox" class="" /></td>
                </tr>
            @endforeach
          @endif
          
        </tbody>
      </table>
  </body>
</html>