<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    include '../../web/controllers/administrationcontroller.php';
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
            <h1 class="h4 text-gray-900 mb-2">Remove User From Role</h1>
            <p class="mb-4">remove a user from a role and revoke his rights</p>
            </div>

            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            
            <div class="form-group">
                <label class="control-label">Users List</label>
                <select name="users" class="form-control" id="users">
                    <?php
                        $results = $userInRole->allUsersInRole($_SESSION['orgId']);
                        while ($users = $results->getResults())
                        {
                            //$ux = $user->getUser($users['userId'], $_SESSION['orgId']);
                            if($users['roleName'] == "super-admin" && !$userRoleSuperAdmin)
                            {
                                continue;
                            }
                            echo '<option value="'.$users['Id'].'">'.$users['firstName'].' '.$users['lastName'].'</option>';
                            //var_dump($users);
                        }                     
                    ?>
                </select>                
            </div>

            <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                  
            <input type="submit" class="btn btn-danger btn-user btn-block" name="removeUser" value="Remove User">
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