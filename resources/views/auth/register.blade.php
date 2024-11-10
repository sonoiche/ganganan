@extends('layouts.site')
@section('content')
<div class="pageTitle">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h1 class="page-heading">Register</h1>
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
            <div class="col-md-8 col-md-offset-3 mx-auto">
                <div class="userccount">
                    <h5>User Registration</h5>
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="row mb-3" style="margin-top: 30px">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control @error('fname') is-invalid @enderror" />
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control @error('lname') is-invalid @enderror" />
                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number') }}" />
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">Register</button>
                        </div>
                    </form>
                    <!-- sign up form -->
                    <div class="newuser">
                        <i class="fa fa-user" aria-hidden="true"></i> Alread have an account? <a href="{{ url('login') }}">Login Here</a>
                    </div>
                    <!-- sign up form end-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
