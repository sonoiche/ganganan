@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex justify-content-between flex-md-row pb-3">
                    <div class="head-label text-center"><h5 class="card-title mb-0">Hired Applicants</h5></div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">Date Applied</th>
                            <th class="sorting">Job Title</th>
                            <th class="sorting">Applicant</th>
                            <th class="sorting">Date Hired</th>
                            <th class="sorting text-center">Status</th>
                            <th class="sorting_disabled text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $key => $application)
                        <tr class="odd">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $application->created_date }}</td>
                            <td>{{ $application->job->job_title ?? '' }}</td>
                            <td>{{ $application->user->fullname ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($application->updated_at)->format('M d, Y') }}</td>
                            <td class="text-center">{{ $application->status }}</td>
                            <td class="text-center">
                                @if ($application->status == 'Hired' || $application->status == 'Completed')
                                <a href="javascript:;" onclick="removeApplicant({{ $application->id }})" class="btn btn-icon item-edit text-primary"><i class="bx bx-edit-alt bx-md"></i></a>
                                @endif
                                @if ($application->status == 'Hired')
                                <a href="javascript:;" onclick="completeWork({{ $application->id }})" class="btn btn-icon item-edit text-success"><i class="bx bx-calendar-check bx-md"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="7">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-review" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('client/reviews') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Write a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="width: 100%; height: 30px; margin-bottom: 15px">
                        <input id="input-id" type="text" class="rating" name="rating" data-size="sm" data-min="0" data-max="5" data-step="1" data-show-caption="false" data-show-clear="false" />
                    </div>
                    <div class="form-group">
                        <label for="review" class="form-label">Review</label>
                        <textarea name="review" id="review" class="form-control" style="width: 100%; resize: none" rows="5"></textarea>
                    </div>
                    <div class="form-group" style="margin-top: 10px">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="status" id="mark-complete">
                            <label class="form-check-label" for="mark-complete">
                                Mark the work as complete
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> &nbsp;
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <input type="hidden" name="application_id" id="application_id" />
                </div>
            </form>
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
    $("#input-id").rating(); 
});

function removeApplicant(id) {
    $('#application_id').val(id);
    $('#modal-review').modal('show');
}

function completeWork(id) {
    if(confirm('Are you sure you want to complete the work?')) {
        $.ajax({
            type: "GET",
            url: "{{ url('client/reviews') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush