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
              <li class="breadcrumb-item"><a href="{{ route('incident')}}">Employee Incident</a></li>
              <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        @if (auth()->user()->hasRole('super-admin') && auth()->user()->company_id == 0)
                            <h5>{{ $incident->company->name ?? ' - ' }}</h5>
                        @endif
                        <h5>Employee: {{ $incident->employee->name }}</h5>
                        <h5>Location: {{ $incident->location }}</h5>
                        <h5>Date: {{ \Carbon\Carbon::parse($incident->date)->format('m/d/Y') }}</h5>
                        <h5>Time: {{ $incident->time }}</h5>
                        <h5>Description: {{ $incident->details }}</h5>
                    </div>
                    <div class="col-md-6 float-right">
                        @foreach ($incident->images as $image)
                            <a href="{{ asset($image->image) }}"  target="_blank">
                                <img src="{{ asset($image->image) }}" class="img-fluid" width="100">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
