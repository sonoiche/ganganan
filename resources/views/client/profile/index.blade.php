@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        @include('widgets.profile.userinfo')
        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 order-0 order-md-1">
            <!-- User Pills -->
            @include('widgets.profile.userpill')
            <!--/ User Pills -->
    
            <!-- Project table -->
            <div class="card mb-6">
                <h5 class="card-header pb-0 text-sm-start text-center" style="margin-bottom: 15px">Account Information</h5>
                <div class="card-body">
                    <form action="{{ url('client/profile', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-4">
                                    <label for="fname" class="form-label">First name</label>
                                    <input type="text" name="fname" class="form-control" id="fname" value="{{ $user->fname ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-4">
                                    <label for="mname" class="form-label">Middle name</label>
                                    <input type="text" name="mname" class="form-control" id="mname" value="{{ $user->mname ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-4">
                                    <label for="lname" class="form-label">Last name</label>
                                    <input type="text" name="lname" class="form-control" id="lname" value="{{ $user->lname ?? '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ $user->email ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-4">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control" id="contact_number" value="{{ $user->contact_number ?? '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="mb-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" value="{{ $user->address ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-4">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" id="city" value="{{ $user->city ?? '' }}" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-4">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" name="zip_code" class="form-control" id="zip_code" value="{{ $user->zip_code ?? '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-4">
                                    <label for="user_type" class="form-label">I am</label>
                                    <select name="user_type" id="user_type" class="form-select">
                                        <option value="Both">Looking for job and an employee</option>
                                        <option value="Seeker">Looking for a job</option>
                                        <option value="Employer">an Employer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-4">
                                    <label for="photo" class="form-label">Profile Photo</label>
                                    <input type="file" name="photo" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $user->id }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\ProfileRequest') !!}
@endpush