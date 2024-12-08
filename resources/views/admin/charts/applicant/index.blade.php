@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row pb-3">
                    <div class="d-flex justify-content-between">
                        <div class="head-label">
                            <h5 class="card-title mb-0">Reports - Applicant</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <form action="{{ url('admin/reports/applicants') }}" method="get" class="d-flex justify-cotent-end">
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="float: right">
                        <select name="month" id="month" class="form-select" style="width: 100%">
                            <option value="">All Months</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
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
        url: "{{ url('admin/reports/applicants/create') }}",
        dataType: "json",
        success: function (response) {
            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: response.data[0],
                    datasets: [
                        {
                            label: 'Applied',
                            data: response.data[1],
                            borderWidth: 2,
                            borderColor: 'rgb(0, 0, 255)',
                            backgroundColor: 'rgba(0, 0, 255, 1)'
                        },
                        {
                            label: 'Hired',
                            data: response.data[2],
                            borderWidth: 2,
                            borderColor: 'rgb(0, 255, 0)',
                            backgroundColor: 'rgba(0, 255, 0, 1)'
                        }
                    ]
                },
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
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

    $('#month').change(function (e) {
        if (myChart) {
            myChart.destroy();
        }

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('admin/reports/applicants') }}",
            data: {
                month: $(this).val()
            },
            dataType: "json",
            success: function (response) {
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: response.data[0],
                        datasets: [
                            {
                                label: 'Applied',
                                data: response.data[1],
                                borderWidth: 2,
                                borderColor: 'rgb(0, 0, 255)',
                                backgroundColor: 'rgba(0, 0, 255, 1)'
                            },
                            {
                                label: 'Hired',
                                data: response.data[2],
                                borderWidth: 2,
                                borderColor: 'rgb(0, 255, 0)',
                                backgroundColor: 'rgba(0, 255, 0, 1)'
                            }
                        ]
                    },
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
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
});
</script>
@endpush