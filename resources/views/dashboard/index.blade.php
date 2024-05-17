@extends('layouts.app')
@section('header')
    @include('partials.header')
@stop
@section('sidebar')
    @include('partials.sidebar')
@stop
@section('content')
<div class="main main-app p-3 p-lg-4">
    <p>
        Welcome to  <strong>{{$login->user_name ?? ''}} </strong>! </p>
    
    {{-- <a class="btn btn-success float-end" id="syncLink" href="{{ URL::tokenRoute('sync.all') }}">Sync</a> --}}

</div>
@stop
