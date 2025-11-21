@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex justify-content-between flex-md-row pb-3">
                    <div class="head-label text-center text-md-start">
                        <h5 class="card-title mb-1">My Active Job Openings</h5>
                        <p class="text-muted mb-0">Monitor published postings, track candidates, and update listings in one place.</p>
                    </div>
                    <div class="dt-action-buttons text-end pt-6 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            @if (auth()->user()->status === 'Active')
                            <a href="{{ url('client/jobs/create') }}" class="btn btn-secondary create-new btn-primary">
                                <span><i class="bx bx-plus bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Add New job</span></span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="datatables-basic table border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
                        <thead>
                            <tr>
                                <th class="text-nowrap sorting text-center">ID</th>
                                <th class="text-nowrap sorting">Created On</th>
                                <th class="text-nowrap sorting">Job Order #</th>
                                <th class="text-nowrap sorting">Position Title</th>
                                <th class="text-nowrap sorting text-center">Workers Needed</th>
                                <th class="text-nowrap sorting text-center">Applicants</th>
                                <th class="text-nowrap sorting">Pay Rate</th>
                                <th class="text-nowrap sorting text-center">Publishing Status</th>
                                <th class="text-nowrap sorting_disabled text-center">Quick Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobs as $key => $job)
                            <tr class="odd">
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $key+1 }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $job->created_date }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $job->job_order_number }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $job->job_title }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $job->workers_need }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ (isset($job->applications) && count($job->applications) > 0) ? count($job->applications) : 0 }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $job->salary ? '₱' . number_format((float) $job->salary, 2) : 'Not specified' }} {{ $job->salary_rate ? '/ ' . $job->salary_rate : '' }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $job->status }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">
                                    @if (isset($job->applications) && count($job->applications) > 0)
                                    <a href="{{ url('client/jobs/job-applied') }}?job_id={{ $job->id }}" class="btn btn-icon item-edit text-info" aria-label="View applicants for {{ $job->job_title }}"><i class="bx bx-show bx-md"></i></a>
                                    @endif
                                    <a href="{{ url('client/jobs', $job->id) }}/edit" class="btn btn-icon item-edit text-success" aria-label="Edit job {{ $job->job_title }}"><i class="bx bx-edit bx-md"></i></a>
                                    <a href="javascript:;" class="btn btn-icon item-edit text-danger remove-job-btn" data-job-id="{{ $job->id }}" aria-label="Delete job {{ $job->job_title }}"><i class="bx bx-trash bx-md"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center text-muted" colspan="9">You haven’t posted any jobs yet. Create a new job opening to start receiving applications.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.remove-job-btn').on('click', function() {
        var jobId = $(this).data('job-id');
        if(confirm('Are you sure you want to delete this job?')) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('client/jobs') }}/" + jobId,
                dataType: "json",
                success: function (response) {
                    location.reload();
                }
            });
        }
    });
});
</script>
@endpush