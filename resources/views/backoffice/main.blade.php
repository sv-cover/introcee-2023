@extends('backoffice.layout')
@section('title', 'Start')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <h2 class="mb-5">Introductory Camp</h2>
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <div class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--end::Card widget 2-->
                        <div class="card-body">
                            <i class="ki-duotone ki-user text-success fs-2x ms-n1"><span
                                    class="path1"></span><span class="path2"></span>
                            </i>
                            <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">
                                {{ \App\Models\ParticipantCamp::where('confirmed', true)->where('first_year', true)->count() }}
                            </div>
                            <div class="fw-semibold text-gray-400">
                                Confirmed First-Years
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <div class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--end::Card widget 2-->
                        <div class="card-body">
                            <i class="ki-duotone ki-user-tick text-warning fs-2x ms-n1"><span
                                    class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                    class="path4"></span>
                            </i>
                            <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">
                                {{ \App\Models\ParticipantCamp::where('first_year', true)->count() }}
                            </div>
                            <div class="fw-semibold text-gray-400">
                                First-year sign-ups
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <div class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--end::Card widget 2-->
                        <div class="card-body">
                            <i class="ki-duotone ki-profile-user text-info fs-2x ms-n1"><span
                                    class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                    class="path4"></span>
                            </i>
                            <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">
                                {{ \App\Models\ParticipantCamp::where('confirmed', true)->where('senior', true)->count() }}
                            </div>
                            <div class="fw-semibold text-gray-400">
                                Confirmed Seniors
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <div class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--end::Card widget 2-->
                        <div class="card-body">
                            <i class="ki-duotone ki-people text-primary fs-2x ms-n1"><span
                                    class="path1"></span><span class="path2"></span><span class="path3"></span>
                                <span class="path4"></span><span class="path5"></span>
                            </i>
                            <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">
                                {{ \App\Models\ParticipantCamp::where('senior', true)->count() }}
                            </div>
                            <div class="fw-semibold text-gray-400">
                                Senior sign-ups
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-body hoverable card-xl-stretch mb-xl-8">
                <!--end::Card widget 2-->
                <div class="card-body">
                    <div id="camp-chart"></div>
                    @php
                        $participantCounts = \App\Models\ParticipantCamp::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                            ->groupBy('created_at')
                            ->orderBy('created_at')
                            ->get();

                        $chartData = [];
                        foreach ($participantCounts as $count) {
                            $chartData[] = [
                                'x' => strtotime($count->date) * 1000, // Convert to Unix timestamp in milliseconds
                                'y' => $count->count,
                            ];
                        }
                    @endphp
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extrascripts')
    <script>
        var options = {
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false, // This line hides the top right controls
                },
            },
            xaxis: {
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return Math.round(value); // Round values to whole numbers
                    },
                },
            },
            series: [{
                name: 'Participants',
                data: @json($chartData),
            }],
            grid: {
                borderColor: '#ededed',
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: '#C8102E'
            },
        };

        var chart = new ApexCharts(document.querySelector("#camp-chart"), options);
        chart.render();
    </script>
@endsection
