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
                    <h5 class="card-header pb-0 text-sm-start text-center" style="margin-bottom: 15px">Subscription</h5>
                    <div class="d-flex align-items-center" style="margin-right: 20px">
                        <a href="{{ url('client/subscription/create') }}" class="btn btn-secondary create-new btn-primary">
                            <span><i class="bx bx-plus bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Upload Payment</span></span>
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
                                        <th class="text-nowrap">Invoice Number</th>
                                        <th class="text-nowrap">Amount</th>
                                        <th class="text-nowrap text-center">Valid Until</th>
                                        <th class="text-nowrap text-center">Proof</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subscriptions as $key => $subscription)
                                    <tr>
                                        <td class="text-nowrap text-center" style="padding-right: 50px">{{ $key+1 }}</td>
                                        <td class="text-nowrap" style="padding-right: 50px">{{ $subscription->created_date }}</td>
                                        <td class="text-nowrap" style="padding-right: 50px">{{ $subscription->invoice_number }}</td>
                                        <td class="text-nowrap" style="padding-right: 50px">{{ $subscription->amount }}</td>
                                        <td class="text-nowrap text-center" style="padding-right: 50px">{{ $subscription->valid_until_date }}</td>
                                        <td class="text-nowrap text-center" style="padding-right: 50px">
                                            @if (isset($subscription->payment))
                                            <a href="{{ $subscription->payment->proof }}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                                </svg>                                                  
                                            </a>
                                            @endif
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

@section('css')
<style>
.size-4 {
    width: 30px;
}
</style>
@endsection