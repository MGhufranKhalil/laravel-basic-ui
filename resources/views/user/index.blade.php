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
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">

                <table class="table" id="employee_table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }} </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames(); }}</td>
                                <td>
                                    @if (auth()->user()->can('edit'))
                                        <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                    @if (auth()->user()->can('view'))
                                        <a href="{{ route('user.show', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">View</a>
                                    @endif
                                    @if (auth()->user()->can('delete'))
                                        <a href="{{ route('user.destroy', ['id' => $user->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
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
