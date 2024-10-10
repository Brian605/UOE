@php use Carbon\Carbon; @endphp
@extends('Admin.backend')
@section('content')
<div class="content">

    <!-- END Store Growth -->
    <div class="row d-flex justify-content-evenly">
        <div class="col-md-6">
            <!-- Store Growth -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        Income Vs Expenditure
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="p-md-2 p-lg-3 w-100" style="height: 450px;">
                        <!-- Bars Chart Container -->
                        <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
                        <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                        <canvas id="js-chartjs-analytics-bars"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        Income Trend This Month
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="p-md-2 p-lg-3 w-100" style="height: 450px;">
                        <!-- Bars Chart Container -->
                        <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
                        <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                        <canvas id="incomechart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        Expense Trend This Month
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="p-md-2 p-lg-3 w-100" style="height: 450px;">
                        <!-- Bars Chart Container -->
                        <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
                        <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                        <canvas id="expensechart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        Expense By Category
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="p-md-2 p-lg-3 w-100" style="height: 450px;">
                        <!-- Bars Chart Container -->
                        <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
                        <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                        <canvas id="expcat"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        let incomeLabels=[]
        let expenseLabels=[]
        let chatExpenseData=[];
        let expenseCategoryLabels=[]
        let expenseCategoryData=[]

        function getExpenseByCategory() {
            $.ajax({
                method:'GET',
                url:'/getExpenseByCategory',
                success:function (rsp) {
                    console.log(rsp)
                    rsp.forEach(income=>{
                        expenseCategoryLabels.push(income[0])
                        expenseCategoryData.push(income[1])
                    })
                    let expenseCategoryPieData = {
                        labels: expenseCategoryLabels,
                        datasets: [
                            {
                                data: expenseCategoryData
                            },

                        ]
                    };
                    new Chart(document.getElementById('expcat'), {type: 'doughnut', data: expenseCategoryPieData, options: { responsive: true, maintainAspectRatio: false, tension: .4 }});


                }
            })
        }

        $(()=>{
            $.ajax({
                method:'GET',
                url:'/expenseAndIncome',
                success:function (rsp) {
                    rsp.incomes.forEach(income=>{
                        chatLineLabels.push((new Date(income.date)).toLocaleDateString())
                        chatIncomeData.push(income.amount)
                        incomeLabels.push((new Date(income.date)).toLocaleDateString())

                    })
                    rsp.expenses.forEach(income=>{
                        chatLineLabels.push((new Date(income.date)).toLocaleDateString())
                        chatExpenseData.push(income.cost)
                        expenseLabels.push((new Date(income.date)).toLocaleDateString())

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

                    let incomeBarData = {
                        labels: incomeLabels,
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
                        ]
                    };
                    new Chart(document.getElementById('incomechart'), {type: 'bar', data: incomeBarData, options: { responsive: true, maintainAspectRatio: false, tension: .4 }});


                    let expenseBarData = {
                        labels: expenseLabels,
                        datasets: [
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
                     new Chart(document.getElementById('expensechart'), {type: 'bar', data: expenseBarData, options: { responsive: true, maintainAspectRatio: false, tension: .4 }});

                    getExpenseByCategory()

                }
            })
        })
    </script>
@endpush
