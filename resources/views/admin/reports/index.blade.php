@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="d-flex justify-content-between">
                        <div class="head-label">
                            <h5 class="card-title mb-0">Reports - Profit</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <form action="{{ url('admin/reports/payments') }}" method="get" class="d-flex justify-cotent-end">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class='bx bxs-calendar'></i>
                                    </span>
                                    <input type="text" class="form-control" id="daterange" name="daterange" placeholder="Date" value="{{ $daterange ?? '' }}" />
                                </div>
                                <div style="width: 250px; margin-left: 10px">
                                    <button class="btn btn-primary">Generate Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="sorting text-center">#</th>
                            <th class="sorting">Payment Date</th>
                            <th class="sorting">Invoice Number</th>
                            <th class="sorting">User Name</th>
                            <th class="sorting text-center">Amount</th>
                            <th class="sorting text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $key => $payment)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $payment->created_date }}</td>
                            <td>{{ $payment->subscription->invoice_number ?? '' }}</td>
                            <td>{{ $payment->user->fullname ?? '' }}</td>
                            <td class="text-center">{{ $payment->amount }}</td>
                            <td class="text-center">{{ $payment->status }}</td>
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