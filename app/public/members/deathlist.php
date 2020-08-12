<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    if(isset($_GET['find']))
    {
        $userId = $_GET['edit'];
        //$members->suspendUser($userId, $_SESSION['orgId']);
    }


    if(isset($_GET['delete']))
    {
        $memberId = $_GET['delete'];
        $members->deleteMember($memberId, $_SESSION['orgId']);
    }

    if(isset($_GET['edit']))
    {
        $userId = $_GET['delete'];
        $user->deleteUser($userId, $_SESSION['orgId']);
    }

    if(isset($_GET['dead']))
    {
        $memberId = $_GET['dead'];
        //we fetch her details
        $details = $members->getMember($memberId, $_SESSION['orgId']);
        if($members->restInPeace($memberId, $_SESSION['orgId']))
        {
            echo '<script> alert("May the Soul of '.strtoupper($details['firstName']).' '.strtoupper($details['lastName']).' rest in perfect peace.\n Amen!") </script>';
        }
    }
?>        

<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table For Death List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Stewardship</th>
                        <th>Fullname</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Telephone</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Stewardship</th>
                        <th>Fullname</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Telephone</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $count = 0;
                        $membersList = $members->getAllMembers($_SESSION['orgId']);
                        while($result = $membersList->getResults())
                        {
                            if(!$result['isAlive'])
                            {
                                /***********************************************
                                create a time stamp for the birth date
                                *************************************************/
                                $timestamp = strtotime($result['dateOfBirth']);
                                $day = date("d", $timestamp);
                                $Day = date("D", $timestamp);
                                $month = date("M", $timestamp);
                                $year = date("Y", $timestamp);
                                $birthday = $Day." ".$day.", ".$month." ".$year;
                                /**************************************************/
                                echo
                                '
                                <tr class="text-danger">
                                    <td>'.++$count.'</td>
                                    <td>'.$result['stewardship'].'</td>
                                    <td class="text-capitalize"><a class="text-danger" href=view.php?find='.$result['Id'].'>'.$result['lastName'].' '.$result['otherName'].' '.$result['firstName'].'</a></td>
                                    <td>'.$birthday.'</td>
                                    <td>'.$result['gender'].'</td>
                                    <td>'.$result['phone1'].'</td>
                                    <td>                                            
                                        <a href="allmembers.php?edit='.$result['Id'].'" class=""><i class="fa fa-edit fa-fw"></i></a> |
                                        <a href="allmembers.php?delete='.$result['Id'].'" class="btn-danger"><i class="fa fa-recycle fa-fw"></i></a> |
                                        <a href="allmembers.php?dead='.$result['Id'].'" class="btn-danger"><i class="fa fa-archive fa-fw"></i></a>
                                    </td>
                                </tr>
                                ';
                            }                            
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