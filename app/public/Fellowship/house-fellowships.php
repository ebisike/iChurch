<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    $houseFellowship = new HouseFellowship();
    
    if(isset($_GET['del']))
    {
        $Id = $_GET['del'];
        $houseFellowship->deleteFellowshipUnit($Id, $_SESSION['orgId']);
    }

    if(isset($_GET['retain']))
    {
        $phone = $_GET['retain'];
        $firstTimer->retainFirstTimer($phone, $_SESSION['orgId']);
    }
?>

<?php
    if(!$userRoleRegular)
    {
        echo 
        '
            <div class="p-3">
                <a href="add_house_fellowship.php" class="btn btn-primary p-1 font-weight-bold"> <i
                        class="fa fa-plus fa-1x bg-primary p-1 text-white"></i> Add House Fellowship</a>
                <a href="assignmembers.php" class="btn btn-info p-1 font-weight-bold"> <i
                        class="fa fa-plus fa-1x bg-info p-1 text-white"></i> Add Members to House Fellowship</a>
            </div>
        ';
    }
?>


<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All House Fellowships</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fellowship Name</th>
                            <th>Co-ordinator Name</th>
                            <th>Address</th>
                            <th>Meeting Time</th>
                            <th>Meeting Day</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Fellowship Name</th>
                            <th>Co-ordinator Name</th>
                            <th>Address</th>
                            <th>Meeting Time</th>
                            <th>Meeting Day</th>
                            <th>Date Created</th>
                        </tr>
                    </tfoot>
                    <tbody class="text-dark">
                        <?php
                        $count = 0;
                        $results = $houseFellowship->getAllFellowshipUnits($_SESSION['orgId']);
                        //echo (json_encode($results->getResults()));
                        // $time = strtotime($result['meetingtime']);
                        // $h = date('H:i:s', $time);
                        // $m = date('i', $time);
                        while($result = $results->getResults())
                        {
                            $date = toLongDateString($result['datecreated']);
                            $fullname = $result['firstName'].' '.$result['otherName'].' '.$result['lastName'];
                            echo
                            '
                                <tr class="text-dark">
                                    <td>'.++$count.'</td>
                                    <td>'.$result['fellowshipname'].'</td>
                                    <td class="text-uppercase"><a href="../members/view.php?find='.$result['Id'].'">'.$fullname.'</a></td>
                                    <td>'.$result['addresss'].'</td>
                                    <td>'.$result['meetingtime'].'</td>
                                    <td>'.$result['meetingday'].'</td>
                                    <td>'.$date.'</td>
                                    <td>                                        
                                        <a href="house-fellowships.php?del='.$result['Id'].'"><i class="fa fa-trash fa-1x text-danger"></i></a> |
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    require ('../shared/_footer.php');
?>