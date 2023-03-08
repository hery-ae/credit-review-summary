<x-layout>
<x-slot name="title">Dashboard - {{ config('app.name') }}</x-slot>
					<!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class="subheader-icon fal fa-chart-area"></i> Dashboard
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div id="panel-assignment" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="barChart">
                                                <canvas style="width:100%; height:300px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div id="panel-CRS-management-approval" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="barChart">
                                                <canvas style="width:100%; height:300px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <!-- END Page Content -->

@push('scripts')
    <script src="js/statistics/chartjs/chartjs.bundle.js"></script>
    <script type="text/javascript">
        $(document).ready( function() {
            /* bar chart */
            var barChartData = {
                labels: ["S.M.E.", "Commercial", "Corporate"],
                datasets: [
                {
                    label: "Assignment",
                    backgroundColor: color.primary._300,
                    borderColor: color.primary._500,
                    borderWidth: 1,
                    data: [
                        3,
                        1,
                        0
                    ]
                }]

            };

            var config = {
                type: 'bar',
                data: barChartData,
                options:
                {
                    responsive: true,
                    legend:
                    {
                        position: 'top',
                    },
                    title:
                    {
                        display: false,
                        text: 'Bar Chart'
                    },
                    scales:
                    {
                        xAxes: [
                        {
                            display: true,
                            scaleLabel:
                            {
                                display: false,
                                labelString: 'Segmentations'
                            },
                            gridLines:
                            {
                                display: true,
                                color: "#f2f2f2"
                            },
                            ticks:
                            {
                                beginAtZero: true,
                                fontSize: 11
                            }
                        }],
                        yAxes: [
                        {
                            display: true,
                            scaleLabel:
                            {
                                display: false,
                                labelString: 'Quantity of segmentation'
                            },
                            gridLines:
                            {
                                display: true,
                                color: "#f2f2f2"
                            },
                            ticks:
                            {
                                beginAtZero: true,
                                stepSize: 1,
                                fontSize: 11
                            }
                        }]
                    }
                }
            }

            new Chart($("#panel-assignment").find(".barChart > canvas").get(0).getContext("2d"), config);

            /* bar chart -- end */

            /* bar chart */
            var barChartData = {
                labels: ["S.M.E.", "Commercial", "Corporate"],
                datasets: [
                {
                    label: "CRS Management Approval",
                    backgroundColor: color.fusion._300,
                    borderColor: color.fusion._500,
                    borderWidth: 1,
                    data: [
                        3,
                        1,
                        0
                    ]
                }]

            };

            var config = {
                type: 'bar',
                data: barChartData,
                options:
                {
                    responsive: true,
                    legend:
                    {
                        position: 'top',
                    },
                    title:
                    {
                        display: false,
                        text: 'Bar Chart'
                    },
                    scales:
                    {
                        xAxes: [
                        {
                            display: true,
                            scaleLabel:
                            {
                                display: false,
                                labelString: 'CRS management & approval'
                            },
                            gridLines:
                            {
                                display: true,
                                color: "#f2f2f2"
                            },
                            ticks:
                            {
                                beginAtZero: true,
                                fontSize: 11
                            }
                        }],
                        yAxes: [
                        {
                            display: true,
                            scaleLabel:
                            {
                                display: false,
                                labelString: 'Quantity of CRS management & approval'
                            },
                            gridLines:
                            {
                                display: true,
                                color: "#f2f2f2"
                            },
                            ticks:
                            {
                                beginAtZero: true,
                                stepSize: 1,
                                fontSize: 11
                            }
                        }]
                    }
                }
            }

            new Chart($("#panel-CRS-management-approval").find(".barChart > canvas").get(0).getContext("2d"), config);

            /* bar chart -- end */
        });

    </script>
@endpush
</x-layout>
