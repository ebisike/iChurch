<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    include ('../../web/controllers/formshandler.php');


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
            <h6 class="m-0 font-weight-bold text-primary">Data Table For All Members</h6>
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
                            if($result['isAlive'])
                            {
                                $birthday = toLongDateString($result['dateOfBirth']);
                                /**************************************************/
                                echo
                                '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td>'.$result['stewardship'].'</td>
                                    <td class="text-capitalize"><a href=view.php?find='.$result['Id'].'>'.$result['lastName'].' '.$result['otherName'].' '.$result['firstName'].'</a></td>
                                    <td>'.$birthday.'</td>
                                    <td>'.$result['gender'].'</td>
                                    <td>'.$result['phone1'].'</td>
                                    <td>                                            
                                        <a href="editmember.php?edit='.$result['Id'].'" class=""><i class="fa fa-pen text-primary"> </i></a> |
                                        <a href="allmembers.php?delete='.$result['Id'].'" class=""><i class="fa fa-trash text-danger"></i></a> |
                                        <a href="allmembers.php?dead='.$result['Id'].'" class=""><i class="fa fa-medkit text-danger"></i></a>
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