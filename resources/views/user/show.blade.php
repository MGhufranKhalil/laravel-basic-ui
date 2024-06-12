@extends('layouts.app')
@section('header')
    @include('partials.header')
@stop
@section('sidebar')
    @include('partials.sidebar')
@stop
@section('content')
    <div class="main main-app p-3 p-lg-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('user')}}">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                <div>
                    @if (auth()->user()->hasRole('super-admin') && auth()->user()->company_id == 0)
                        <h5>{{ $user->company->name ?? ' - ' }}</h5>
                    @endif
                    <h5>Name: {{ $user->name }}</h5>
                    <h5>Email: {{ $user->email }}</h5>
                    <h5>Role: {{ $user->getRoleNames() }}</h5>
                </div>
            </div>
        </div>
    </div>
@stop
