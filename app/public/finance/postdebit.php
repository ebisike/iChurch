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
            <h1 class="h4 text-gray-900 mb-2">Debit Transaction</h1>
            <p class="mb-4">post a debit transaction</p>
            </div>
            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="form-group">                
                <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                <input type="hidden" name="transactiontype" value=0>
                <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
            </div>
            <div class="form-group">
                <input list="source" class="form-control form-control-user" placeholder="Enter Debit Source" name="source" required>
                    <datalist id="source">
                        <option value="Utility Bills">
                        <option value="Staff Salary">
                        <option value="Transportation">
                        <option value="Entertainment">
                        <option value="Diseal">
                        <option value="Fuel">
                    </datalist>                
            </div>
            <div class="form-group">
                <textarea name="descriptions" id="" cols="15" rows="5" class="form-control" placeholder="Enter Description">                    
                </textarea>                
            </div>
            <div class="form-group">
                <input type="number" name="amount" class="form-control form-control-user" placeholder="Enter Amount">                
            </div>
            <div class="form-group">
                <input type="date" name="transactiondate" class="form-control form-control-user datefield" id="">                
            </div>
            <input type="submit" class="btn btn-info btn-user btn-block" name="postdebit" value="Post">
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