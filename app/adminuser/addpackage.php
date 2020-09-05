<?php
    require 'worker.php';
    $validate = new InputValidation();
    $package = new PaymentPackages();

    if(isset($_POST['submit']))
    {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $validate->validateForm($value); //striping the user input   
        }
        if($package->addPackage($_POST))
        {
            header('location: viewpackages.php');
        }
    }
?>

<?php include 'header.php'?>
<div class="row m-5">
    <div class="col-md-6">
        <form action="addpackage.php" method="POST" class="user">
            <div class="form-group">
                <input type="text" name="packagename" placeholder="Enter Package Name" class="form-control form-control-user">
            </div>
            <div class="form-group">
                <select name="packageduration" class="form-control">
                    <option>Choose package duration</option>
                    <option value="1">Monthly</option>
                    <option value="4">Quaterly</option>
                    <option value="6">Semi Annually</option>
                    <option value="12">Annually</option>
                </select>
            </div>
            <div class="form-group">
                <input type="number" name="packagecost" min="0" placeholder="Enter Package Cost" class="form-control form-control-user">
            </div>
            <input type="submit" value="Add" name="submit" class="btn btn-primary">
        </form>
    </div>
</div>