@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Total Revenue -->
        @if (auth()->user()->role == 'Admin')
        <div class="col-12 col-xxl-8 order-2 order-md-3 order-xxl-2 mb-6">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-lg-12">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Total Revenue</h5>
                            </div>
                        </div>
                        <div id="totalRevenueChart" class="px-3"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!--/ Total Revenue -->
        @if (auth()->user()->role == 'Admin')
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ url('assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <p class="mb-1">Profit</p>
                            <h4 class="card-title mb-3">Php {{ $monthlyProfit }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ url('assets/img/icons/unicons/wallet-info.png') }}" alt="wallet info" class="rounded" />
                                </div>
                            </div>
                            <p class="mb-1">Users</p>
                            <h4 class="card-title mb-3">{{ $applicants }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ url('assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded" />
                                </div>
                            </div>
                            <p class="mb-1">Applications</p>
                            <h4 class="card-title mb-3">{{ $applications }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ url('assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <p class="mb-1">Hired</p>
                            <h4 class="card-title mb-3">{{ $hired }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (auth()->user()->role == 'User')
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ url('assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <p class="mb-1">Job Posting</p>
                            <h4 class="card-title mb-3">{{ $jobPost }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ url('assets/img/icons/unicons/wallet-info.png') }}" alt="wallet info" class="rounded" />
                                </div>
                            </div>
                            <p class="mb-1">Job Applications</p>
                            <h4 class="card-title mb-3">{{ $myApplications }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ url('assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded" />
                                </div>
                            </div>
                            <p class="mb-1">Pending Applicants</p>
                            <h4 class="card-title mb-3">{{ $pendingApplicants }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ url('assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <p class="mb-1">Hired Applicants</p>
                            <h4 class="card-title mb-3">{{ $hiredApplicants }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    let cardColor, headingColor, legendColor, labelColor, shadeColor, borderColor;

    cardColor = config.colors.cardColor;

    const totalRevenueChartEl = document.querySelector("#totalRevenueChart"),
    totalRevenueChartOptions = {
        series: [
            {
                name: new Date().getFullYear() - 1,
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            },
            {
                name: new Date().getFullYear(),
                data: <?php echo json_encode($chart[1]); ?>,
            },
        ],
        chart: {
            height: 317,
            stacked: true,
            type: "bar",
            toolbar: { show: false },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "30%",
                borderRadius: 8,
                startingShape: "rounded",
                endingShape: "rounded",
            },
        },
        colors: [config.colors.primary, config.colors.info],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 6,
            lineCap: "round",
            colors: [cardColor],
        },
        legend: {
            show: true,
            horizontalAlign: "left",
            position: "top",
            markers: {
                height: 8,
                width: 8,
                radius: 12,
                offsetX: -5,
            },
            fontSize: "13px",
            fontFamily: "Public Sans",
            fontWeight: 400,
            labels: {
                colors: legendColor,
                useSeriesColors: false,
            },
            itemMargin: {
                horizontal: 10,
            },
        },
        grid: {
            strokeDashArray: 7,
            borderColor: borderColor,
            padding: {
                top: 0,
                bottom: -8,
                left: 20,
                right: 20,
            },
        },
        fill: {
            opacity: [1, 1],
        },
        xaxis: {
            categories: <?php echo json_encode($chart[0]); ?>,
            labels: {
                style: {
                    fontSize: "13px",
                    fontFamily: "Public Sans",
                    colors: labelColor,
                },
            },
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
        yaxis: {
            labels: {
                style: {
                    fontSize: "13px",
                    fontFamily: "Public Sans",
                    colors: labelColor,
                },
            },
        },
        responsive: [
            {
                breakpoint: 1700,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: "35%",
                        },
                    },
                },
            },
            {
                breakpoint: 1440,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 12,
                            columnWidth: "43%",
                        },
                    },
                },
            },
            {
                breakpoint: 1300,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 11,
                            columnWidth: "45%",
                        },
                    },
                },
            },
            {
                breakpoint: 1200,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 11,
                            columnWidth: "37%",
                        },
                    },
                },
            },
            {
                breakpoint: 1040,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 12,
                            columnWidth: "45%",
                        },
                    },
                },
            },
            {
                breakpoint: 991,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 12,
                            columnWidth: "33%",
                        },
                    },
                },
            },
            {
                breakpoint: 768,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 11,
                            columnWidth: "28%",
                        },
                    },
                },
            },
            {
                breakpoint: 640,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 11,
                            columnWidth: "30%",
                        },
                    },
                },
            },
            {
                breakpoint: 576,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: "38%",
                        },
                    },
                },
            },
            {
                breakpoint: 440,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: "50%",
                        },
                    },
                },
            },
            {
                breakpoint: 380,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 9,
                            columnWidth: "60%",
                        },
                    },
                },
            },
        ],
        states: {
            hover: {
                filter: {
                    type: "none",
                },
            },
            active: {
                filter: {
                    type: "none",
                },
            },
        },
    };
    if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
        const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
        totalRevenueChart.render();
    }
});
</script>
@endpush