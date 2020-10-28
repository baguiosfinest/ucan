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

      @foreach ($clients as $key => $client)
        <table width="100%" class="table table-bordered pdf-table">
          <thead>
            <tr>
              <th class="p-2 text-center" colspan="9">
                Postcode: 
                {{ $key ?? "" }}
              </th>
            </tr>
            <tr>
              <th width="20" class="p-1">#</th>
              <th width="100" class="p-1">Name</th>
              <th width="120" class="p-1">Email</th>
              <th width="70"  class="p-1">Scheme ID</th>
              <th width="80"  class="p-1">Mobile</th>
              <th width=""  class="p-1">Address</th>
              <th width=""  class="p-1">240 Ltr</th>
              <th width=""  class="p-1">1100 Ltr</th>
              <th width=""  class="p-1">Company</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($client as $item)
                <tr>
                  <td class="p-1">{{ $loop->index + 1 }}</td>
                  <td class="p-1">{{ $item->name }}</td>
                  <td class="p-1 text-wrap" style="overflow-wrap: break-word; break-word: break-all;">{{ $item->email }}</td>
                  <td class="p-1">{{ $item->scheme_id }}</td>
                  <td class="p-1">{{ $item->mobile }}</td>
                  <td class="p-1 text-left">{{ $item->address }} {{ $item->suburb }} {{ $item->state }} {{ $item->postcode }}</td>
                  <td class="p-1">{{ $item->bins->twotwo }}</td>
                  <td class="p-1">{{ $item->bins->oneone }}</td>
                  <td class="p-1">{{ $item->bins->company }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      @endforeach
  </body>
</html>