@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 assessment-header">
                            <h5 class="card-title mb-0">Assessment Tests</h5>
                        </div>
                        <div class="col-12 col-md-6 text-md-end d-flex assessment-action">
                            <a href="{{ url('admin/assessments/create') }}" class="btn btn-outline-primary btn-sm">Add New Assessment</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="sorting text-nowrap text-center">#</th>
                                <th class="sorting text-nowrap">Assessment</th>
                                <th class="sorting text-nowrap text-center">Items</th>
                                <th class="sorting text-nowrap text-center">Passing Grade</th>
                                <th class="sorting text-nowrap text-center">Status</th>
                                <th class="sorting_disabled text-nowrap text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assessments as $key => $assessment)
                            <tr class="odd">
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $key+1 }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $assessment->name }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $assessment->items }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $assessment->passing_grade }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $assessment->status }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">
                                    <a href="{{ url('admin/assessment-tests') }}?assessment_id={{ $assessment->id }}" class="btn btn-icon item-edit text-primary"><i class="bx bx-search bx-md"></i></a>
                                    <a href="{{ url('admin/assessments', $assessment->id) }}/edit" class="btn btn-icon item-edit text-success"><i class="bx bx-pencil bx-md"></i></a>
                                    <a href="javascript:;" onclick="removeAssessment({{ $assessment->id }})" class="btn btn-icon item-edit text-danger"><i class="bx bx-trash bx-md"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">No data available</td>
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
function removeAssessment(id) {
    if(confirm('Are you sure you want to delete this assessment?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/assessments') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush