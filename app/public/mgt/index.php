<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    #unset form data sessions
    unset($_SESSION['lastId']);
    unset($_SESSION['familyId']);   

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- NOTIFICATION PREVIEW -->
    <?php
        if(isset($_GET['childrenBirthday']) || isset($_GET['memberBirthday']) || isset($_GET['anni']))
        {
            if(isset($_GET['childrenBirthday']))
            {
                $daily = $notify->getChildrenDailyBirthday($_SESSION['orgId']);
                $weekly = $notify->getChildrenWeeklyBirthday($_SESSION['orgId']);
                echo '<div class="mb-2 bg-danger">';
                        if($daily == null)
                        {
                            echo 'No data';
                        }
                        else
                        {
                            echo '<div class="card"> <div class="align-center"><center>Children Celebrating Today</center></div>';
                            while($result = $daily->getResults())
                            {
                                #daily birthday
                                echo
                                '
                                    <div class="">
                                        
                                        <div class="">
                                            <p>'.toLongDateString($result['dateOfBirth']).' | '.calculateAge($result['dateOfBirth']).' years old</p>
                                            <h5>'.$result['firstName'].' '.$result['otherName'].'</h5>
                                        </div>
                                    </div>
                                ';
                            }
                            echo '</div>';
                        }

                        if($weekly == null)
                        {
                            echo 'No weekly';
                        }
                        else
                        {
                            while($result = $weekly->getResults())
                            {
                                #weekly birthday
                                echo
                                '
                                    <div class="card mb-2">
                                        <div class="card-header">Children Celebrating this week!</div>
                                        <div class="card-body">
                                            <p>'.toLongDateString($result['dateOfBirth']).' | '.calculateAge($result['dateOfBirth']).' years old</p>
                                            <h5>'.$result['firstName'].' '.$result['otherName'].'</h5>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                echo '</div>';
            }
            elseif(isset($_GET['memberBirthday']))
            {
                //echo member
            }
            elseif(isset($_GET['anni']))
            {
                //echo anni
            }
        }
    ?>
    
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <div class="chart-area">
                        <input type="hidden" value="" id="fintec-report" data-report>
                        <canvas id="myAreaChart"></canvas>
                    </div> -->
                    <input type="hidden" id="fintec-report-revenue" data-report>
                    <input type="hidden" id="fintec-report-title-revenue" data-report>
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div> -->
                    <input type="hidden" id="source-list" data-report>
                    <div id="myPieChart" style="height: 300px; width: 100%;"></div>
                    <!-- <div class="mt-4 text-center small">
                        <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart Expenditure -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Expenditure Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <div class="chart-area">
                        <input type="hidden" value="" id="fintec-report" data-report>
                        <canvas id="myAreaChart"></canvas>
                    </div> -->
                    <input type="hidden" id="fintec-report-expenditure" data-report>
                    <input type="hidden" id="fintec-report-title-expenditure" data-report>
                    <div id="exchartContainer" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Expenditure Sources</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div> -->
                    <input type="hidden" id="source-list-expenditure" data-report>
                    <div id="exMyPieChart" style="height: 300px; width: 100%;"></div>
                    <!-- <div class="mt-4 text-center small">
                        <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>


    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <!-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div> -->

            <!-- Color System -->
            <!-- <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Success
                            <div class="text-white-50 small">#1cc88a</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Info
                            <div class="text-white-50 small">#36b9cc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Warning
                            <div class="text-white-50 small">#f6c23e</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Danger
                            <div class="text-white-50 small">#e74a3b</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secondary
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <!-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                    </div>
                    <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without
                        attribution!
                    </p>
                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
            </div> -->

            <!-- Approach -->
            <!-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                    <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
            </div> -->

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    //let v = document.querySelector('#datas')
    //console.log("elelmt",v)
</script>



<?php
    require ('../shared/_footer.php');
?>

<!-- SCRIPT TAG FOR GET REPORTS -->
<script src="../../bootstrap/js/custom/charts/line-chart.js"></script>
<script src="../../bootstrap/js/custom/charts/pie-chart.js"></script>
<script src="../../bootstrap/js/custom/charts/chartDataFunctions.js"></script>

<script>
    $(document).ready(function(){
        let v = document.querySelector('#fintec-report-revenue')
        let w = document.querySelector('#source-list')

        let title = document.querySelector('#fintec-report-title-revenue')
        let title2 = document.querySelector('#fintec-report-title-expenditure')
        title.value = "Revenue Financial graph for the year"
        title2.value = "Expenditure graph for the year"
        

        $.ajax({
            method: "GET",
            url: "../api/reports.php?lineChart",
            success: function(resp){
                //console.log("You darat",JSON.parse(resp));                
                let reportObj = JSON.parse(resp)
                //console.log(reportObj)
                let graphData = buildLineChartData(reportObj)
                //console.log("ertyujh", graphData)
                //v.setAttribute('value', graphData)
                revenueLineChart(graphData)
                
            },
            error: function(resp){
                console.log('hereee')
            }
        })

        $.ajax({
            method: "GET",
            url: "../api/reports.php?pieChart",
            success: function(resp){
                let respObj = JSON.parse(resp)
                //console.log("gotten",respObj)
                let graphData = buildPieData(respObj)
                //w.setAttribute('value', graphData)
                console.log("You data" + graphData)
                //console.log(w)
                revenuePieChart(graphData)
            }
        })

        let expenditureGraphDiv = document.getElementById('fintec-report-expenditure')
        let expenditurePieDiv = document.getElementById('source-list-expenditure');

        $.ajax({
            method: "GET",
            url: "../api/reports.php?expenseGraph",
            success: function(resp){
                let reportObj = JSON.parse(resp);
                //console.log("Expenditure", reportObj)
                let obj = buildLineChartData(reportObj)
                //expenditureGraphDiv.setAttribute('value', obj)
                expenditureLineChart(obj)

            },
            error: function(resp){
                alert('Failed to get data for graph')
            }
        })

        //make asynchronous call to get data for expenditure pie chart
        $.ajax({
            method: "GET",
            url: "../api/reports.php?expensePieGraph",
            success: function(resp){
                let reportObj = JSON.parse(resp);
                //console.log("Expenditure Pie", reportObj)
                let obj = buildPieData(reportObj)
                //expenditurePieDiv.setAttribute('value', obj)
                //console.log(expenditurePieDiv)
                expenditurePieChart(obj)

            },
            error: function(resp){
                alert('Failed to get data for graph')
            }
        })        
    })
    
    
</script>