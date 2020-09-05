<?php
    require 'worker.php';
    include 'functions.php';
    $package = new PaymentPackages();
?>

<?php include 'header.php'?>
<section class="p-5 ml-5 mt-0" style="margin: auto auto;">
<a href="addpackage.php" class="btn btn-primary p-2 m-3">Add New Package</a>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Package Name</th>
                        <th>Duration</th>
                        <th>Cost</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>                        
                    <?php
                        $packageList = $package->readPackages();
                        $count = 0;
                        foreach($packageList as $item)
                        {
                            $duration = setPackageDurationDisplayName($item['duration']);
                            echo
                            '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td>'.$item['packagename'].'</td>
                                    <td>'.$duration.'</td>
                                    <td>₦'.$item['cost'].'</td>
                                    <td><a href="editpackage.php?edit='.$item['Id'].'"><i class="fas fa-pen"></i></a></td>
                            ';                            
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include 'footer.php'?>
