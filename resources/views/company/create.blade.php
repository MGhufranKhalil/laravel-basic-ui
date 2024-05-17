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
                 
                <form class="row g-3" action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Name</label>
                        <input type="first_name" class="form-control" placeholder="Enter Name" id="name" name="name">
                    </div>
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Phone</label>
                        <input type="first_name" class="form-control" placeholder="Enter Phone" id="phone" name="phone">
                    </div>
                    <div class="col-md-12">
                        <label for="last_name" class="form-label">Address</label>
                        <input type="last_name" class="form-control" placeholder="Enter Address" id="value" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input class="form-control" type="file" id="logo" name="logo">
                    </div>
                                
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop
