@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 order-0 order-md-1">
            <!-- Project table -->
            <div class="card mb-6">
                <h5 class="card-header pb-0 text-sm-start text-center" style="margin-bottom: 15px">Update Question</h5>
                <div class="card-body">
                    <form action="{{ url('admin/assessment-tests', $question->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.assessment-tests.form')
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('admin/assessment-tests') }}" class="btn btn-outline-danger">Back</a> &nbsp;&nbsp;
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                        <input type="hidden" name="assessment_id" value="{{ $assessment->id }}" />
                    </form>
                </div>
            </div>          
        </div>
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Admin\AssessmentTestRequest') !!}
@endpush