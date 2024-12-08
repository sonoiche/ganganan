@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="d-flex justify-content-between">
                        <div class="head-label">
                            <h5 class="card-title mb-0">Payments</h5>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">Payment Date</th>
                            <th class="sorting text-center">Invoice Number</th>
                            <th class="sorting">User Name</th>
                            <th class="sorting text-center">Proof</th>
                            <th class="sorting text-center">Status</th>
                            <th class="sorting_disabled text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $key => $payment)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $payment->created_date }}</td>
                            <td class="text-center">{{ $payment->subscription->invoice_number ?? '' }}</td>
                            <td>{{ $payment->user->fullname ?? '' }}</td>
                            <td class="text-center">
                                <a href="{{ $payment->proof }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                    </svg>                                                  
                                </a>
                            </td>
                            <td class="text-center">{{ $payment->status }}</td>
                            <td class="text-center">
                                <a href="{{ url('admin/payments', $payment->id) }}" onclick="return confirm('Are you sure you want to mark this payment as paid?')" class="btn btn-sm btn-outline-success">Mark as Paid</a>
                                <a href="javascript:;" onclick="deletePayment({{ $payment->id }})" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash" style="font-size: 15px;"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No data available</td>
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
function deletePayment(id) {
    if(confirm('Are you sure you want to delete this?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/payments') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush

@section('css')
<style>
.size-4 {
    width: 30px;
}
</style>
@endsection