@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Create a New Job Posting</h5>
                <div class="card-body">
                    <p class="text-muted mb-4">Fill out the details below to publish a short-term opportunity. Clear information helps seekers decide quickly.</p>
                    <form action="{{ url('client/jobs') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('client.jobs.form')
                        @if (auth()->user()->status === 'Active')
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Publish Job Posting</button>
                        </div>
                        @endif
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