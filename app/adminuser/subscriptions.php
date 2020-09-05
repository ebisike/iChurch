<?php
    //require ('../Services/init.php');
    require 'worker.php';
    include_once ('functions.php');

    $adminUser = new AdminUser();

    if(isset($_GET['activate']))
    {
        $orgId = $_GET['activate'];
        //$adminUser->renewSubscription($orgId);
    }

    if(isset($_GET['logout']))
    {
        unset($_SESSION['adminuser']);
        header('location: login.php');
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
                            <th>Expiry Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <?php
                            $organisationList = $adminUser->getAllOrganisations();
                            $count = 0;
                            $today = date('Y-m-d');
                            while($result = $organisationList->getResults())
                            {
                                echo
                                '
                                    <tr>
                                        <td>'.++$count.'</td>
                                        <td>'.$result['OrgName'].'</td>
                                        <td>'.$result['OrgEmail'].'</td>
                                        <td>'.toLongDateStringx($result['expirydate']).'</td>
                                ';
                                if($result['expirydate'] <= $today)
                                {
                                    echo
                                    '
                                            <td><a class="btn btn-success btn-sm disabled" href="subscriptions.php?activate='.$result['Id'].'">Requires Activation</a></td>
                                        </tr>
                                    ';
                                }
                                else
                                {
                                    echo
                                    '
                                            <td><a class="btn btn-warning btn-sm disabled" href="organisations.php?deactivate='.$result['Id'].'">Currently Active</a></td>
                                        </tr>
                                    ';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php include 'footer.php' ?>