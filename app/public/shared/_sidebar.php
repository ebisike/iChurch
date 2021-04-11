<?php
    require ('../../Services/init.php');
    include ('../../web/controllers/accounthandler.php');
    require ('../../web/controllers/usermanagement.php');
    include ('../../web/controllers/administrationController.php');
    include ('../../web/controllers/formshandler.php');
    include ('../../web/controllers/finance-handlers.php');
    include ('../../web/controllers/QuickSearch.php');


    $account->isSignedIn();
    //$account->isExpired();

    //get current user details
    $currentuser = $user->getUser($_SESSION['userId'], $_SESSION['orgId']);
    $userImage_src = '../users/images/'. $currentuser['imagepath'];

    //organisation
    $organisation = new Organisations();
    $orgname = $organisation->getOrgName($_SESSION['orgId']);
    $orgemail = $organisation->getOrgEmail($_SESSION['orgId']);

    //function to get ToDateString
    function toLongDateString($dateParameter)
    {
        $currentYear = date('Y');
        $currentMonth = date('M');
        $currentDay = date('D');

        $date = strtotime($dateParameter);        
        $day = date('d', $date);
        $Day = date('D', $date);
        $month = date('M', $date);
        $year = date('Y', $date);

        switch ($month) {
            case 'Jan':
                $month = 'January';
                break;
            case 'Feb':
                $month = 'Febuary';
                break;
            case 'Mar':
                $month = 'March';
                break;
            case 'Apr':
                $month = 'April';
                break;
            case 'May':
                $month = 'May';
                break;
            case 'Jun':
                $month = 'June';
                break;
            case 'Jul':
                $month = 'July';
                break;
            case 'Aug':
                $month = 'August';
                break;
            case 'Sep':
                $month = 'September';
                break;
            case 'Oct':
                $month = 'October';
                break;
            case 'Nov':
                $month = 'November';
                break;
            case 'Dec':
                $month = 'December';
                break;
            
            default:
                # code...
                break;
        }

        switch ($Day) {
            case 'Sun':
                $Day = 'Sunday';
                break;
            case 'Mon':
                $Day = 'Monday';
                break;
            case 'Tue':
                $Day = 'Tuesday';
                break;
            case 'Wed':
                $Day = 'Wednesday';
                break;
            case 'Thu':
                $Day = 'Thursday';
                break;
            case 'Fri':
                $Day = 'Friday';
                break;
            case 'Sat':
                $Day = 'Saturday';
                break;
            
            default:
                # code...
                break;
        }

        return  $Day.', '.$day.' '.$month.', '.$year;
    }

    function toShortDateString($dateParameter)
    {
        $currentYear = date('Y');
        $currentMonth = date('M');
        $currentDay = date('D');

        $date = strtotime($dateParameter);        
        $day = date('d', $date);
        $Day = date('D', $date);
        $month = date('M', $date);
        $year = date('Y', $date);

        return  $Day.' '.$day.' '.$month.', '.$year;
    }

    function calculateAge($dateParameter)
    {
        $currentYear = date('Y');        
        $date = strtotime($dateParameter);        
        $year = date('Y', $date);
        return  $currentYear - $year;
    }

    //get current user role
    $userRoleSuperAdmin = $userInRole->isUserInRole("superadmin", $_SESSION['userId'], $_SESSION['orgId']);
    $userRoleSecretary = $userInRole->isUserInRole("secretary", $_SESSION['userId'], $_SESSION['orgId']);
    $userRoleLeadPastor = $userInRole->isUserInRole("lead_pastor", $_SESSION['userId'], $_SESSION['orgId']);
    $userRoleAsstPastor = $userInRole->isUserInRole("asst_pastor", $_SESSION['userId'], $_SESSION['orgId']);
    $userRoleRegular = $userInRole->isUserInRole("regular", $_SESSION['userId'], $_SESSION['orgId']);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../../bootstrap/assets/images/spaco-icon3-128x109.png" type="image/x-icon">
    <meta name="description" content="">
    <meta name="author" content="">    

    <title>iChurch | Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../bootstrap/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../bootstrap/css/mtabs.css" rel="stylesheet">
    <link href="../../bootstrap/vendor/select2/select2.min.css" rel="stylesheet">

    <!-- CHARTS PUGLIN CDN -->
    <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->

</head>

