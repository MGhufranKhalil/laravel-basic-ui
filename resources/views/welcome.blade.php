@extends('layouts.app')
@section('content')
<style>
.loader {
    display: none;
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 1s linear infinite;
    margin: auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<div class="page-sign">
    <div id="loader" class="loader"></div>
    <div class="card card-sign">
        <div class="card-header">
            <h3 class="card-title">Sign In</h3>
            <p class="card-text">Welcome back! Please sign in to continue.</p>
        </div><!-- card-header -->
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST" onsubmit="showLoader()" novalidate>
                @csrf
                <div class="mb-4">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email address" required>
                </div>
                <div class="mb-4">
                    <label class="form-label d-flex justify-content-between">Password <a href="#">Forgot password?</a></label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>
                <button class="btn btn-primary btn-sign" type="submit">Sign In</button>
            </form>
        </div><!-- card-body -->
        <div class="card-footer">
            Don't have an account? <a href="{{ route('register') }}">Create an Account</a>
        </div><!-- card-footer -->
    </div>
</div>
<script>
function showLoader() {
    document.getElementById("loader").style.display = "inline-block";
}
</script>
@stop
