@extends('layouts.app')
@section('header')
    @include('partials.header')
@stop
@section('sidebar')
    @include('partials.sidebar')
@stop
@section('content')
    <div class="main main-app p-3 p-lg-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <h5>Name: {{ $employee->first_name }} {{ $employee->last_name }} </h5>
                    <h5>Address: {{ $employee->address }} </h5>
                    <h5>email: {{ $employee->email }} </h5>
                    <h5>Country: {{ $employee->country->name }} </h5>
                    <h5>City: {{ $employee->city->name }} </h5>
                    <h5>Country Code: {{ $employee->country_code }} </h5>
                    <h5>phone: {{ $employee->phone }} </h5>
                    <h5>Zip Code: {{ $employee->zip_code }} </h5>
                    <h5>Image:  </h5> 

                    <a href="{{ asset($employee->image) }}"  target="_blank">
                        <img src="{{ asset($employee->image) }}" class="img-fluid" width="100">
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
