@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mx-auto my-6">
                        <img src="{{ $applicant->display_photo }}" alt="Avatar Image" class="rounded-circle w-px-100 h-px-100" />
                    </div>
                    <h5 class="mb-0 card-title">{{ $applicant->fullname }}</h5>
                    <span>{{ $applicant->city }}</span>
                    <div class="d-flex align-items-center justify-content-center my-6 gap-2">
                        @if (isset($applicant->user_skill))
                            @foreach ($applicant->user_skill->array_skills as $skill)
                            <a href="javascript:;"><span class="badge bg-label-primary">{{ $applicant->skillDisplay($skill) }}</span></a>
                            @endforeach
                        @endif
                    </div>
                    <ul class="list-group list-group-bullet">
                        <li class="list-group-item d-flex justify-content-start align-items-start">
                            <div class="ms-2" style="text-align: left">
                                <div class="fw-bold">Fullname</div>
                                {{ $applicant->fullname }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-start align-items-start">
                            <div class="ms-2" style="text-align: left">
                                <div class="fw-bold">Email</div>
                                {{ $applicant->email }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-start align-items-start">
                            <div class="ms-2" style="text-align: left">
                                <div class="fw-bold">Contact Number</div>
                                {{ $applicant->contact_number }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-start align-items-start">
                            <div class="ms-2" style="text-align: left">
                                <div class="fw-bold">Status</div>
                                {{ $applicant->status }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-start align-items-start">
                            <div class="ms-2" style="text-align: left">
                                <div class="fw-bold">Complete Address</div>
                                {{ $applicant->complete_address }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-start align-items-start">
                            <div class="ms-2" style="text-align: left">
                                <div class="fw-bold">Identification File</div>
                                @foreach ($identifications as $identification)
                                <a href="{{ $identification->file_url }}" class="btn btn-outline-primary btn-sm" target="_blank"><i class="bx bxs-download" ></i> &nbsp;Download</a><br>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center justify-content-center" style="margin-top: 20px">
                        <a href="{{ url('client/applications', $applicant->id) }}?job_id={{ $_GET['job_id'] }}" class="btn btn-primary d-flex align-items-center me-4"><i class="bx bx-user-check bx-sm me-2"></i>Hire Applicant</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Employer Feedbacks</h4>
                    @foreach ($applicant->reviews as $review)
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="{{ $review->employer->display_photo ?? '' }}" alt="..." />
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div>
                                {{ $review->employer->fullname ?? '' }}
                                <div class="d-flex" style="marign-top: 15px">
                                    <input id="input-id" type="text" class="rating input-id" data-size="xs" data-min="0" data-max="5" data-step="1" data-show-caption="false" data-show-clear="false" value="{{ $review->rating }}" readonly style="width: 10px" />
                                    <div class="d-flex align-items-center" style="height: 25px;">
                                        <small>{{ $review->created_date }}</small>
                                    </div>
                                </div>
                            </div>
                            
                            <p style="margin-top: 10px">{{ $review->review }}</p>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
<script>
$(document).ready(function () {
    $(".input-id").rating(); 
});
</script>
@endpush