@extends('layouts.app')
@section('header')
    @include('partials.header')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@if(Session::has('success'))
    <script>
        toastr.success('{{ Session::get('success') }}');
    </script>
@endif
@if(Session::has('error'))
    <script>
        toastr.error('{{ Session::get('error') }}');
    </script>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#syncLink').on('click', function(event) {
        event.preventDefault(); // Prevent the default action of navigating to the URL
        
        // Show Toastr notification
        toastr.info('Syncing data...');
        
        // Navigate to the URL after a short delay (e.g., 1 second)
        setTimeout(function() {
            window.location.href = event.target.href; // Navigate to the URL
        }, 1000); // Adjust the delay as needed
    });
});
</script>
@stop
