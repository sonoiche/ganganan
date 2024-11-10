@extends('layouts.site')
@section('content')
<div class="pageTitle">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h1 class="page-heading">Login</h1>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="breadCrumb"><a href="#">Home</a> / <span>Job Name</span></div>
            </div>
        </div>
    </div>
</div>
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3 mx-auto">
                <div class="userccount">
                    <h5>User Login</h5>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group mb-3" style="margin-top: 30px">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Username" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <a style="margin-bottom: 10px" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                    <!-- sign up form -->
                    <div class="newuser">
                        <i class="fa fa-user" aria-hidden="true"></i> New User? <a href="{{ url('register') }}">Register Here</a>
                    </div>
                    <!-- sign up form end-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection