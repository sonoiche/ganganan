@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.site')
@section('content')
<div class="section greybg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 mx-auto text-center text-md-start">
                <h1 class="h4 fw-semibold mb-2">{{ auth()->check() ? 'Recommended Roles Tailored for You' : 'Discover Short-Term Opportunities Nearby' }}</h1>
                <p class="text-muted mb-4">Browse active short-term jobs posted by trusted companies or search for a specific role or location to get started.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12 mx-auto">
                <form class="mb-4" method="GET" action="{{ url('jobs') }}" aria-label="Job search form">
                    <label for="search" class="form-label fw-semibold">Search by job title or location</label>
                    <div class="input-group">
                        <input
                            type="text"
                            id="search"
                            name="search"
                            list="job-title-options"
                            class="form-control"
                            placeholder="e.g. Electrician, Dagupan City"
                            value="{{ $search }}"
                            aria-describedby="search-help"
                        >
                        <datalist id="job-title-options">
                            @foreach ($jobTitles as $title)
                                <option value="{{ $title }}"></option>
                            @endforeach
                        </datalist>
                        <button class="btn btn-primary" type="submit">Search Jobs</button>
                    </div>
                    <div id="search-help" class="form-text">Try a skill, role, or town name to see matching openings.</div>
                    @if ($search)
                        <div class="mt-2">
                            <a href="{{ url('jobs') }}" class="btn btn-link p-0">Clear search and show all jobs</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12 mx-auto">
                <!-- Search List -->
                <ul class="searchList">
                    @forelse ($jobs as $job)
                    <li>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="jobimg"><img src="{{ $job->display_photo }}" alt="{{ $job->job_title }}" /></div>
                                <div class="jobinfo">
                                    <h3>
                                        <a href="{{ url('jobs/' . $job->id . '/details') }}">{{ $job->job_title }}</a>
                                    </h3>
                                    <div class="companyName">
                                        @if (isset($job->employer))
                                            <a href="{{ url('companies', $job->employer->id) }}">{{ $job->employer->fullname }}</a>
                                        @else
                                            <span>Company unavailable</span>
                                        @endif
                                    </div>
                                    <div class="location">
                                        <span class="badge bg-label-primary text-dark me-2">Short-Term Engagement</span>
                                        <span class="fw-semibold">{{ $job->location }}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-sm-row gap-2 mt-2">
                                        <span><strong>Salary:</strong> {{ $job->salary ? '₱' . number_format((float) $job->salary, 2) : 'Not specified' }} {{ $job->salary_rate ? '/ ' . $job->salary_rate : '' }}</span>
                                        <span class="text-muted">Posted on {{ $job->created_date }}</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="listbtn mt-2 mt-md-0 mb-2">
                                    <a href="{{ url('jobs/' . $job->id . '/details') }}" aria-label="View full details for {{ $job->job_title }}">View Full Details</a>
                                </div>
                                @if (auth()->check() && !auth()->user()->is_hired && auth()->user()->status === 'Active')
                                    <div class="listbtn"><a href="{{ url('jobs', $job->id) }}" aria-label="Apply now for {{ $job->job_title }}">Apply Now</a></div>
                                @endif
                                @if(auth()->check() && auth()->user()->is_hired)
                                    <div class="listbtn">Can't apply to this job, you are already Hired.</div>
                                @endif
                                
                            </div>
                        </div>
                        <p class="text-muted">{{ Str::limit($job->job_description, 220) ?: 'Job description will be provided by the employer.' }}</p>
                    </li>
                    @empty
                    <li>
                        <div class="row">
                            <div class="col-md-8 col-sm-8 mx-auto">
                                <div class="d-flex align-items-center" style="margin-top: 15px">
                                    <h5>
                                        @if ($search)
                                            No jobs found for "{{ $search }}".
                                        @else
                                            No jobs available, please set-up your skill sets to get results.
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>    
        </div>
    </div>
</div>
@endsection
