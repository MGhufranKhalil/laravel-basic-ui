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
              <li class="breadcrumb-item"><a href="{{ route('role')}}">Role</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">

                <table class="table" id="employee_table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            @if (auth()->user()->hasRole('super-admin') && auth()->user()->company_id == 0)
                                <th scope="col">Company</th>
                            @endif
                            <th scope="col">Name</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                @if (auth()->user()->hasRole('super-admin') && auth()->user()->company_id == 0)
                                    <td>{{ $role->company->name ?? ' - ' }}</td>
                                @endif
                                <td>{{ $role->name }} </td>
                                <td>{{ $role->getAllPermissions()->pluck('name') }} </td>
                                <td>
                                    @if (auth()->user()->can('edit'))
                                        <a href="{{ route('role.edit', ['id' => $role->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                    @if (auth()->user()->can('view'))
                                        <a href="{{ route('role.show', ['id' => $role->id]) }}" class="btn btn-primary btn-sm">View</a>
                                    @endif
                                    @if (auth()->user()->can('delete'))
                                        <a href="{{ route('role.destroy', ['id' => $role->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
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
