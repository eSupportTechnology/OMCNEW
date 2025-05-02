<?php $__env->startSection('content'); ?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    .bg-gradient-warning {
        background: linear-gradient(45deg, #FF9800, #FFC107);
    }
    .bg-gradient-success {
        background: linear-gradient(45deg, #4CAF50, #81C784);
    }
    .bg-gradient-info {
        background: linear-gradient(45deg, #00ACC1, #4DD0E1);
    }
    .bg-gradient-danger {
        background: linear-gradient(45deg, #F44336, #E57373);
    }

    .text-end {
        font-weight: bold;
    }


    .chart-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .chart-item {
    display: flex;
    flex-direction: column;
    }

    .chart-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: #fff;
        border-radius: 5px;
        padding: 20px;
    }

    .product-names {
    font-weight: 500;
    }
 
</style>

<main style="margin-top: 50px">
    <div class="container px-5 py-4"> 
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="row align-items-center mb-3 mt-2">
            <div class="col">
                <h2 class="h5 page-title">Welcome!</h2>
            </div>
        </div>

        <section>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card bg-gradient-warning text-white" style="border-radius: 0px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-shopping-cart fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-0"><?php echo e($orderCount); ?></h3>
                                    <p class="mb-0 text-uppercase">Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card bg-gradient-success text-white" style="border-radius: 0px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center px-md-1">
                                <div class="align-self-center">
                                    <i class="fa-solid fa-dollar-sign fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-0"><?php echo e($totalCostToday); ?></h3>
                                    <p class="mb-0 text-uppercase">Today Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card bg-gradient-info text-white" style="border-radius: 0px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-0"><?php echo e($customerCount); ?></h3>
                                    <p class="mb-0 text-uppercase">Customers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card bg-gradient-danger text-white" style="border-radius: 0px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-box fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-0"><?php echo e($productCount); ?></h3>
                                    <p class="mb-0 text-uppercase">Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row mt-4 justify-content-between">

                   <!-- Bar Chart Container -->
                   <div class="col-md-8 mb-4 chart-item">
                        <div class="chart-container">
                            <div class="chart-title">Sales in the Last 12 Months</div>
                            <div id="salesBarChart"></div>
                        </div>
                    </div>

                    <!-- Line Chart Container 
                    <div class="col-md-8 mb-4 chart-item">
                        <div class="chart-container">
                            <div class="chart-title">Product Sales</div>
                            <div id="productSalesChart"></div>
                        </div>
                    </div>-->

                    <!-- Pie Chart Container -->
                    <div class="col-md-4 mb-4 chart-item">
                        <div class="chart-container">
                            <div class="chart-title">Top 5 Products</div>
                            <div id="topProductsChart"></div>
                            <div id="productNames" class="product-names"></div> 
                        </div>
                    </div>

                    <!-- Line Chart Container 
                    <div class="col-md-12 mb-4 chart-item">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="total-revenue">
                                    <span id="totalThisWeek">This Week Total Revenue: </span><br>
                                    <span id="totalLastWeek">Last Week Total Revenue: </span>
                                </div>
                                <div id="lineChart1"></div>
                            </div>
                        </div>
                    </div>-->

                </div>
            </div>

        </section>
    </div>
</main>



<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Product Sales Line Chart
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                series: [{
                    name: 'Sales',
                    data: [12, 10, 3, 4, 2, 3, 8]
                }],
                chart: {
                    type: 'line',
                    height: 240,
                    toolbar: {
                        show: false 
                    }
                },
                colors: ['#4CAF50'],
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#6c757d'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#6c757d'
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                },
                grid: {
                    borderColor: '#e0e0e0',
                    strokeDashArray: 4
                }
            };

            var chart = new ApexCharts(document.querySelector("#productSalesChart"), options);
            chart.render();
        });


    // Top Product Line Chart
    document.addEventListener('DOMContentLoaded', function () {
    var options = {
        series: <?php echo json_encode($topProducts->pluck('count'), 15, 512) ?>,
        chart: {
            type: 'donut',
            height: 250,
        },
        labels: <?php echo json_encode($topProducts->pluck('name'), 15, 512) ?>,
        colors: ['#FF6384', '#36A2EB', '#FFCE56', '#4ec26b', '#d9d748'],
        legend: {
            show: false, 
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '65%'
                }
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: '100%'
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#topProductsChart"), options);
    chart.render().then(() => {
        var productNamesContainer = document.getElementById('productNames');
        var productNames = <?php echo json_encode($topProducts->pluck('name'), 15, 512) ?>;
        var productColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4ec26b', '#d9d748']; 

        productNames.forEach(function(name, index) {
            var nameElement = document.createElement('div');
            nameElement.style.display = 'flex';
            nameElement.style.alignItems = 'center';

            var colorSquare = document.createElement('div');
            colorSquare.style.width = '15px'; 
            colorSquare.style.height = '15px'; 
            colorSquare.style.backgroundColor = productColors[index]; 
            colorSquare.style.marginRight = '5px'; 

            var textNode = document.createTextNode(name);
            nameElement.appendChild(colorSquare); 
            nameElement.appendChild(textNode); 

            productNamesContainer.appendChild(nameElement);
        });
    });
});


//sales in 12 months
document.addEventListener('DOMContentLoaded', function () {
    var salesData = <?php echo json_encode(array_values($salesIn12Months), 15, 512) ?>; 

    var options = {
        chart: {
            type: 'bar',
            height: 300
        },
        series: [{
            name: 'Sales (Rs.)',
            data: salesData 
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        title: {
            align: 'center',
            style: {
                fontSize: '20px',
                color: '#333'
            }
        },
        colors: ['#00E396'],
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            }
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'], 
                opacity: 0.5
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#salesBarChart"), options);
    chart.render();
});




 // Line Chart 
document.addEventListener('DOMContentLoaded', function () {

    const categories = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    const currentWeekSeries = [500, 600, 700, 900, 800, 500, 1000];
    const lastWeekSeries = [400, 600, 600, 800, 900, 600, 1000];
    const totalCurrentWeekRevenue = currentWeekSeries.reduce((a, b) => a + b, 0);
    const totalLastWeekRevenue = lastWeekSeries.reduce((a, b) => a + b, 0);

    // Update total revenue display
    document.getElementById('totalThisWeek').innerText = `This Week Total Revenue: Rs ${totalCurrentWeekRevenue.toFixed(2)}`;
    document.getElementById('totalLastWeek').innerText = `Last Week Total Revenue: Rs ${totalLastWeekRevenue.toFixed(2)}`;

    var options = {
        series: [{
            name: 'This Week',
            data: currentWeekSeries
        }, {
            name: 'Last Week',
            data: lastWeekSeries
        }],
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false 
            }
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        markers: {
            size: 0
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: categories,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                rotate: -45
            }
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return " " + value;
                }
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return "Rs " + value;
                }
            }
        },
        colors: ['#602082', '#f5991c']
    };

    var chart = new ApexCharts(document.querySelector("#lineChart1"), options);
    chart.render();
});
</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/index.blade.php ENDPATH**/ ?>