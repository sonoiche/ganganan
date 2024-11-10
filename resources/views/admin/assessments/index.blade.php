@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="d-flex justify-content-between">
                        <div class="head-label">
                            <h5 class="card-title mb-0">Assessment Tests</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ url('admin/assessments/create') }}" class="btn btn-outline-primary btn-sm">Add New Assessment</a>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">Assessment</th>
                            <th class="sorting">Items</th>
                            <th class="sorting">Passing Grade</th>
                            <th class="sorting">Status</th>
                            <th class="sorting_disabled text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assessments as $key => $assessment)
                        <tr class="odd">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td></td>
                            <td>{{ $assessment->name }}</td>
                            <td>{{ $assessment->items }}</td>
                            <td>{{ $assessment->passing_grade }}</td>
                            <td class="text-center">
                                @if ($assessment->id !== 1)
                                <a href="javascript:;" onclick="removeAssessment({{ $assessment->id }})" class="btn btn-icon item-edit text-danger"><i class="bx bx-trash bx-md"></i></a>
                                @endif
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