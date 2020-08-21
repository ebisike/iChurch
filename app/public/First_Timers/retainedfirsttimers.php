<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    $firstTimer = new FirstTimers();
    
    if(isset($_GET['del']))
    {
        $phone = $_GET['del'];
        $firstTimer->deleteFirstTimer($phone, $_SESSION['orgId']);
    }

    if(isset($_GET['retain']))
    {
        $phone = $_GET['retain'];
        $firstTimer->retainFirstTimer($phone, $_SESSION['orgId']);
    }
?>

<div class="p-3">
<a href="add_first_timer.php" class="btn btn-primary p-2 font-weight-bold"> <i class="fa fa-plus fa-1x bg-primary p-2 text-white"></i> Add First Timer</a>
</div>


<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Retained First Timers</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Date Hosted</th>
                        <th>FullName</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>#</th>
                        <th>Event Name</th>
                        <th>Date Hosted</th>
                        <th>FullName</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                </tfoot>
                <tbody class="text-dark">
                    <?php
                        $count = 0;
                        $results = $firstTimer->getAllFirstTimers($_SESSION['orgId']);
                        while($result = $results->getResults())
                        {
                            $date = toLongDateString($result['eventdate']);
                            $fullname = $result['firstname'].' '.$result['othername'].' '.$result['lastname'];
                            if(!$result['isRetained']){
                                continue; //skip if the individual has NOT been converted.
                            }
                            echo
                            '
                                <tr class="text-dark">
                                    <td>'.++$count.'</td>
                                    <td>'.$result['eventname'].'</td>
                                    <td>'.$date.'</td>
                                    <td class="text-uppercase">'.$fullname.'</td>
                                    <td>'.$result['phone'].'</td>
                                    <td>'.$result['addresss'].'</td>
                                    <td>                                        
                                        <a href="allfirsttimers.php?del='.$result['phone'].'"><i class="fa fa-trash fa-1x text-danger disabled  "></i></a>
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