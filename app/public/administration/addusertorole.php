<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
   // include '../../web/controllers/administrationcontroller.php';
?>

<div class="pt-0 pl-5 pr-5">
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-5">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
        <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
            <h1 class="h4 text-gray-900 mb-2">Add User To Role</h1>
            <p class="mb-4">create roles and add users to the role</p>
            </div>

            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="form-group">
                <label class="control-label">Roles List</label>
                <select name="roleName" id="role" class="form-control">
                    <?php
                        $results = $role->listRoles($_SESSION['orgId']);
                        while($value = $results->getResults())
                        {
                            if(!$userRoleSuperAdmin && $value['roleName'] == "superAdmin")
                            {
                                continue;
                                //hide the role: SUPER-ADMIN from a user that doesn't belong to the role
                            }
                            echo '<option value="'.$value['roleName'].'" class="">'.$value['roleName'].'</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label class="control-label">Users List</label><br>
                <?php
                    // $x = $userInRole->isRoleAssignedx($_SESSION['orgId']);
                    // while ($d = $x->getResults()) {
                    //    //var_dump($x);
                    //    echo $d['username'].' | '.$d['userId'].'<br>';

                    // }
                ?>

                <select name="users" class="form-control" id="users">
                    <?php
                        $d = $userInRole->isRoleAssignedx($_SESSION['orgId']);                   
                        if($d != null)
                        {
                            while ($users = $d->getResults())
                            {
                                if(!$users['isActive'] || $users['roleName'] != null)
                                {
                                    continue;
                                }
                                echo '<option value="'.$users['username'].'">'.$users['username'].'</option>';
                            }
                        }else{echo 'no user';}
                    ?>
                </select>               
            </div>

            <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                  
            <input type="submit" class="btn btn-primary btn-user btn-block" name="addUserToRole" value="Add">
            </form>
            <hr>            
        </div>
        </div>
    </div>
    </div>
</div>
</div>

<?php
    require ('../shared/_footer.php');
?>