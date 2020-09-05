<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    include '../../adminuser/functions.php';

    $subscriptions = new Subscriptions();
    $package = new PaymentPackages();
?>

<div class="p-3">
<a href="category.php" id="pickcategory" class="btn btn-primary p-1 font-weight-bold"> <i class="fa fa-plus fa-1x bg-primary p-1 text-white"></i> New Subscription Request</a>
</div>


<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subscription History</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Package Name</th>
                        <th>Duration</th>
                        <th>Cost</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Package Name</th>
                        <th>Duration</th>
                        <th>Cost</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody class="text-dark">
                    <?php
                        $list = $subscriptions->getSubscriptions($_SESSION['orgId']);
                        $i=0;
                        foreach ($list as $key => $value)
                        {
                            $i+=1;
                            #set display name for status
                            $status = $value['isTreated'] ? "currently running" : "awaiting approval";
                            $color = $value['isTreated'] ? "text-success p-2 bg-light" : "text-danger p-2 bg-dark";
                            #fetch the package details by Id
                            $packageInfo = $package->getPackage($value['paymentpackageId']);
                            echo
                            '
                                <tr class="'.$color.'">
                                    <td>'.$i.'</td>
                                    <td>'.strtoupper($packageInfo['packagename']).'</td>
                                    <td>'.setPackageDurationDisplayName($packageInfo['duration']).'</td>
                                    <td>&#8358;'.$packageInfo['cost'].'</td>
                                    <td>'.toLongDateString($value['daterequested']).'</td>
                                    <td>'.$status.'</td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
        </div>
</div>
<?php
    require ('../shared/_footer.php');
?>

<script>
    $(document).ready(function(){
        document.getElementById('pickcategory').addEventListener('click', function(){
            //$('#subscriptionCategory').modal('show')
        })
    })
</script>