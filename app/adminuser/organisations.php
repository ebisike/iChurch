<?php
  require 'worker.php';

if(isset($_GET['activate']))
{
    $orgId = $_GET['activate'];
    $adminUser->activateOrganisation($orgId);
}

if(isset($_GET['deactivate']))
{
    $orgId = $_GET['deactivate'];
    $adminUser->deactivateOrganisation($orgId);
}

if(isset($_GET['logout']))
{
    unset($_SESSION['adminuser']);
    header('location: login.php');
}

?>

<?php include 'header.php' ?>
<section class="p-5 ml-5 mt-0" style="margin: auto auto;">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Organisation Name</th>
                        <th>Organisation Email</th>
                        <th>Activation Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>                        
                    <?php
                        $organisationList = $adminUser->getAllOrganisations();
                        $count = 0;
                        while($result = $organisationList->getResults())
                        {
                            echo
                            '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td>'.$result['OrgName'].'</td>
                                    <td>'.$result['OrgEmail'].'</td>
                                    <td>'.$result['isActive'].'</td>
                            ';
                            if(!$result['isActive'])
                            {
                                echo
                                '
                                        <td><a class="btn btn-success btn-sm" href="organisations.php?activate='.$result['Id'].'">Activate</a></td>
                                    </tr>
                                ';
                            }
                            else
                            {
                                echo
                                '
                                        <td><a class="btn btn-danger btn-sm" href="organisations.php?deactivate='.$result['Id'].'">Deactivate</a></td>
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

<?php
    require 'footer.php';
?>