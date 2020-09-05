<?php
  include 'Services/init.php';
  include 'Web/Controllers/createorg.php';
?>
<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="bootstrap/assets/images/spaco-icon3-128x109.png" type="image/x-icon">
  <meta name="description" content="Web Page Builder Description">
  
  <title>iChurch | signup</title>
  <link rel="stylesheet" href="bootstrap/assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="bootstrap/assets/tether/tether.min.css">
  <link rel="stylesheet" href="bootstrap/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="bootstrap/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="bootstrap/assets/theme/css/style.css">
  <link rel="stylesheet" href="bootstrap/assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
  <section class="header15 cid-rsgMTKW3pB mbr-fullscreen mbr-parallax-background" id="header15-4">

    

    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(127, 25, 51);"></div>

    <div class="container align-right">
        <div class="row">
            
            <div class="col-lg-4 col-md-5">
                <div class="form-container">
                    <div class="media-container-column" data-form-type="formoid">
                        <!---Formbuilder Form--->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form">
                          <?php
                            if(isset($_POST['register'])){
                              echo '
                              <div class="row">
                                  <div data-form-alert="" class="alert alert-success col-12">' .$msg. '</div>
                              </div>
                              ';
                            }
                          ?>
                            <div class="dragArea row">
                                <div class="col-md-12 form-group " data-for="name">
                                    <input type="text" name="orgName" placeholder="Organisation Name" data-form-field="Name" required="required" class="form-control px-3 display-7" id="name-header15-4">
                                </div>
                                <div class="col-md-12 form-group " data-for="email">
                                    <input type="email" name="orgEmail" placeholder="Organisation Email" data-form-field="Email" required="required" class="form-control px-3 display-7" id="email-header15-4">
                                </div>
                                <div class="col-md-12 form-group " data-for="name">
                                    <input type="text" name="firstName" placeholder="First Name" data-form-field="Name" required="required" class="form-control px-3 display-7" id="name-header15-4">
                                </div>
                                <div class="col-md-12 form-group " data-for="name">
                                    <input type="text" name="lastName" placeholder="Last Name" data-form-field="Name" required="required" class="form-control px-3 display-7" id="name-header15-4">
                                </div>
                                <div class="col-md-12 form-group " data-for="name">
                                    <input type="text" name="username" placeholder="User Name" data-form-field="Name" required="required" class="form-control px-3 display-7" id="name-header15-4">
                                </div>
                                <div class="col-md-12 form-group " data-for="password">
                                    <input type="password" name="passwords" placeholder="password" data-form-field="Name" required="required" class="form-control px-3 display-7" id="name-header15-4">
                                </div>
                                <div class="col-md-12 form-group " data-for="confirm_password">
                                    <input type="password" name="cpwd" placeholder="Retype password" data-form-field="Name" required="required" class="form-control px-3 display-7" id="name-header15-4">
                                </div>
                                <div class="col-md-12 input-group-btn">
                                    <input type="submit" name="register" value="SUBMIT" class="btn btn-secondary btn-form display-4" style="border-radius: 50px">
                                </div>
                                <div class="col-md-12">
                                  <p>Already have an account <a href="signin.php" style="color: white">click here</a> to sign in</p>
                                </div>
                            </div>
                        </form><!---Formbuilder Form--->
                    </div>
                </div>
            </div>
            <div class="mbr-white col-lg-8 col-md-7 content-container">
                <a href="index.php" style="color: white"><h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-2">iChurch</h1></a>
                <p class="mbr-text pb-3 mbr-fonts-style display-5">
                    made for easy and smooth running of church task(s)
                </p>
            </div>
        </div>
    </div>
    
</section>


  <section class="engine"><a href="https://mobirise.info/b">how to create your own website</a></section><script src="bootstrap/assets/web/assets/jquery/jquery.min.js"></script>
  <script src="bootstrap/assets/popper/popper.min.js"></script>
  <script src="bootstrap/assets/tether/tether.min.js"></script>
  <script src="bootstrap/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/assets/smoothscroll/smooth-scroll.js"></script>
  <script src="bootstrap/assets/parallax/jarallax.min.js"></script>
  <script src="bootstrap/assets/theme/js/script.js"></script>
  <!-- <script src="assets/formoid/formoid.min.js"></script> -->
  
  
</body>
</html>