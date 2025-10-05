@extends('layouts.site')
@section('content')
<div class="section greybg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 mx-auto">
                <h4>{{ (auth()->check()) ? 'Recommended Jobs for You' : 'Available Jobs for You' }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12 mx-auto">
                <form class="mb-4" method="GET" action="{{ url('jobs') }}">
                    <div class="input-group">
                        <input type="text" name="search" list="job-title-options" class="form-control"
                            placeholder="Search for job title or location" value="{{ $search }}">
                        <datalist id="job-title-options">
                            @foreach ($jobTitles as $title)
                                <option value="{{ $title }}"></option>
                            @endforeach
                        </datalist>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                    @if ($search)
                        <div class="mt-2">
                            <a href="{{ url('jobs') }}" class="btn btn-link p-0">Clear search</a>
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
                                    <h3><a href="#.">{{ $job->job_title }}</a></h3>
                                    <div class="companyName"><a href="#.">{{ $job->employer->fullname ?? '' }}</a></div>
                                    <div class="location"><label class="fulltime">Short Term</label> - <span>{{ $job->location }}</span></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if (auth()->check() && !auth()->user()->is_hired && auth()->user()->status === 'Active')
                                    <div class="listbtn"><a href="{{ url('jobs', $job->id) }}">Apply Now</a></div>
                                @endif
                                @if(auth()->check() && auth()->user()->is_hired)
                                    <div class="listbtn">Can't apply to this job, you are already Hired.</div>
                                @endif
                                
                            </div>
                        </div>
                        <p>{{ $job->job_description }}</p>
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
                <!-- Pagination Start -->
                {{-- <div class="pagiWrap">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="showreslt">Showing 1-10</div>
                        </div>
                        <div class="col-md-8 col-sm-8 text-right">
                            <ul class="pagination">
                                <li class="active"><a href="#.">1</a></li>
                                <li><a href="#.">2</a></li>
                                <li><a href="#.">3</a></li>
                                <li><a href="#.">4</a></li>
                                <li><a href="#.">5</a></li>
                                <li><a href="#.">6</a></li>
                                <li><a href="#.">7</a></li>
                                <li><a href="#.">8</a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                <!-- Pagination end -->
            </div>    
        </div>
    </div>
</div>
@endsection
