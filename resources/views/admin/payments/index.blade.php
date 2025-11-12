@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="d-flex justify-content-between w-100">
                        <div class="head-label">
                            <h5 class="card-title mb-1">Subscription Payments</h5>
                            <p class="text-muted mb-0">Track incoming subscription receipts, review proof of payment, and confirm completed transactions.</p>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="sorting text-nowrap text-center">ID</th>
                                <th class="sorting text-nowrap">Recorded On</th>
                                <th class="sorting text-nowrap text-center">Invoice #</th>
                                <th class="sorting text-nowrap">Submitted By</th>
                                <th class="sorting text-nowrap text-center">Proof of Payment</th>
                                <th class="sorting text-nowrap text-center">Current Status</th>
                                <th class="sorting_disabled text-nowrap text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $key => $payment)
                            <tr>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $key+1 }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $payment->created_date }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $payment->subscription->invoice_number ?? '' }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $payment->user->fullname ?? 'Account unavailable' }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">
                                    @if ($payment->proof)
                                    <a href="{{ $payment->proof }}" target="_blank" rel="noopener" aria-label="View proof of payment for invoice {{ $payment->subscription->invoice_number ?? '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                        </svg>                                                  
                                    </a>
                                    @else
                                        <span class="text-muted small">No file submitted</span>
                                    @endif
                                </td>
                                <td class="text-nowrap text-center">{{ $payment->status }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">
                                    <a href="{{ url('admin/payments', $payment->id) }}" onclick="return confirm('Mark this payment as paid and grant the related subscription benefits?')" class="btn btn-sm btn-outline-success">Mark as Paid</a>
                                    <a href="javascript:;" onclick="deletePayment({{ $payment->id }})" class="btn btn-sm btn-danger" aria-label="Delete payment record {{ $payment->subscription->invoice_number ?? '' }}">
                                        <i class="bx bx-trash" style="font-size: 15px;"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No payment submissions yet. Once members upload their receipts, they will appear in this list.</td>
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
function deletePayment(id) {
    if(confirm('Deleting this entry will remove the payment history for auditing. Do you want to proceed?')) {
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