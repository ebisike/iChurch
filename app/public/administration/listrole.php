<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    //include '../../web/controllers/administrationcontroller.php';
?>

<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listing All Roles</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>RoleName</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>RoleName</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php
                        $count = 0;
                        $roleList = $role->listRoles($_SESSION['orgId']);
                        while($result = $roleList->getResults())
                        {
                            if(strtolower($result['roleName']) == strtolower("superAdmin") && !$userRoleSuperAdmin)
                            {
                                #if the role name is = superadmin, and the currently logged in user is not in role: superAdmin... skip
                                continue;
                            }
                            echo
                            '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td class="text-capitalize">'.$result['roleName'].'</td>
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