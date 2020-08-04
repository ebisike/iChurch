<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    if(isset($_GET['id']))
    {
        $data = $child->getChild($_GET['id'], $_SESSION['orgId']);
    }
?>

<div class="pt-1 pl-3 pr-3">
    <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
        <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
            <h1 class="h4 text-gray-900 mb-2">Edit a Child</h1>
            <p class="mb-4">updates a child</p>
            </div>
            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Child's FirstName..." name="firstName" value="<?php echo $data['firstName']?>">
                <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">                
                <input type="hidden" name="id" value="<?php echo $data['Id']?>">
                <input type="hidden" name="callbackURL" id="callbackurl" value="">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Child's Other name Not Surname..." name="otherName" value="<?php echo $data['otherName']?>">                
            </div>
            <div class="form-group">
                <input type="date" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Child's Fullname..." name="dob" value="<?php echo $data['dateOfBirth']?>">                
            </div>            
            <input type="submit" class="btn btn-primary btn-user btn-block" name="updateChild" value="Update Child">
            </form>
            <hr>            
        </div>
        </div>
    </div>
    </div>
</div>
</div>
<script src="../../bootstrap/js/custom/details-url.js"></script>

<?php
    require ('../shared/_footer.php');
?>