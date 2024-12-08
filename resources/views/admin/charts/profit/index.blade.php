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
                            <form action="{{ url('admin/reports') }}" method="get" class="d-flex justify-cotent-end">
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function () {
    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart;

    $.ajax({
        type: "GET",
        url: "{{ url('admin/reports/profit-chart/create') }}",
        dataType: "json",
        success: function (response) {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.data[0],
                    datasets: [
                        {
                            label: 'Payment',
                            data: response.data[1],
                            borderWidth: 1,
                            backgroundColor: 'rgba(255, 99, 132, 1)'
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
});
</script>
@endpush