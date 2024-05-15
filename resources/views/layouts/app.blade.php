{{-- @extends('shopify-app::layouts.default') --}}
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <title>Basic Laravel</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('asset/lib/remixicon/fonts/remixicon.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('asset/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/toastr/toastr.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        window.baseURL = {!! json_encode(url('/')) !!}
    </script>
    @stack('css')
</head>

<body>
    @yield('header')
    @yield('sidebar')
    @yield('content')

    <div class="main-footer text-center">
        <span class="text-center">&copy; 2024. MGK. All Rights Reserved.</span>
    </div>
    <!-- main-footer -->
    <script src="{{ asset('asset/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('asset/js/script.js') }}"></script>
    <script src="{{ asset('asset/toastr/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif

        @if (Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif



        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr["error"]('{{ $error }}');
            @endforeach
        @endif

    </script>
    @stack('js')
</body>

</html>
