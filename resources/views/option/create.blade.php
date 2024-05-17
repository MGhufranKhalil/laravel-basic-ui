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
                 
                <form class="row g-3" action="{{route('option.store')}}" method="POST" >
                    @csrf

                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-select">
                            <option selected>Choose...</option>
                            <option value="job">Job</option>
                            <option value="duty">Duty</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Title</label>
                        <input type="first_name" class="form-control" placeholder="Enter Title" id="title" name="title">
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Value</label>
                        <input type="last_name" class="form-control" placeholder="Enter Last name" id="value" name="value">
                    </div>
                                
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop
