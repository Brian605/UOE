@php use Carbon\Carbon; @endphp
@extends('Admin.backend')
@section('content')
<div class="content">
    <div class="row items-push">
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1">
                    <div class="item rounded-3 bg-body mx-auto my-3">
                        <i class="fa fa-users fa-lg text-primary"></i>
                    </div>
                    <div class="fs-1 fw-bold">{{\App\Models\User::count()}}</div>
                    <div class="text-muted mb-3">Users</div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-primary fs-sm">
                    <a class="fw-medium text-white" href="/users">
                        View all users
                        <i class="fa fa-arrow-right ms-1 opacity-75"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1">
                    <div class="item rounded-3 bg-body mx-auto my-3">
                        <i class="fa fa-magnifying-glass-chart fa-lg text-warning"></i>
                    </div>
                    <div class="fs-1 fw-bold">{{\App\Models\Research::count()}}</div>
                    <div class="text-muted mb-3">Research Projects</div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-warning fs-sm">
                    <a class="fw-medium text-white" href="/research">
                        View Projects
                        <i class="fa fa-arrow-right ms-1 opacity-75"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1">
                    <div class="item rounded-3 bg-body mx-auto my-3">
                        <i class="fa fa-tree fa-lg text-success"></i>
                    </div>
                    <div class="fs-1 fw-bold">{{\App\Models\Crops::count()}}</div>
                    <div class="text-muted mb-3">Crops</div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-success fs-sm">
                    <a class="fw-medium text-white" href="/crops/lists">
                        View all Crops
                        <i class="fa fa-arrow-right ms-1 opacity-75"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1">
                    <div class="item rounded-3 bg-body mx-auto my-3">
                        <i class="fa fa-cow fa-lg text-danger"></i>
                    </div>
                    <div class="fs-1 fw-bold">{{\App\Models\Livestock::count()}}</div>
                    <div class="text-muted mb-3">Livestock</div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-danger fs-sm">
                    <a class="fw-medium text-white" href="/livestock/list">
                        View all Livestock
                        <i class="fa fa-arrow-right ms-1 opacity-75"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Store Growth -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Farm Growth
            </h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-5 col-xl-4 d-md-flex align-items-md-center">
                    <div class="p-md-2 p-lg-3">
                        <div class="py-3">
                            @php
                                $lastMonth = Carbon::now()->subMonth()->month;
$year = Carbon::now()->subMonth()->year;

$lastMonthincome = \App\Models\Income::whereMonth('date', $lastMonth)
    ->whereYear('date', $year)
    ->sum('amount');
