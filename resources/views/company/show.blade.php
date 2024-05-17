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
                    <h5>Name: {{ $company->name }}</h5>
                    <h5>Phone: {{ $company->phone }}</h5>
                    <h5>Address: {{ $company->address }}</h5>
                    <h5>Logo: </h5>

                    <a href="{{ asset($company->logo) }}"  target="_blank">
                        <img src="{{ asset($company->logo) }}" class="img-fluid" width="100">
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
