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
              <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <h3>{{ $company->name }}</h3>
                        <h5>Phone: {{ $company->phone }}</h5>
                        <h5>Address: {{ $company->address }}</h5>
                    </div>
                    <div class="col-md-6 float-right">
                        <a href="{{ asset($company->logo) }}"  target="_blank">
                            <img src="{{ asset($company->logo) }}" class="img-fluid float-end align-middle" width="100">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">

                <table class="table" id="employee_table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Country</th>
                            <th scope="col">City</th>
                            <th scope="col">Hiring Date</th>
                            <th scope="col">Leaving Date</th>
                            <th scope="col">Job</th>
                            <th scope="col">Duties</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($company->employees as $employee)
                            <tr>
                                <td>{{$employee->id}}</td>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td>{{ $employee->country->name }}</td>
                                <td>{{ $employee->city->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->hiring_date)->format('m/d/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->leaving_date)->format('m/d/Y') }}</td>
                                <td>{{ $employee->job }}</td>
                                <td>{{ implode(',',unserialize($employee->duties)) }}</td>
                                <td>
                                    @if (auth()->user()->can('edit'))
                                        <a href="{{ route('employee.edit', ['id' => $employee->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                    @if (auth()->user()->can('view'))
                                        <a href="{{ route('employee.show', ['id' => $employee->id]) }}" class="btn btn-primary btn-sm">View</a>
                                    @endif
                                    @if (auth()->user()->can('delete'))
                                        <a href="{{ route('employee.destroy', ['id' => $employee->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this option?')">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $("#employee_table").Grid({
            className: {
                table: 'table table-bordered mb-0'
            },
            search: true,
            pagination: true,
            sort: true
        });
    </script>
@stop
