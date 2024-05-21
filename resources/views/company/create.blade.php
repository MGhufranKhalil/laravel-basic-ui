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
              <li class="breadcrumb-item"><a href="{{ route('company')}}">Company</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                 
                <form class="row g-3" action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Name</label>
                        <input type="first_name" class="form-control" placeholder="Enter Name" id="name" name="name">
                    </div>
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Phone</label>
                        <input type="first_name" class="form-control" placeholder="Enter Phone" id="phone" name="phone">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control" placeholder="Enter Email" id="website" name="website" required>
                    </div>
                    <div class="col-md-6">
                        <label for="country_id" class="form-label">Country</label>
                        <select id="country_id" name="country_id" class="form-select" required>
                            <option value="" selected>Choose...</option>
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="state_id" class="form-label">State</label>
                        <select id="state_id" name="state_id" class="form-select" required>
                            <option value="" selected>Choose...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="city_id" class="form-label">City</label>
                        <select id="city_id" name="city_id" class="form-select" required>
                            <option value="" selected>Choose...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="zip_code" class="form-label">Zipcode</label>
                        <input type="text" class="form-control" placeholder="Enter Zipcode" id="zip_code" name="zip_code">
                    </div>
                    <div class="col-md-12">
                        <label for="last_name" class="form-label">Address</label>
                        <input type="last_name" class="form-control" placeholder="Enter Address" id="value" name="address">
                    </div>
                    
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input class="form-control" type="file" id="logo" name="logo">
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
        $("#phone").inputmask({"mask": "(999) 999-9999"});
        $('#country_id').change(function () {
            var countryId = $(this).val();
            if (countryId) {
                var stateUrl = "{{ route('country-states', ['country_id' => ':country_id']) }}";
                stateUrl = stateUrl.replace(':country_id', countryId);
                $.ajax({
                    url: stateUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#state_id').empty();
                        $('#state_id').append('<option selected>Choose...</option>');
                        $.each(data, function (key, value) {
                            $('#state_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#state_id').empty();
                $('#state_id').append('<option selected>Choose...</option>');
            }
        });

        $('#state_id').change(function () {
            var stateId = $(this).val();
            if (stateId) {
                var cityUrl = "{{ route('state-cities', ['state_id' => ':state_id']) }}";
                cityUrl = cityUrl.replace(':state_id', stateId);
                $.ajax({
                    url: cityUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#city_id').empty();
                        $('#city_id').append('<option selected>Choose...</option>');
                        $.each(data, function (key, value) {
                            $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option selected>Choose...</option>');
            }
        });
    });
</script>
@stop
