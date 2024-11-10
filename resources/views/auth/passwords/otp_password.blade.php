@extends('layouts.site')
@section('content')
<div class="pageTitle">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h1 class="page-heading">OTP Password</h1>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="breadCrumb"><a href="#">Home</a> / <span>OTP Password</span></div>
            </div>
        </div>
    </div>
</div>
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3 mx-auto">
                @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
                @endif
                <div class="userccount">
                    <h5>OTP Password</h5>
                    <form action="{{ url('otp-password') }}" method="post">
                        @csrf
                        <div class="form-group mb-3" style="margin-top: 30px">
                            <label for="otp_password" class="form-label">One Time Password</label>
                            <input type="number" name="otp_password" class="form-control @error('otp_password') is-invalid @enderror" value="{{ old('otp_password') }}" placeholder="OTP Password" />
                            @error('otp_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block">Verify Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection