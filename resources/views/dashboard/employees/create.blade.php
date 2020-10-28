@extends('layouts.dashboard')
@section('title','Add New Employee')
@section('maintitle', 'Add New Employee')
@section('script-top')
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="pull-left card-title">Add New Employee</h4>
        <a class="pull-right btn btn-danger btn-round" href="{{ route('employee.index') }}">Back</a>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('employee.create') }}">
              {{ csrf_field() }}
              @method('POST')

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="" value="" />
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
                    <input type="text" name="mobile" class="form-control @if($errors->has('mobile')) is-invalid @endif" placeholder="Mobile" value="" />
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
                    <input type="email" name="email" class="form-control  @if($errors->has('email')) is-invalid @endif" placeholder="Email" value="" />
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
                    <input type="text" name="dob" id="dob" class="date form-control @if($errors->has('dob')) is-invalid @endif" placeholder="Date of Birth" value="" />
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
                    <input type="text" name="address" class="form-control @if($errors->has('address')) is-invalid @endif" placeholder="Complete Address" value="" />
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
                    <input type="text" name="job_title" class="form-control @if($errors->has('job_title')) is-invalid @endif" placeholder="" value="" />
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
                      <option selected value="0">Select Location</option>
                      <option value="brendale">Brendale</option>
                      <option value="hervey">Hervey Bay</option>
                      <option value="maryborough">Maryborough</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="tfn">TFN</label>
                    <input type="text" name="tfn" id="tfn" class="form-control @if($errors->has('tfn')) is-invalid @endif" placeholder="" value="" />
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="status">Employment Status</label>
                    <select id="status" class="form-control @if($errors->has('employment_status')) is-invalid @endif" name="employment_status">
                      <option selected value="casual">Casual</option>
                      <option value="fulltime">Full-Time</option>
                      <option value="parttime">Part-Time</option>
                      <option value="temporary">Temporary</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="super">Superfund Name</label>
                    <input type="text" name="superfund" id="super" class="form-control  @if($errors->has('superfund')) is-invalid @endif" placeholder="Superfund" value="" />
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
                    <input type="text" name="supernumber" id="supernumber" class="form-control @if($errors->has('supernumber')) is-invalid @endif" placeholder="Membership No." value="" />
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
                    <input type="text" name="emergency" id="emergency" class="form-control  @if($errors->has('emergency')) is-invalid @endif" placeholder="Emergency Contact" value="" />
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
                    <input type="text" name="emergency_contact" id="emergency_contact" class="form-control @if($errors->has('emergency_contact')) is-invalid @endif" placeholder="Emergency Contact No." value="" />
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Add New Employee</button>
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
