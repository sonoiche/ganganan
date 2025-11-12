@php
    use Carbon\Carbon;
    $formattedDateNeeded = $job->date_needed ? Carbon::parse($job->date_needed)->format('F d, Y') : 'Not specified';
    $formattedDateUntil = $job->date_until ? Carbon::parse($job->date_until)->format('F d, Y') : 'Not specified';
    $salaryText = $job->salary ? '₱' . number_format((float) $job->salary, 2) : 'Not specified';
    $salaryRateText = $job->salary_rate ? '/ ' . $job->salary_rate : '';
@endphp
@extends('layouts.site')
@section('content')
<div class="section greybg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-2">Job Overview</p>
                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                            <div class="jobimg flex-shrink-0">
                                <img src="{{ $job->display_photo }}" alt="{{ $job->job_title }}" style="max-width: 120px; border-radius: 12px" />
                            </div>
                            <div>
                                <h2 class="mb-1">{{ $job->job_title }}</h2>
                                <div class="mb-2">
                                    @if (isset($job->employer))
                                    <a href="{{ route('companies.show', $job->employer->id) }}" class="text-decoration-none">{{ $job->employer->fullname }}</a>
                                    @else
                                    <span>Company unavailable</span>
                                    @endif
                                </div>
                                <div class="text-muted">Posted on {{ $job->created_date }}</div>
                                <div class="text-muted">Work Location: {{ $job->location ?? 'To be discussed' }}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div><strong>Compensation Offered:</strong> {{ $salaryText }} {{ $salaryRateText }}</div>
                            </div>
                            <div class="col-md-6">
                                <div><strong>Status:</strong> {{ $job->status }}</div>
                            </div>
                            <div class="col-md-6">
                                <div><strong>Preferred Start Date:</strong> {{ $formattedDateNeeded }}</div>
                            </div>
                            <div class="col-md-6">
                                <div><strong>Engagement Ends:</strong> {{ $formattedDateUntil }}</div>
                            </div>
                        </div>
                        @if($skills->isNotEmpty())
                        <div class="mt-3">
                            <strong>Key Skills Needed:</strong>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @foreach ($skills as $skill)
                                <span class="badge bg-primary">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="mt-4">
                            <h5 class="fw-semibold">What You’ll Do</h5>
                            <p class="mb-0 text-secondary" style="white-space: pre-line">{{ $job->job_description ?? 'The employer has not provided additional details yet.' }}</p>
                        </div>
                        <div class="mt-4 d-flex flex-column flex-md-row gap-2">
                            <a href="{{ url('jobs') }}" class="btn btn-outline-primary">Back to Job Listings</a>
                            @if (auth()->check() && !auth()->user()->is_hired && auth()->user()->status === 'Active')
                                <a href="{{ url('jobs', $job->id) }}" class="btn btn-primary">Apply for this Job</a>
                            @else
                                <div class="text-muted small d-flex align-items-center">Log in with an active seeker account to submit an application.</div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(isset($job->employer))
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-3">About the Hiring Company</h4>
                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3" style="line-height: 1.8;">
                            <div class="jobimg flex-shrink-0">
                                <img src="{{ $job->employer->display_photo }}" alt="{{ $job->employer->fullname }}" style="max-width: 80px; border-radius: 50%" />
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $job->employer->fullname }}</h5>
                                <div class="text-muted">Member since {{ $job->employer->created_date }}</div>
                                <div class="mt-2">
                                    <div><strong>Email:</strong> {{ $job->employer->email }}</div>
                                    <div><strong>Contact:</strong> {{ $job->employer->contact_number ?? 'Not provided' }}</div>
                                    <div><strong>Address:</strong> {{ $job->employer->complete_address }}</div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('companies.show', $job->employer->id) }}" class="btn btn-link p-0">View Company Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($otherJobs->isNotEmpty())
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-3">Other Open Roles from This Company</h4>
                        <ul class="list-group list-group-flush">
                            @foreach ($otherJobs as $otherJob)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold">{{ $otherJob->job_title }}</div>
                                    <small class="text-muted">Posted on {{ $otherJob->created_date }}</small>
                                </div>
                                <a href="{{ route('jobs.details', $otherJob->id) }}" class="btn btn-sm btn-outline-primary" aria-label="View job details for {{ $otherJob->job_title }}">View Job</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

