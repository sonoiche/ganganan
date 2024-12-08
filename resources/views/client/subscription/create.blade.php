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
                <h5 class="card-header pb-0 text-sm-start text-center" style="margin-bottom: 15px">Upload Payment</h5>
                <div class="card-body">
                    <p>Please send your payment thru GCash Number: 09123456789 and upload your poof of payment here</p>
                    <form action="{{ url('client/payments') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('client.subscription.form')
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('client/subscription') }}" class="btn btn-outline-danger">Back</a> &nbsp;&nbsp;
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>          
        </div>
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Client\IdentificationRequest') !!}
@endpush