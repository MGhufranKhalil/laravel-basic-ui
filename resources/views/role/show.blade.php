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
                    <h5>Role: {{ $role->name }}</h5>
                    <h5>Permissions: {{ $role->getAllPermissions()->pluck('name') }}</h5>
                </div>
            </div>
        </div>
    </div>
@stop
