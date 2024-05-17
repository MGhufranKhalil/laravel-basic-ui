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
                 
                <form class="row g-3" action="{{route('role.store')}}" method="POST" >
                    @csrf
                    <div class="col-md-12">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" placeholder="Enter Role" id="role" name="role">
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="col-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="duties{{$loop->iteration}}" name="permissions[]" value="{{$permission->name}}">
                                <label class="form-check-label" for="duties{{$loop->iteration}}" >
                                    {{$permission->name}}
                                </label>
                            </div>
                        </div>
                    @endforeach
                                
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop
