@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="head-label"><h5 class="card-title mb-0">Verified Users</h5></div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">User Name</th>
                            <th class="sorting">Email</th>
                            <th class="sorting">Contact Number</th>
                            <th class="sorting">Role</th>
                            <th class="sorting">Status</th>
                            <th class="sorting_disabled text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)
                        <tr class="odd">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->display_photo }}" class="img-fluid" style="height: 40px; width: 40px; object-fit: cover; margin-right: 15px; border-radius: 9999px" />
                                    {{ $user->fullname }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->contact_number }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->status }}</td>
                            <td class="text-center">
                                @if ($user->id !== 1)
                                <a href="javascript:;" onclick="removeUser({{ $user->id }})" class="btn btn-icon item-edit text-danger"><i class="bx bx-trash bx-md"></i></a>
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
@endsection

@push('scripts')
<script>
function removeUser(id) {
    if(confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/user-verify') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush