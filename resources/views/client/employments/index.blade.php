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
                    <h5 class="card-header pb-0 text-sm-start text-center" style="margin-bottom: 15px">Employments</h5>
                    <div class="d-flex align-items-center" style="margin-right: 20px">
                        <a href="{{ url('client/employments/create') }}" class="btn btn-secondary create-new btn-primary">
                            <span><i class="bx bx-plus bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Add Employment</span></span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <table class="table datatable-project dataTable no-footer dtr-column">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap text-center">#</th>
                                        <th class="text-nowrap">Created Date</th>
                                        <th class="text-nowrap">Service / Work</th>
                                        <th class="text-nowrap">Employed Date</th>
                                        <th class="text-nowrap">Employer Name</th>
                                        <th class="text-nowrap text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($employments as $key => $employment)
                                    <tr>
                                        <td class="text-nowrap text-center" style="padding-right: 50px">{{ $key+1 }}</td>
                                        <td class="text-nowrap" style="padding-right: 50px">{{ $employment->created_date }}</td>
                                        <td class="text-nowrap" style="padding-right: 50px">{{ $employment->name }}</td>
                                        <td class="text-nowrap" style="padding-right: 50px">{{ $employment->employment_date_display }}</td>
                                        <td class="text-nowrap" style="padding-right: 50px">{{ $employment->employer }}</td>
                                        <td class="text-nowrap text-center" style="padding-right: 50px">
                                            <a href="{{ url('client/employments', $employment->id) }}/edit" class="btn btn-icon item-edit text-success"><i class="bx bx-edit bx-md"></i></a>
                                            <a href="javascript:;" onclick="removeEmployment({{ $employment->id }})" class="btn btn-icon item-edit text-danger"><i class="bx bx-trash bx-md"></i></a>
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
    </div>
</div>
@endsection

@push('scripts')
<script>
function removeEmployment(id) {
    if(confirm('Are you sure you want to remove this item?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('client/employments') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush