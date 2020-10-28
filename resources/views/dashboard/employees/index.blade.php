@extends('layouts.dashboard')
@section('title','UCANRECYCLE WA Employees Page')
@section('maintitle', 'View All Employees')
@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="pull-left card-title"> Employee List</h4>
        <a class="pull-right btn btn-success btn-round" href="{{ route('employee.create') }}">Add Employee</a>
      </div>
      <div class="card-body">
        @if (!$employees->isEmpty())
          <div class="table-responsive">
              <table class="table">
                <thead class=" text-success">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Depot</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($employees as $employees)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $employees->name }}</td>
                        <td>{{ $employees->email }}</td>
                        <td>{{ $employees->mobile }}</td>
                        <td>{{ $employees->address }}</td>
                        <td>{{ $employees->depot }}</td>
                        <td class="text-right">
                          <a href="/dashboard/employees/{{ $employees->id }}" class="btn btn-sm btn-info btn-round">View</a>
                          <button class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-id="{{ $employees->id }}" data-target="#deleteconfirmation">x</button>
                        </td>
                      </tr>
                  @endforeach
                  
                  
                </tbody>
              </table>
              {{-- {{ $employees->links() }} --}}
          </div>
        @else
          <p class="text-center">No Employees in database. Please add some employees.</p>
        @endif
        
      </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="deleteconfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteconfirmation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this employee? 
          </div>
          <div class="modal-footer">

            <form action="{{ route('employee.delete') }}" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" id="modal_id" name="id" value="">
                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-round btn-danger">Okay</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  
   @section('script-bottom')
     
      <script type="text/javascript">
        jQuery(document).ready(function($) {
          $('button[data-toggle=modal]').click(function () {
            var data_id = '';
            if (typeof $(this).data('id') !== 'undefined') {
              data_id = $(this).data('id');
            }
            $('#modal_id').val(data_id);
          })
        });
    </script>  
    @endsection
@endsection
