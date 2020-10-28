@extends('layouts.dashboard')
@section('title','UCANRECYCLE WA Dashboard') 
@section('maintitle')
  Welcome, <strong>{{ auth()->user()->name }}</strong>
@endsection

@section('content')
 @if (auth()->user()->is_admin == 1)
  @include('dashboard.includes.topcards-admin',['users' => $users, 'depots' => $depots])   
  @include('dashboard.includes.admin')
 @else
  @include('dashboard.includes.topcards',['users' => $users, 'depots' => $depots])
  @include('dashboard.includes.normal')
 @endif




@endsection
