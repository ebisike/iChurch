<?php
    require ('../Services/init.php');
    $adminUser = new AdminUser();

    if(isset($_POST['login']))
    {
        $user = $adminUser->login($_POST);
        if($user)
        {
            //set session            
            $_SESSION['adminuser'] = $user['Id'];
            //var_dump($_SESSION['adminuser']); exit();
            header('location: organisations.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../bootstrap/assets/images/spaco-icon3-128x109.png" type="image/x-icon">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="../bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../bootstrap/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../bootstrap/css/mtabs.css" rel="stylesheet">

    <title>iChurch | admin-login</title>
</head>
<body>
    <section class="p-5 m-5" style="margin: auto auto;">
        <div class="row">
            <div class="col-md-6">
                <form action="login.php" method="POST" class="user">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Enter user name" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Enter password" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" value="login" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </section>

       <!-- Bootstrap core JavaScript-->
<script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../bootstrap/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../bootstrap/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../bootstrap/js/demo/chart-area-demo.js"></script>
<script src="../bootstrap/js/demo/chart-pie-demo.js"></script>

<!-- Page level plugins -->
<script src="../bootstrap/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../bootstrap/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
 <script src="../bootstrap/js/demo/datatables-demo.js"></script>
 <script src="../bootstrap/js/mtabs-js.js"></script>
 <script src="../bootstrap/js/custom/logout-url.js"></script>
 <!-- set max date for input fields -->
 <script src="../bootstrap/js/custom/max-date.js"></script>
</body>
</html>