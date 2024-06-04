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
              <li class="breadcrumb-item"><a href="{{ route('incident')}}">Employee Incident</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                 
                <form class="row g-3" action="{{ route('incident.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate autocomplete="off">
                    @csrf
                    <div class="col-md-12">
                        <label for="employee_id" class="form-label">Employees</label>
                        <select id="employee_id" name="employee_id" class="form-select" required>
                            <option value="" {{ old('employee_id') ? '' : 'selected' }}>Choose...</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" placeholder="Enter Location" id="location" name="location" value="{{ old('location') }}" required>
                    </div>
                    <div class="col-md-2">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control" placeholder="Enter Time" id="time" name="time" value="{{ old('time') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">Date</label>
                        <input type="text" class="form-control" placeholder="Enter Date" id="date" name="date" value="{{ old('date') }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="details" class="form-label">Details</label>
                        <textarea class="form-control" id="details" name="details" rows="3" placeholder="Enter Details...">{{ old('details') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Images</label>
                        <input class="form-control" type="file" id="images" name="images[]" multiple>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

<script>
    $('#date').datepicker();
</script>
@stop