$thisMonthIncome= \App\Models\Income::whereMonth('date',Carbon::now()->month)
                            ->whereYear('date',Carbon::now()->year)
                            ->sum('amount');
                            @endphp

                            <div class="fs-1 fw-bold">Ksh.{{number_format($thisMonthIncome)}}</div>
                            <div class="fw-semibold">Income registered this month</div>
                            <div class="py-3 d-flex align-items-center">

                                @if($thisMonthIncome>$lastMonthincome)
                                    <div class="bg-success-light p-2 rounded me-3">
                                        <i class="fa fa-fw fa-arrow-up text-success"></i>
                                    </div>
                                    <p class="mb-0">
                                        You have a <span class="fw-semibold text-success">{{floor((($thisMonthIncome-$lastMonthincome)/$thisMonthIncome)*100)}}% revenue growth</span> in the last 30 days. This is amazing, keep it up!
                                    </p>
                                @elseif($thisMonthIncome==$lastMonthincome)
                                    <div class="bg-info-light p-2 rounded me-3">
                                        <i class="fa fa-fw fa-minus text-info"></i>
                                    </div>
                                    <p class="mb-0">
                                        You have a <span class="fw-semibold text-success">No revenue growth</span> in the last 30 days.Keep pushing!
                                    </p>
                                @else
                                    <div class="bg-danger-light p-2 rounded me-3">
                                        <i class="fa fa-fw fa-arrow-down text-danger"></i>
                                    </div>
                                    <p class="mb-0">
                                        You have a <span class="fw-semibold text-success">{{floor((($lastMonthincome-$thisMonthIncome)/$lastMonthincome)*100)}}% decrease in revenue</span> in the last 30 days. This is Bad!
                                    </p>
                                @endif

                            </div>
                        </div>
                        <div class="py-3">
                            <div class="fs-1 fw-bold">{{number_format(\App\Models\FinanceRecord::whereYear('date',Carbon::now()->year)->whereMonth('date',Carbon::now()->month)->sum('cost'))}}</div>
                            <div class="fw-semibold">Spent in expenses this month</div>
                            <div class="py-3 d-flex align-items-center">
                                <div class="bg-warning-light p-2 rounded me-3">
                                    <i class="fa fa-fw fa-lightbulb text-warning"></i>
                                </div>
                                <p class="mb-0">
                                    @php $groupWithMaxSum = \App\Models\FinanceRecord::
     select('category_id',DB::raw('SUM(cost) as total_amount'))
    ->groupBy('category_id')
    ->orderBy('cost', 'desc')
    ->first(); @endphp
                                   Most of your expenses were on  <span class="fw-semibold text-success">{{$groupWithMaxSum==null?'N/A':\App\Models\ItemCategory::find($groupWithMaxSum->category_id)->name}}</span> with a total expense of Ksh.{{$groupWithMaxSum==null?'0':number_format($groupWithMaxSum->total_amount)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-xl-8 d-md-flex align-tems-md-center">
                    <div class="p-md-2 p-lg-3 w-100" style="height: 450px;">
                        <!-- Bars Chart Container -->i
                        <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
                        <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                        <canvas id="js-chartjs-analytics-bars"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Store Growth -->

</div>
@endsection
@push('scripts')
    <script src="{{asset('js/plugins/chart.js/chart.umd.js')}}"></script>
    <script>
        Chart.defaults.color = '#818d96';
        Chart.defaults.scale.grid.color = "rgba(0,0,0,.04)";
        Chart.defaults.scale.grid.zeroLineColor = "rgba(0,0,0,.1)";
        Chart.defaults.scale.beginAtZero = true;
        Chart.defaults.elements.line.borderWidth = 2;
        Chart.defaults.elements.point.radius = 5;
        Chart.defaults.elements.point.hoverRadius = 7;
        Chart.defaults.plugins.tooltip.radius = 3;
        Chart.defaults.plugins.legend.labels.boxWidth = 12;

        let chatArea=document.getElementById("js-chartjs-analytics-bars");
        let chatLineLabels=[];
        let chatLines;
        let chatIncomeData=[];
        let chatExpenseData=[];

        $(()=>{
            $.ajax({
                method:'GET',
                url:'expenseAndIncome',
                success:function (rsp) {
                    rsp.incomes.forEach(income=>{
                        chatLineLabels.push((new Date(income.date)).toLocaleDateString())
                        chatIncomeData.push(income.amount)
                    })
                    rsp.expenses.forEach(income=>{
                        chatLineLabels.push((new Date(income.date)).toLocaleDateString())
                        chatExpenseData.push(income.cost)
                    })

                    chatLineLabels.sort(function(a, b) {
                        if (a.date < b.date) { return -1; }
                        if (a.date > b.date) { return 1; }
                        return 0;
                    })
                    let chartLinesBarsRadarData = {
                        labels: chatLineLabels,
                        datasets: [
                            {
                                label: 'Income',
                                fill: true,
                                backgroundColor: 'rgb(62,152,59)',
                                borderColor: 'rgb(62,152,59)',
                                pointBackgroundColor: 'rgb(248,179,2)',
                                pointBorderColor: '#fff',
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: 'rgb(62,152,59)',
                                data: chatIncomeData
                            },
                            {
                                label: 'Expenses',
                                fill: true,
                                backgroundColor: 'rgba(230,4,46,0.27)',
                                borderColor: 'rgb(255,159,13)',
                                pointBackgroundColor: 'rgb(157,4,32)',
                                pointBorderColor: '#fff',
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: 'rgb(230,4,46)',
                                data: chatExpenseData
                            }
                        ]
                    };
                    chartLines = new Chart(chatArea, {type: 'line', data: chartLinesBarsRadarData, options: { responsive: true, maintainAspectRatio: false, tension: .4 }});


                }
            })
        })
    </script>
@endpush
