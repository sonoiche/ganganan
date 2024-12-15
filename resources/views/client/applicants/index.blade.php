@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        @foreach ($applicants as $applicant)
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <div class="dropdown btn-pinned">
                        <button type="button" class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow p-4" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded bx-md text-muted"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="javascript:void(0);">Share connection</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Block connection</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a></li>
                        </ul>
                    </div>
                    <div class="mx-auto my-6">
                        <img src="{{ $applicant->display_photo }}" alt="Avatar Image" class="rounded-circle w-px-100 h-px-100" />
                    </div>
                    <h5 class="mb-0 card-title">{{ $applicant->fullname }}</h5>
                    <span>{{ $applicant->city }}</span>
                    <div class="d-flex align-items-center justify-content-center my-6 gap-2">
                        @foreach ($applicant->user_skill->array_skills as $skill)
                        <a href="javascript:;"><span class="badge bg-label-primary">{{ $applicant->skillDisplay($skill) }}</span></a>
                        @endforeach
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ url('client/applicants', $applicant->id) }}" class="btn btn-label-secondary btn-icon"><i class="bx bx-show-alt bx-md"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection