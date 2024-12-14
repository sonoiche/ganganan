@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex justify-content-between flex-md-row pb-3">
                    <div class="head-label text-center"><h5 class="card-title mb-0">My Job Openings</h5></div>
                    <div class="dt-action-buttons text-end pt-6 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{ url('client/jobs/create') }}" class="btn btn-secondary create-new btn-primary">
                                <span><i class="bx bx-plus bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Add New job</span></span>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">Date Created</th>
                            <th class="sorting">Job Order</th>
                            <th class="sorting">Title</th>
                            <th class="sorting text-center">Needed</th>
                            <th class="sorting text-center">Applied</th>
                            <th class="sorting">Salary</th>
                            <th class="sorting text-center">Status</th>
                            <th class="sorting_disabled text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $key => $job)
                        <tr class="odd">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $job->created_date }}</td>
                            <td>{{ $job->job_order_number }}</td>
                            <td>{{ $job->job_title }}</td>
                            <td class="text-center">{{ $job->workers_need }}</td>
                            <td class="text-center">{!! (isset($job->applications) && count($job->applications) > 0) ? 
                            '<a href="'.url('client/jobs/job-applied').'?job_id='.$job->id.'"><strong>' .count($job->applications). '</strong></a>' : 0 !!}</td>
                            <td>{{ 'P'.$job->salary }}</td>
                            <td class="text-center">{{ $job->status }}</td>
                            <td class="text-center">
                                <a href="{{ url('client/jobs', $job->id) }}/edit" class="btn btn-icon item-edit text-success"><i class="bx bx-edit bx-md"></i></a>
                                <a href="javascript:;" onclick="removeJob({{ $job->id }})" class="btn btn-icon item-edit text-danger"><i class="bx bx-trash bx-md"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="8">No jobs available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function removeJob(id) {
    if(confirm('Are you sure you want to delete this job?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('client/jobs') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush