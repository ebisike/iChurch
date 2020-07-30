<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    include '../../web/controllers/administrationcontroller.php';
?>

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
        <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
            <h1 class="h4 text-gray-900 mb-2">Create a New Role</h1>
            <p class="mb-4">create roles and add users to the role</p>
            </div>
            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Role Name..." name="roleName">
                <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
            </div>            
            <input type="submit" class="btn btn-primary btn-user btn-block" name="createrole" value="create">
            </form>
            <hr>
            <div class="text-center">
            <a class="small" href="register.html">Create an Account!</a>
            </div>
            <div class="text-center">
            <a class="small" href="login.html">Already have an account? Login!</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<?php
    require ('../shared/_footer.php');
?>