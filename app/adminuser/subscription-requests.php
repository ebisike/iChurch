<?php
    //require ('../Services/init.php');
    require 'worker.php';
    include_once ('functions.php');

    $adminUser = new AdminUser();
    $subscriptions = new Subscriptions();
    $packages = new PaymentPackages();

    if(isset($_GET['activate']) && isset($_GET['orgId']) && isset($_GET['pkg']))
    {
        $Id = $_GET['activate'];
        $orgId = $_GET['orgId'];
        $pkgDuration = $_GET['pkg'];
        if($subscriptions->activateSubscription($Id, $orgId))
        {
            //do more stuff.
            $adminUser->renewSubscription($orgId, $pkgDuration);
        }
    }
    
?>
    <?php include 'header.php'?>
    <section class="p-5 ml-5 mt-0" style="margin: auto auto;">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Organisation Name</th>
                            <th>Organisation Email</th>
                            <th>Package Name</th>
                            <th>Package Duration</th>
                            <th>Date requested</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <?php
                            $subscriptionList = $subscriptions->readAllPendingRequests();
                            $count = 0;
                            $today = date('Y-m-d');
                            foreach($subscriptionList as $item)
                            {
                                #get the organisation details
                                $org = $adminUser->getOrganisation($item['orgId']);
                                #get the package details
                                $package = $packages->getPackage($item['paymentpackageId']);
                                echo
                                '
                                    <tr>
                                        <td>'.++$count.'</td>
                                        <td>'.$org['OrgName'].'</td>
                                        <td>'.$org['OrgEmail'].'</td>
                                        <td>'.$package['packagename'].'</td>
                                        <td>'.setPackageDurationDisplayName($package['duration']).'</td>
                                        <td>'.toLongDateStringx($item['daterequested']).'</td>
                                        <td><a href="subscription-requests.php?activate='.$item['Id'].'&orgId='.$org['Id'].'&pkg='.$package['duration'].'"><i class="fas fa-check-circle fa-1x text-success"></i></a></td>
                                ';                               
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php include 'footer.php' ?>