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
              <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                 
                <form class="row g-3" action="{{route('user.store')}}" method="POST"  autocomplete="off">
                    @csrf
                    <div class="col-md-6">
                        <label for="company_id" class="form-label">Company</label>
                        <select id="company_id" name="company_id" class="form-select" required>
                            <option value="" selected>Choose...</option>
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($roles as $role)
                                <option value="job">{{$role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email">
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Email" id="password" name="password">
                    </div>
                                
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop
