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
              <li class="breadcrumb-item"><a href="{{ route('company')}}">Company</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                <form class="row g-3" action="{{ route('company.update', $company->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Name</label>
                        <input type="first_name" class="form-control" placeholder="Enter Name" id="name" name="name" value="{{ $company->name }}">
                    </div>
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Phone</label>
                        <input type="first_name" class="form-control" placeholder="Enter Phone" id="phone" name="phone" value="{{ $company->phone }}">
                    </div>
                    <div class="col-md-12">
                        <label for="last_name" class="form-label">Address</label>
                        <input type="last_name" class="form-control" placeholder="Enter Address" id="value" name="address" value="{{ $company->address }}">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input class="form-control" type="file" id="logo" name="logo">
                    </div>
                    <a href="{{ asset($company->logo) }}"  target="_blank">
                        <img src="{{ asset($company->logo) }}" class="img-fluid" width="100">
                    </a>
                                
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
