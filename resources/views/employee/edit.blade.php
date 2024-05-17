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
                 
                <form class="row g-3" action="{{route('employee.update',['id'=>$employee->id])}}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" placeholder="Enter First name" id="first_name" name="first_name" value="{{$employee->first_name}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter Last name" id="last_name" name="last_name"  value="{{$employee->last_name}}" required>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address"  value="{{$employee->address}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="country_id" class="form-label">Country</label>
                        <select id="country_id" name="country_id" class="form-select"  required>
                            <option value="" >Choose...</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" @if($country->id == $employee->country_id) selected @endif>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="city_id" class="form-label">City</label>
                        <select id="city_id" name="city_id" class="form-select" required>
                            <option  value=""  selected>Choose...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="zip_code" class="form-label">Zipcode</label>
                        <input type="text" class="form-control" placeholder="Enter Zipcode" id="zip_code" name="zip_code"  value="{{$employee->zip_code}}">
                    </div>
                    <div class="col-md-2">
                        <label for="phone" class="form-label">Country Code</label>
                        <select id="country_code" name="country_code" class="form-select" required>
                            <option value=""  selected>Choose...</option>
                            @foreach ($countries as $country)
                                <option value="{{$country->dial_code}}"  @if($country->dial_code == $employee->country_code) selected @endif>{{$country->dial_code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter Phone" id="phone" name="phone"  value="{{$employee->phone}}" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email"  value="{{$employee->email}}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="job" class="form-label">Job</label>
                        <select id="job" name="job" class="form-select" required>
                            <option  value="" selected>Choose...</option>
                            @foreach ($jobs as $job)
                                <option value="{{$job->value}}"  @if($job->value == $employee->job) selected @endif>{{$job->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="col-md-6">
                        <label for="hiring_date" class="form-label">Hiring Date</label>
                        <input type="text" class="form-control" placeholder="Select Hiring Date" id="hiring_date" name="hiring_date"   required>
                    </div>

                    <div class="col-md-6">
                        <label for="leaving_date" class="form-label">Leaving Date</label>
                        <input type="text" class="form-control" placeholder="Select Leaving Date" id="leaving_date" name="leaving_date"   required>
                    </div>

                    <div class="col-md-12">
                        <label for="associates" class="form-label">Associates</label>
                        <select id="associates" name="associates" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($associates as $associate)
                                <option value="{{ $associate->id }}"  @if($associate->id == $employee->associate) selected @endif>{{ $associate->first_name }} {{ $associate->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach ($duties as $duty)
                        <div class="col-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="duties{{$loop->iteration}}" name="duties[]" value="{{$duty->value}}"  @if(in_array($duty->value, unserialize($employee->duties))) checked @endif>
                                <label class="form-check-label" for="duties{{$loop->iteration}}" >
                                    {{$duty->title}}
                                </label>
                            </div>
                        </div>
                    @endforeach
                     
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="active" value="active" {{$employee->status == 'active' ? 'checked' : ''}} >
                            <label class="form-check-label" for="active">
                              Active
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" {{$employee->status == 'inactive' ? 'checked' : ''}} >
                            <label class="form-check-label" for="inactive">
                              In Active
                            </label>
                          </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Photo</label>
                        <input class="form-control" type="file" id="image" name="image" multiple>
                    </div>

                    <div class="mb-3">
                        <a href="{{ asset($employee->image) }}"  target="_blank">
                            <img src="{{ asset($employee->image) }}" class="img-fluid" width="100">
                        </a>
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

<script type="text/javascript">
    
    
    $(document).ready(function () {
        $('#hiring_date').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
            todayHighlight: true
        }).datepicker('setDate', '{{ \Carbon\Carbon::parse($employee->hiring_date)->format('m/d/Y') }}');

        $('#leaving_date').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
            todayHighlight: true
        }).datepicker('setDate', '{{ \Carbon\Carbon::parse($employee->leaving_date)->format('m/d/Y') }}');

        var initialCountryId = $('#country_id').val();
        
        setCities(initialCountryId);

        $('#country_id').change(function () {
            var countryId = $(this).val();
            setCities(countryId);
        });

        function setCities(countryId){
            if (countryId) {
                var url = "{{ route('country-cities', ['country_id' => ':country_id']) }}";
                url = url.replace(':country_id', countryId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#city_id').empty();
                        $('#city_id').append('<option selected>Choose...</option>');
                        $.each(data, function (key, value) {
                            var option = '<option value="' + value.id + '"';
                            if (value.id == "{{ $employee->city_id }}") {
                                option += ' selected';
                            }
                            option += '>' + value.name + '</option>';
                            $('#city_id').append(option);
                        });
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option selected>Choose...</option>');
            }
        }
    });
</script>
@stop
