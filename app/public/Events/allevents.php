<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    $event = new Events();
    if(isset($_GET['del']))
    {
        $Id = $_GET['del'];
        $event->deleteEvent($Id, $_SESSION['orgId']);
    }
?>

<div class="p-3">
<a href="create_event.php" class="btn btn-primary p-2 font-weight-bold"> <i class="fa fa-plus fa-1x bg-primary p-2 text-white"></i> Add Event</a>
</div>


<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Event records</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Date Hosted</th>
                        <th>Number of Guest</th>                  
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Date Hosted</th>
                        <th>Number of Guest</th>
                    </tr>
                </tfoot>
                <tbody class="text-dark">
                    <?php
                        $count = 0;
                        $results = $event->getAllEvents($_SESSION['orgId']);
                        while($result = $results->getResults())
                        {
                            $date = toLongDateString($result['eventdate']);
                            echo
                            '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td>'.$result['eventname'].'</td>
                                    <td>'.$date.'</td>
                                    <td>'.$result['numberofguests'].'</td>
                                    <td><a href="allevents.php?del='.$result['Id'].'"><i class="fa fa-trash fa-1x text-danger"></i></a></td>
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