@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-7">
            <div class="card">
                <h5 class="card-header">Update Job Information</h5>
                <div class="card-body">
                    <form action="{{ url('client/jobs', $job->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('client.jobs.form')
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <input type="hidden" name="id" value="{{ $job->id }}" />
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