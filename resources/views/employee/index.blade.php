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
                        @foreach ($employees as $employee)
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
