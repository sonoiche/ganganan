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
                    </ul>
                    <div class="d-flex align-items-center justify-content-center" style="margin-top: 20px">
                        @if (!$applicant->is_hired && !isset($_GET['job_id']))
                            <a href="{{ url('client/applications', $applicant->id) }}" class="btn btn-primary d-flex align-items-center me-4"><i class="bx bx-user-check bx-sm me-2"></i>Hire Applicant</a>
                        @elseif(!$applicant->is_hired && isset($_GET['job_id']))
                            <a href="{{ url('client/applications', $applicant->id) }}?job_id={{ $_GET['job_id'] }}" class="btn btn-primary d-flex align-items-center me-4"><i class="bx bx-user-check bx-sm me-2"></i>Hire Applicant</a>
                        @else
                            <p>You can't hire this applicant, the applicant is already hired by other employer.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection