<?php
    
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    #get notigications
    
    $daily = null;
    $weekly = null;

    $quick = new QuickActions();
    if(isset($_GET['fam']))
    {
        $class = "p-3 ml-0 text-danger";
        // $quick->ChildrenWeeklyBirthday($_GET['sd'], $_GET['ed'], $_SESSION['orgId']);   
    }
?>
<?php echo "<h5 class=".$class.">All Family Members with Tree Branch ". $_GET['fam'] ."</h5>"?>
<div class="m-4 text-black">
    <div class="card-o mb-5 p-4 shadow-lg">
        <?php
            echo '<h4 class="text-center text-capitalize pt-0 border-bottom text-dark">Tree Branch of '.$_GET['fam'].'</h4>';
            if(1)
            {
                $count = 0;
                $daily = $quick->familyTree($_GET['fam'], $_SESSION['orgId']);
                
                echo
                '
                    <table class="table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Last Name</th>
                                <th>Other Names</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Marital Status</th>
                                <th>Age</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
                    while($data = $daily->getResults())
                    {
                        echo
                        '      
                            <tr>
                                <td>'.++$count.'</td>
                                <td>'.$data['lastName'].'</td>
                                <td><a href="../members/view.php?find='.$data['Id'].'">'.$data['firstName'].' '.$data['otherName'].'</a></td>                                    
                                <td>'.toLongDateString($data['dateOfBirth']).'</td>
                                <td>'.$data['gender'].'</td>
                                <td>'.$data['phone1'].'</td>
                                <td>'.$data['maritalstatus'].'</td>
                                <td>'.calculateAge($data['dateOfBirth']).' years</td>
                            </tr>
                        ';
                    }
                echo
                '
                        </tbody>
                    </table>
                ';
            }
            else
            {
                echo '<h4 class="text-center text-lowercase pt-3">nobody is celebrating today</h4>';
            }
        ?>
    </div>
</div>

<?php require ('../shared/_footer.php')?>