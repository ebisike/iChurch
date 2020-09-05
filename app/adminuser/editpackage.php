<?php
    require 'worker.php';
    include 'functions.php';

    $validate = new InputValidation();
    $package = new PaymentPackages();

    if(isset($_GET['edit']))
    {        
        $data = $package->getPackage($_GET['edit']);

        $duration = setPackageDurationDisplayName($data['duration']);
    }

    if(isset($_POST['update']))
    {
        //die("hit");
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $validate->validateForm($value); //striping the user input   
        }
        if($package->updatePackage($_POST))
        {
            header('location: viewpackages.php');
        }
    }
    
?>

<?php include 'header.php'?>
<div class="row m-5">
    <div class="col-md-6">
        <form action="editpackage.php" method="POST" class="user">
            <div class="form-group">
                <input type="text" name="packagename" placeholder="Enter Package Name" class="form-control form-control-user" value="<?php echo $data['packagename']?>">
            </div>
            <div class="form-group">
                <select name="packageduration" class="form-control">
                    <option value="<?php echo $duration?>"><?php echo $duration?></option>
                    <option value="1">Monthly</option>
                    <option value="4">Quaterly</option>
                    <option value="6">Semi Annually</option>
                    <option value="12">Annually</option>
                </select>
            </div>
            <div class="form-group">
                <input type="number" name="packagecost" min="0" placeholder="Enter Package Name" class="form-control form-control-user" value="<?php echo $data['cost']?>">
                <input type="hidden" name="Id" value="<?php echo $data['Id']?>">
            </div>
            <input type="submit" value="update" name="update" class="btn btn-primary">
        </form>
    </div>
</div>