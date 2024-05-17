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
                <form class="row g-3" action="{{ route('option.update', $option->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-select">
                            <option value="job" {{ $option->category == 'job' ? 'selected' : '' }}>Job</option>
                            <option value="duty" {{ $option->category == 'duty' ? 'selected' : '' }}>Duty</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $option->title }}">
                    </div>
                    <div class="col-md-6">
                        <label for="value" class="form-label">Value</label>
                        <input type="text" class="form-control" id="value" name="value" value="{{ $option->value }}">
                    </div>
                                
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
