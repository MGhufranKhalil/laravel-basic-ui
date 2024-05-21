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
              <li class="breadcrumb-item"><a href="{{ route('employee')}}">Employee</a></li>
              <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <h3>{{ $employee->first_name }} {{ $employee->last_name }} </h3>
                        <h5>Address: {{ $employee->address }} </h5>
                        <h5>email: {{ $employee->email }} </h5>
                        <h5>Country: {{ $employee->country->name }} </h5>
                        <h5>State: {{ $employee->state->name }} </h5>
                        <h5>City: {{ $employee->city->name }} </h5>
                        <h5>Country Code: {{ $employee->country_code }} </h5>
                        <h5>phone: {{ $employee->phone }} </h5>
                        <h5>Zip Code: {{ $employee->zip_code }} </h5>
                    </div>
                    <div class="col-md-6 float-right">
                        <a href="{{ asset($employee->image) }}"  target="_blank">
                            <img src="{{ asset($employee->image) }}" class="img-fluid float-end align-middle" width="100">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
