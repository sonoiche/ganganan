@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="d-flex justify-content-between">
                        <div class="head-label">
                            <h5 class="card-title mb-0">Questionaiers for {{ $assessment->name }}</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ url('admin/assessment-tests/create') }}?assessment_id={{ $assessment->id }}" class="btn btn-outline-primary btn-sm">Add New Question</a>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">Question</th>
                            <th class="sorting">Options</th>
                            <th class="sorting text-center">Answer</th>
                            <th class="sorting_disabled text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($questions as $key => $question)
                        <tr class="odd">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $question->question }}</td>
                            <td>{!! $question->content !!}</td>
                            <td class="text-center">{{ $question->answer }}</td>
                            <td class="text-center">
                                <a href="{{ url('admin/assessment-tests', $question->id) }}/edit?assessment_id={{ $assessment->id }}" class="btn btn-icon item-edit text-success"><i class="bx bx-pencil bx-md"></i></a>
                                <a href="javascript:;" onclick="removeQuestion({{ $question->id }})" class="btn btn-icon item-edit text-danger"><i class="bx bx-trash bx-md"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5">No data available</td>
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
function removeQuestion(id) {
    if(confirm('Are you sure you want to delete this question?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/assessment-tests') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush