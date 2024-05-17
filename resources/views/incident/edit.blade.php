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
                <form class="row g-3" action="{{ route('incident.update', $incident->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-12">
                        <label for="employee_id" class="form-label">Employees</label>
                        <select id="employee_id" name="employee_id" class="form-select" required>
                            <option value="" selected>Choose...</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"  >{{ $employee->first_name }} {{ $employee->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Location</label>
                        <input type="text" class="form-control" placeholder="Enter Location" id="location" name="location" value="{{$incident->location}}" required>
                    </div>
                    <div class="col-md-2">
                        <label for="first_name" class="form-label">Time</label>
                        <input type="time" class="form-control" placeholder="Enter Time" id="time" name="time" value="{{$incident->time}}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="first_name" class="form-label">Date</label>
                        <input type="text" class="form-control" placeholder="Enter Date" id="date" name="date" value="{{$incident->date}}" required>
                    </div>
                    

                    <div class="col-md-12">
                        <label for="last_name" class="form-label">Details</label>
                        <textarea class="form-control" id="details" name="details" rows="3" placeholder="Enter Details...">{{$incident->details}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Images</label>
                        <input class="form-control" type="file" id="images" name="images[]" multiple>
                    </div>
                    @foreach ($incident->images as $image)
                        <div class="mb-3">
                            <a href="{{ asset($image->image) }}" target="_blank">
                                <img src="{{ asset($image->image) }}" class="img-fluid" width="100">
                            </a>
                        </div>
                    @endforeach
                                
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#date').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
            todayHighlight: true
        }).datepicker('setDate', '{{ \Carbon\Carbon::parse($incident->date)->format('m/d/Y') }}');
        
    </script>
@stop
