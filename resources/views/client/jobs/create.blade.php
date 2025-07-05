@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Add New Job</h5>
                <div class="card-body">
                    <form action="{{ url('client/jobs') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('client.jobs.form')
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Add Job</button>
                        </div>
                    </form>
                </div>
            </div>          
        </div>
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Client\JobRequest') !!}
<script src="{{ url('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ url('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ url('assets/js/forms-selects.js') }}"></script>
@endpush

@section('css')
<link rel="stylesheet" href="{{ url('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ url('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
@endsection