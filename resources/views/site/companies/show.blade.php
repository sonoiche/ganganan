@extends('layouts.site')
@section('content')
<div class="section greybg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-2">Company Overview</p>
                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                            <div class="jobimg flex-shrink-0">
                                <img src="{{ $company->display_photo }}" alt="{{ $company->fullname }}" style="max-width: 100px; border-radius: 50%" />
                            </div>
                            <div>
                                <h2 class="mb-1">{{ $company->fullname }}</h2>
                                <div class="text-muted mb-2">Joined SkillLink on {{ $company->created_date }}</div>
                                <p class="text-secondary small mb-3">Learn more about this hiring partner, how to reach them, and the opportunities they currently offer.</p>
                                <div class="mt-2 company-detail-list" style="line-height: 1.8;">
                                    <div><strong>Primary Contact Email:</strong> {{ $company->email }}</div>
                                    <div><strong>Phone Number:</strong> {{ $company->contact_number ?? 'Not provided' }}</div>
                                    <div><strong>Business Address:</strong> {{ $company->complete_address }}</div>
                                    <div><strong>Account Status:</strong> {{ $company->status ?? 'Not available' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-1">Active Job Openings ({{ $totalJobs }})</h4>
                        <p class="text-muted small mb-3">Browse current short-term roles offered by this company. Select a job to review the full description and application steps.</p>
                        @if ($jobOpenings->isEmpty())
                            <p class="mb-0 text-secondary">This company has not posted any jobs yet. Check back soon or explore other employers.</p>
                        @else
                            <ul class="list-group list-group-flush company-openings-list">
                                @foreach ($jobOpenings as $job)
                                <li class="list-group-item" style="line-height: 1.8;">
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                                        <div>
                                            <div class="fw-semibold">{{ $job->job_title }}</div>
                                            <small class="text-muted">Posted on {{ $job->created_date }} • Work Location: {{ $job->location ?? 'To be announced' }}</small>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center flex-column flex-md-row">
                                            <span class="text-secondary"><strong>Compensation:</strong> {{ $job->salary ? '₱' . number_format((float) $job->salary, 2) : 'Not specified' }} {{ $job->salary_rate ? '/ ' . $job->salary_rate : '' }}</span>
                                            <a href="{{ route('jobs.details', $job->id) }}" class="btn btn-sm btn-outline-primary" aria-label="View job details for {{ $job->job_title }}">View Job Details</a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ url('jobs') }}" class="btn btn-outline-primary">Back to Public Job Listings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

