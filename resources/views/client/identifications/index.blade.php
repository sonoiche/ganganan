@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        @include('widgets.profile.userinfo')
        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 order-0 order-md-1">
            <!-- User Pills -->
            @include('widgets.profile.userpill')
            <!--/ User Pills -->
    
            <!-- Project table -->
            <div class="card mb-6">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header pb-0 text-sm-start text-center" style="margin-bottom: 15px">Identifications</h5>
                    <div class="d-flex align-items-center" style="margin-right: 20px">
                        <a href="{{ url('client/identifications/create') }}" class="btn btn-secondary create-new btn-primary">
                            <span><i class="bx bx-plus bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Upload Identification</span></span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <table class="table datatable-project dataTable no-footer dtr-column">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Created Date</th>
                                        <th>Identification</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($identifications as $key => $identification)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td>{{ $identification->created_date }}</td>
                                        <td>{{ $identification->identification_type }}</td>
                                        <td class="text-center">
                                            <a href="{{ $identification->file_url }}" class="btn btn-outline-primary btn-sm" target="_blank"><i class="bx bxs-download" ></i> &nbsp;Download</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('client/identifications', $identification->id) }}/edit" class="btn btn-icon item-edit text-success"><i class="bx bx-edit bx-md"></i></a>
                                            <a href="javascript:;" onclick="removeIdentification({{ $identification->id }})" class="btn btn-icon item-edit text-danger"><i class="bx bx-trash bx-md"></i></a>
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
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function removeIdentification(id) {
    if(confirm('Are you sure you want to remove this item?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('client/identifications') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush