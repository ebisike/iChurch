<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    include '../../web/controllers/usermanagement.php';

    if(isset($_GET['edit']))
    {
        $userId = $_GET['edit'];
        $result = $user->getUser($userId, $_SESSION['orgId']);
    }
?>

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
        <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
            <h1 class="h4 text-gray-900 mb-2">Edit a  User</h1>
            <p class="mb-4">update users for your organisation</p>
            </div>
            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="<?php echo $result['firstName']?>" name="firstName" value="<?php echo $result['firstName']?>">
                <input type="hidden" name="id" value="<?php echo $result['Id']?>">
                <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="<?php echo $result['lastName']?>" name="lastName" value="<?php echo $result['lastName']?>">                
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="<?php echo $result['username']?>" name="username" value="<?php echo $result['username']?>">                
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user disabled" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="<?php echo $result['passwords']?>" name="passwords" value="<?php echo $result['passwords']?>">
            </div>
            <hr>
            <input type="submit" class="btn btn-primary btn-user btn-block" name="update" value="update user">
            </form>
        </div>
        </div>
    </div>
    </div>
</div>
<script>
    var username = document.getElementById('username').value();
    document.getElementById('username').addEventListener('keyup', display);

    function display(){
        if(username == 'admin'){
        alert('username: admin is a reserved word');
    }
    alert('username: admin is a reserved word');
    }
</script>
<?php
    require ('../shared/_footer.php');
?>