<body id="page-top">
    <style>
        .subscribe{
            cursor: pointer !important;
        }
    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <!-- <div class="sidebar-brand-text mx-3">SB <?php echo $currentuser['username']?> <sup>2</sup></div> -->
                <div class="sidebar-brand-text mx-3 text-lowercase">iChurch <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../mgt/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#calendar" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Church Calendar</span>
                </a>
                <div id="calendar" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <?php
                            if($userRoleSuperAdmin || $userRoleLeadPastor)
                            {
                                    echo '<a class="collapse-item" href="../Calendar/calendar.php">Calendar Event</a>';
                            }
                        ?>
                        <!-- <a class="collapse-item" href="../Calendar/AllEvents.php">list all users</a> -->
                        <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
                    </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Users</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <?php
                            if($userRoleSuperAdmin || $userRoleLeadPastor)
                            {
                                    echo '<a class="collapse-item" href="../users/create.php">create a user</a>';
                            }
                        ?>
                        <a class="collapse-item" href="../users/listusers.php">list all users</a>
                        <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <?php
                if($userRoleSuperAdmin || $userRoleLeadPastor)
                {
                    echo 
                    '
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                                <i class="fas fa-fw fa-wrench"></i>
                                <span>Administration Utilities</span>
                            </a>
                            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Custom Utilities:</h6>
                                    ';
                                    if($userRoleSuperAdmin)
                                    {
                                        echo
                                        '                                            
                                            <a class="collapse-item" href="../administration/deleteRole.php">Delete Role</a>
                                            <a class="collapse-item" href="../administration/createRole.php">Create Role</a>
                                        ';
                                    }
                                    echo'
                                    <a class="collapse-item" href="../administration/listrole.php">List Role</a>
                                    <a class="collapse-item" href="../administration/addusertorole.php">Add Users To Role</a>
                                    <a class="collapse-item" href="../administration/removeUserFromRole.php">Remove User From Role</a>
                                </div>
                            </div>
                        </li>
                    ';
                }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Quick search -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#quicksearch" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-search"></i>
                    <span>Quick Search</span>
                </a>
                <div id="quicksearch" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Search for future events:</h6>
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#quickSearchBirthday">Birthdays</a>
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#quickSearchAnniversary">Wedding Anniversary</a>
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#familyTree">Family Tree</a>
                        <!-- <a class="collapse-item" href="../members/deathlist.php">Death List</a>                        -->
                    </div>
                </div>
            </li>

            <!-- Membership -->
            <?php
                if(!$userRoleRegular)
                {
                    echo
                    '
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#membership" aria-expanded="true" aria-controls="collapsePages">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Membership</span>
                        </a>
                        <div id="membership" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Data Management Screens:</h6>
                                <a class="collapse-item" href="../members/familytree.php">Register Form</a>
                                <a class="collapse-item" href="../members/allmembers.php">Members List</a>
                                <a class="collapse-item" href="../members/familymembers.php">Family Tree</a>
                                <a class="collapse-item" href="../members/deathlist.php">Death List</a>                       
                            </div>
                        </div>
                    </li>
                    ';
                }
            ?>            
            
             <!-- Attendance -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#attendance" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Attendance</span>
                </a>
                <div id="attendance" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Attendance Register:</h6>                                                
                        <a class="collapse-item" href="../Attendance/viewall.php">View Attendance</a>                        
                    </div>
                </div>
            </li>

            <!-- Finance -->
            <?php
                if(!$userRoleRegular)
                {
                    echo 
                    '
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#finance" aria-expanded="true" aria-controls="collapsePages">
                                <i class="fas fa-fw fa-folder"></i>
                                <span>Finance</span>
                            </a>
                            <div id="finance" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Financial mgt Screens:</h6>                                                
                                    <a class="collapse-item" href="../finance/financerecords.php">Financial Records</a>                        
                                    <a class="collapse-item" href="../finance/credit-records.php">Credit Records</a>
                                    <a class="collapse-item" href="../finance/debit-records.php">Debit Records</a>
                                </div>
                            </div>
                        </li>
                    ';
                }
            ?>    
            
            
            <!-- Events and First Timers -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#events" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Events and First Timers</span>
                </a>
                <div id="events" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Events Screens:</h6>
                        <a class="collapse-item" href="../Events/allevents.php">All Events</a>                        
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">First Timers Pages:</h6>
                        <a class="collapse-item" href="../First_Timers/allfirsttimers.php">All First Timers</a>
                        <a class="collapse-item" href="../First_Timers/retainedfirsttimers.php">Retained First Timers</a>
                    </div>
                </div>
            </li>

            <!-- House Fellowship and Units -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fellowshipDrop" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>House Fellowships</span>
                </a>
                <div id="fellowshipDrop" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">House Fellowships Screens:</h6>
                        <a class="collapse-item" href="../Fellowship/house-fellowships.php">All House Fellowships</a>
                        <a class="collapse-item" href="../Fellowship/view-fellowship-members.php">Members List</a>
                    </div>
                </div>
            </li>

            <!-- House Fellowship and Units -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#units" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Church Units</span>
                </a>
                <div id="units" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Units Pages:</h6>
                        <a class="collapse-item" href="../Units/units.php">All Church Units</a>
                        <a class="collapse-item" href="../Units/retainedfirsttimers.php">Retained First Timers</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Member Records Table</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="p-0">

