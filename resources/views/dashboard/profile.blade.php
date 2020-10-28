@extends('layouts.dashboard')
@section('title','UCANRECYCLE WA Profile Page')
@section('maintitle','Profile')
@section('content')
    {{-- {{ dd($user->name) }} --}}
    <div class="row">
      <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="{{ asset('img/damir-bosnjak.jpg') }}" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
              <a href="#">
                <div class="text-avatar avatar border-gray">
                  @php
                    $words = explode(" ", $user->name);
                    $acronym = "";

                    foreach ($words as $w) {
                      $acronym .= $w[0];
                    }

                    echo $acronym;
                  @endphp
                </div>
                <h5 class="title">{{ $user->name }}</h5>
              </a>
              <p class="description">
                {{ $user->email }}
              </p>
            </div>
            <p class="description text-center">
              {{ ($user->aboutme)? $user->aboutme : "" }}
            </p>
          </div>
          <div class="card-footer">
            <hr>
            <div class="button-container">
              {{-- <div class="row">
                <div class="col-lg-3 col-md-6 col-6 ml-auto">
                  <h5>12<br><small>Files</small></h5>
                </div>
                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                  <h5>2GB<br><small>Used</small></h5>
                </div>
                <div class="col-lg-3 mr-auto">
                  <h5>24,6$<br><small>Spent</small></h5>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
        
      </div>
      <div class="col-md-8">
        
        <div class="card card-user">
          <div class="card-header">
            <h5 class="card-title">Edit Profile</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('dashboard.profile') }}">
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Scheme ID</label>
                    <input type="text" name="scheme_id" class="form-control" placeholder="Scheme ID" value="{{ $user->scheme_id }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value={{ $user->email }}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ $user->name }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="{{ $user->mobile }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Home Address" value="{{ $user->address }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea class="form-control textarea" name="aboutme" placeholder="Some awesome intro about yourself.">{{ $user->aboutme }}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection

