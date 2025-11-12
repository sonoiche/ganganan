@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="head-label">
                        <h5 class="card-title mb-1">Verified User Directory</h5>
                        <p class="text-muted mb-0">Review all approved accounts, confirm their roles, and manage access when needed.</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="sorting text-center">ID</th>
                                <th class="sorting text-nowrap">Full Name</th>
                                <th class="sorting text-nowrap">Email</th>
                                <th class="sorting text-nowrap">Phone</th>
                                <th class="sorting text-nowrap">Account Role</th>
                                <th class="sorting text-nowrap">Status</th>
                                <th class="sorting_disabled text-nowrap text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key => $user)
                            <tr class="odd">
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->display_photo }}" class="img-fluid" style="height: 40px; width: 40px; object-fit: cover; margin-right: 15px; border-radius: 9999px" />
                                        {{ $user->fullname }}
                                    </div>
                                </td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $user->email }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $user->contact_number ?: 'Not provided' }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $user->role }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $user->status }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">
                                    @if ($user->id !== 1)
                                    <a href="javascript:;" onclick="removeUser({{ $user->id }})" class="btn btn-icon item-edit text-danger" aria-label="Remove {{ $user->fullname }}"><i class="bx bx-trash bx-md"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center text-muted" colspan="7">No verified users found yet. Once accounts are approved, they will appear here.</td>
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