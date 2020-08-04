<?php
    #get notigications
    $childrenWeeklyBirthdayCount =  $notify->countChildrenWeeklyBirthday($_SESSION['orgId']);
    //$childrenWeeklyBirthdayCount =  $notify->getChildrenWeeklyBirthday($_SESSION['orgId']);
    $childrenDailyBirthdayCount = $notify->countChildrenDailyBirthday($_SESSION['orgId']);

    //var_dump($childrenDailyBirthdayCount);
    $memberWeeklyBirthdayCount = $notify->countMemberWeekilyBirthday($_SESSION['orgId']);
    $memberDailyBirthdayCount = $notify->countMemberDailyBirthday($_SESSION['orgId']);
    $dailyMarriageAnni = $notify->countMemberDailyWeddingAnniversary($_SESSION['orgId']);
    $weeklyMarriageAnni = $notify->countMemberWeeklyWeddingAnniversary($_SESSION['orgId']);
?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Children Alert -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><?php echo $childrenWeeklyBirthdayCount?></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Children Weekly Birthday Alert
                </h6>
                <?php 
                    $count = 0;
                    $results = $notify->getChildrenWeeklyBirthday($_SESSION['orgId']);
                    if($results == null)
                    {
                        echo 'No Birthday this week';
                    }
                    else
                    {
                        while($result = $results->getResults())
                        {
                            if($count == 3){
                            break;
                            }
                            
                            echo
                            '
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-smile-beam text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">'.toLongDateString($result['dateOfBirth']).'</div>
                                        <span class="font-weight-bold">'.$result['firstName'].' '.$result['otherName'].'</span>
                                    </div>
                                </a>
                            ';
                            $count++;
                        }
                    }
                ?>                                
                <a class="dropdown-item text-center small text-gray-500" href="../alerts/childrenbirthdays.php?childrenBirthday">Show All Alerts</a>
            </div>
        </li>

        <!-- Nav Item - Adult Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><?php echo $memberWeeklyBirthdayCount?></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Members Weekly Birthday Alerts
                </h6>
                <?php 
                    $count = 0;
                    $results = $notify->getMemberWeeklyBirthday($_SESSION['orgId']);
                    if($results == NULL || empty($results) )
                    {
                        echo 'No data';
                    }
                    else
                    {
                        while($result = $results->getResults())
                        {
                            if($count == 3){
                            break;
                            }
                            
                            echo
                            '
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">                                            
                                            <img src="../users/images/'.$result['imagepath'].'" class="img img-responsive img-thumbnail" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">'.toLongDateString($result['dateOfBirth']).'</div>
                                        <span class="font-weight-bold">'.$result['lastName'].' '.$result['firstName'].' '.$result['otherName'].'</span>
                                    </div>
                                </a>
                            ';
                            $count++;
                        }
                    }
                ?>
                <a class="dropdown-item text-center small text-gray-500" href="../alerts/memberbirthday.php?memberBirthday">Show All Alerts</a>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-heart fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"><?php echo $weeklyMarriageAnni ?></span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Wedding Anniversaries
                </h6>
                <?php 
                    $count = 0;
                    $results = $notify->getMemberWeeklyWeddingAnniversary($_SESSION['orgId']);
                    if($results == NULL || empty($results) )
                    {
                        echo 'No data';
                    }
                    else
                    {
                        while($result = $results->getResults())
                        {
                            if($count == 3){
                            break;
                            }
                            
                            echo
                            '
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-danger">
                                            <i class="fas fa-heart text-white"></i>                                            
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">'.toLongDateString($result['dateofmarriage']).'</div>
                                        <span class="font-weight-bold">'.$result['lastName'].' '.$result['firstName'].' '.$result['otherName'].'</span>
                                    </div>
                                </a>
                            ';
                            $count++;
                        }
                    }
                ?>
                <a class="dropdown-item text-center small text-gray-500" href="../alerts/anniversarry.php?anni">Read More Messages</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo strtoupper($currentuser['firstName'].' ' . $currentuser['lastName'])?></span>
                <img class="img-profile rounded-circle" src="<?php echo $userImage_src?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
