@extends('layouts.dashboard')
@section('title','View Employee Information')
@section('maintitle', 'View Employee Information')
@section('script-top')
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="pull-left card-title">Employee Information</h4>
        <a class="pull-right btn btn-danger btn-round" href="{{ route('employee.index') }}">Back</a>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('employee.update') }}">
              {{ csrf_field() }}
              @method('PUT')
              <input type="hidden" name="employee_id" value="{{ $employee->id }}">
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Name</label>
                  <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="" value="{{ $employee->name }}" />
                     @error('name')
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control @if($errors->has('mobile')) is-invalid @endif" placeholder="Mobile" value="{{ $employee->mobile }}" />
                     @error('mobile')
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile') }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control  @if($errors->has('email')) is-invalid @endif" placeholder="Email" value="{{ $employee->email }}" />
                     @error('email')
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" name="dob" id="dob" class="date form-control @if($errors->has('dob')) is-invalid @endif" placeholder="Date of Birth" value="{{ $employee->dob }}" />
                    @error('dob')
                        <div class="invalid-feedback">
                            {{ $errors->first('dob') }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control @if($errors->has('address')) is-invalid @endif" placeholder="Complete Address" value="{{ $employee->address }}" />
                     @error('address')
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Position</label>
                    <input type="text" name="job_title" class="form-control @if($errors->has('job_title')) is-invalid @endif" placeholder="" value="{{ $employee->job_title }}" />
                     @error('name')
                        <div class="job_title">
                            {{ $errors->first('job_title') }}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="depot">Depot</label>
                    <select id="depot" class="form-control @if($errors->has('depot')) is-invalid @endif" name="depot">
                      <option value="0">Select Location</option>
                      <option @if($employee->depot == 'Brendale') {{ 'selected' }} @endif value="Brendale">Brendale</option>
                      <option @if($employee->depot == 'Hervey') {{ 'selected' }} @endif value="Hervey">Hervey Bay</option>
                      <option @if($employee->depot == 'Maryborough') {{ 'selected' }} @endif value="Maryborough">Maryborough</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="tfn">TFN</label>
                  <input type="text" name="tfn" id="tfn" class="form-control @if($errors->has('tfn')) is-invalid @endif" placeholder="" value="{{ $employee->tfn }}" />
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="status">Employment Status</label>
                    <select id="status" class="form-control @if($errors->has('employment_status')) is-invalid @endif" name="employment_status">
                      <option @if($employee->employment_status == 'casual') {{ 'selected' }} @endif value="casual">Casual</option>
                      <option @if($employee->employment_status == 'fulltime') {{ 'selected' }} @endif value="fulltime">Full-Time</option>
                      <option @if($employee->employment_status == 'parttime') {{ 'selected' }} @endif value="parttime">Part-Time</option>
                      <option @if($employee->employment_status == 'temporary') {{ 'selected' }} @endif value="temporary">Temporary</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="super">Superfund Name</label>
                  <input type="text" name="superfund" id="super" class="form-control  @if($errors->has('superfund')) is-invalid @endif" placeholder="Superfund" value="{{ $employee->superfund }}" />
                     @error('super')
                        <div class="invalid-feedback">
                            {{ $errors->first('superfund') }}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="supernumber">Membership No.</label>
                    <input type="text" name="supernumber" id="supernumber" class="form-control @if($errors->has('supernumber')) is-invalid @endif" placeholder="Membership No." value="{{ $employee->supernumber }}" />
                    @error('super')
                        <div class="invalid-feedback">
                            {{ $errors->first('supernumber') }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="emergency">Emergency Contact</label>
                    <input type="text" name="emergency" id="emergency" class="form-control  @if($errors->has('emergency')) is-invalid @endif" placeholder="Emergency Contact" value="{{ $employee->emergency }}" />
                     @error('emergency')
                        <div class="invalid-feedback">
                            {{ $errors->first('emergency') }}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="emergency_contact">Contact No.</label>
                    <input type="text" name="emergency_contact" id="emergency_contact" class="form-control @if($errors->has('emergency_contact')) is-invalid @endif" placeholder="Emergency Contact No." value="{{ $employee->emergency_contact }}" />
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Update Employee</button>
                  <a href="{{ route('employee.index') }}" class="btn btn-warning btn-round">Back</a>
                </div>
              </div>
            </form>
      </div>
    </div>
    @section('script-bottom')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      jQuery(document).ready(function($) {

        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4'
        });
      });
  </script> 
  @endsection
@endsection
