<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    //include '../../web/controllers/usermanagement.php';

    if(isset($_GET['suspend']))
    {
        $userId = $_GET['suspend'];
        $user->suspendUser($userId, $_SESSION['orgId']);
    }


    if(isset($_GET['delete']))
    {
        $userId = $_GET['delete'];
        $user->deleteUser($userId, $_SESSION['orgId']);
    }
?>        

<!-- DataTales Example -->
<!-- <div class="pt-0 pl-3 pr-3">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Actions</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Actions</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $count = 0;
                        $usersList = $user->getAllUsers($_SESSION['orgId']);
                        while($result = $usersList->getResults())
                        {
                            
                            echo
                                '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td class="text-capitalize">'.$result['firstName'].' '.$result['lastName'].'</td>
                                    <td>'.$result['username'].'</td>
                                ';
                                    if($result['isActive'])
                                    {
                                        echo
                                        '<td>
                                            <a href="listusers.php?suspend='.$result['Id'].'" class="btn btn-sm btn-danger">suspend</a> |
                                            <a href="edit.php?edit='.$result['Id'].'" class="btn btn-sm btn-warning">edit</a> |
                                            <a href="listusers.php?delete='.$result['Id'].'" class="btn btn-sm btn-danger">delete</a>
                                        </td>';
                                    }
                                    else
                                    {
                                        echo
                                        '<td>
                                            <a href="listusers.php?suspend='.$result['Id'].'" class="btn btn-sm btn-success">unsuspend</a> |
                                            <a href="edit.php?edit='.$result['Id'].'" class="btn btn-sm btn-warning">edit</a> |
                                            <a href="listusers.php?delete='.$result['Id'].'" class="btn btn-sm btn-danger">delete</a>
                                        </td>';
                                    }echo '                                                 
                                </tr>
                                ';
                        }
                    ?>                                
                </tbody>
            </table>
            </div>
        </div>
        </div>
</div> -->
<div class="mt-0 mr-4 ml-4">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-5">
        <div class="card m-2 shadow-lg">
            <div class="card-header">ALL USERS</div>
                <div class="card-body">
                <?php
                        $count = 0;
                        $usersList = $user->getAllUsers($_SESSION['orgId']);
                        while($result = $usersList->getResults())
                        {
                            
                            echo
                                '
                                <div class="row p-2 mb-4 border-bottom">
                                    <div class="col-md-2">
                                        <img class="img img-responsive img-circle img-thumbnail" src="images/'.$result['imagepath'].'"/>
                                    </div>
                                    <div class="col-md-10">
                                        <h5 class="text-capitalize"> Full Name: '.$result['firstName'].' '.$result['lastName'].'</h5>
                                        <h6>Username: '.$result['username'].'</h6>
                                                                                                            
                                ';
                                    if($result['isActive'])
                                    {
                                        echo
                                        '<p>
                                            <a href="listusers.php?suspend='.$result['Id'].'" class="btn btn-sm btn-danger">suspend</a> |
                                            <a href="edit.php?edit='.$result['Id'].'" class="btn btn-sm btn-warning">edit</a> |
                                            <a href="listusers.php?delete='.$result['Id'].'" class="btn btn-sm btn-danger">delete</a>
                                        </p>';
                                    }
                                    else
                                    {
                                        echo
                                        '<p>
                                            <a href="listusers.php?suspend='.$result['Id'].'" class="btn btn-sm btn-success">unsuspend</a> |
                                            <a href="edit.php?edit='.$result['Id'].'" class="btn btn-sm btn-warning">edit</a> |
                                            <a href="listusers.php?delete='.$result['Id'].'" class="btn btn-sm btn-danger">delete</a>
                                        </p>';
                                    }echo '
                                    </div>                                                
                                </div>
                                ';
                        }
                    ?>    
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require ('../shared/_footer.php');
?>