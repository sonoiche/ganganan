@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="head-label mb-2 mb-md-0">
                            <h5 class="card-title mb-0">Reports - Profit</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <form action="{{ url('admin/reports/payment-report') }}" method="get" class="d-flex flex-wrap justify-content-end">
                                <div class="input-group mb-3" style="min-width: 200px;">
                                    <span class="input-group-text">
                                        <i class='bx bxs-calendar'></i>
                                    </span>
                                    <input type="text" class="form-control" id="daterange" name="daterange" placeholder="Date" value="{{ $daterange ?? '' }}" />
                                </div>
                                <div class="pr-button">
                                    <button class="btn btn-primary w-100 w-md-auto">Generate Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="sorting text-nowrap text-center">#</th>
                                <th class="sorting text-nowrap">Payment Date</th>
                                <th class="sorting text-nowrap">Invoice Number</th>
                                <th class="sorting text-nowrap">User Name</th>
                                <th class="sorting text-nowrap text-center">Amount</th>
                                <th class="sorting text-nowrap text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $key => $payment)
                            <tr>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $key+1 }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $payment->created_date }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $payment->subscription->invoice_number ?? '' }}</td>
                                <td class="text-nowrap" style="padding-right: 50px">{{ $payment->user->fullname ?? '' }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $payment->amount }}</td>
                                <td class="text-nowrap text-center" style="padding-right: 50px">{{ $payment->status }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function () {
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        // $('#daterange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    // cb(start, end);
});
</script>
@endpush

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection