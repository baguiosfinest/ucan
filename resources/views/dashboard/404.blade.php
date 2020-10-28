@extends('layouts.dashboard')
@section('maintitle', 'Error')
@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="pull-left card-title">Something Went Wrong</h4>
        <a class="pull-right btn btn-info btn-round mr-1" href="{{ route('dashboard.index') }}">Back</a>
      </div>
      <div class="card-body d-flex align-items-stretch justify-content-center">
        {{ $message }}
      </div>
    </div>
@endsection
