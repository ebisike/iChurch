<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
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
            <h1 class="h4 text-gray-900 mb-2">Add a Child</h1>
            <p class="mb-4">adds a child to a member</p>
            </div>
            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Child's FirstName..." name="firstName">
                <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                <input type="hidden" name="memberId" value="<?php echo $_SESSION['lastId']?>">
                <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Child's Other name Not Surname..." name="otherName">                
            </div>
            <div class="form-group">
                <input type="date" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Child's Fullname..." name="dob">                
            </div>
            <div class="form-group">
                <input type="checkbox" name="new_child" value=1>
                <p style="margin-top: -23px; margin-left: 18px">check this box to stay on this page to add more children</p>
            </div>
            <input type="submit" class="btn btn-primary btn-user btn-block" name="addChild" value="Add Child">
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