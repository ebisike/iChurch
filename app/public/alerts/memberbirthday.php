<?php
    
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    #get notigications
    
    $daily = null;
    $weekly = null;
    if(isset($_GET['memberBirthday']))
    {
        $daily = $notify->getMemberDailyBirthday($_SESSION['orgId']);
        $weekly = $notify->getMemberWeeklyBirthday($_SESSION['orgId']);
    }
?>
<!-- <table class="table table-borderless table-striped table-hover">
    <tbody>
        <tr>
            <td>count</td>
            <td>first name</td>
            <td>last name</td>
            <td>date of birth</td>
        </tr>
    </tbody>
</table> -->
<div class="m-4 text-black">
    <div class="card-o mb-5 p-4 shadow-lg">
        <?php
            echo '<h4 class="text-center text-capitalize pt-0 border-bottom text-dark">Today\'s celebrants</h4>';
            if($daily != null)
            {
                $count = 0;
                $daily = $notify->getMemberDailyBirthday($_SESSION['orgId']);
                
                // foreach($childdata1 as ['firstName' => $fn, 'otherName' => $on, 'dateofbirth' => $dob, 'memberid' => $id])
                // {
                //     $dd = $members->getMember($id, $_SESSION['orgId']);
                //     echo
                //     '
                //         <table class="table table-borderless table-striped table-hover">
                //             <tbody>
                //                 <tr>
                //                     <td>'.++$count.'</td>
                //                     <td>'.$dd['lastName'].' '.$fn.' '.$on.'</td>                                    
                //                     <td>'.toLongDateString($dob).'</td>
                //                     <td>'.calculateAge($dob).' years</td>
                //                 </tr>
                //             </tbody>
                //         </table>
                //     ';
                // }
                while($data = $daily->getResults())
                {
                    echo
                    '
                        <table class="table table-borderless table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td><a href="../members/view.php?find='.$data['Id'].'">'.$data['lastName'].' '.$data['firstName'].' '.$data['otherName'].'</a></td>                                    
                                    <td>'.toLongDateString($data['dateOfBirth']).'</td>
                                    <td>'.calculateAge($data['dateOfBirth']).' years</td>
                                </tr>
                            </tbody>
                        </table>
                    ';
                }
            }
            else
            {
                echo '<h4 class="text-center text-lowercase pt-3">nobody is celebrating today</h4>';
            }
        ?>
    </div>
    <div class="card-o p-4 shadow-lg">
            <?php

                echo '<h4 class="text-center text-capitalize pt-0 border-bottom text-dark">This Week\'s Celebrants</h4>';
                if($weekly != null)
                {
                    $count = 0;                    
                    $weekly = $notify->getMemberWeeklyBirthday($_SESSION['orgId']);
                    while($data = $weekly->getResults())
                    {
                        echo
                        '
                            <table class="table table-borderless table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td>'.++$count.'</td>
                                        <td><a href="../members/view.php?find='.$data['Id'].'">'.$data['lastName'].' '.$data['firstName'].' '.$data['otherName'].'</a></td>                                    
                                        <td>'.toLongDateString($data['dateOfBirth']).'</td>
                                        <td>'.calculateAge($data['dateOfBirth']).' years</td>
                                    </tr>
                                </tbody>
                            </table>
                        ';
                    }                    
                }
                else
                {
                    echo '<h4 class="text-center text-lowercase pt-3">nobody is celebrating this week</h4>';                
                }
            ?>
    </div>
</div>

<?php require ('../shared/_footer.php')?>