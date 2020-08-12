<?php
    
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    #get notigications
    
    $daily = null;
    $weekly = null;
    if(isset($_GET['childrenBirthday']))
    {
        $daily = $notify->getChildrenDailyBirthday($_SESSION['orgId']);
        // while($r = $daily->getResults())
        // {
        //     //echo $r['dateOfBirth'].'<br>';
        //     $childdata1 =
        //     [
        //         [
        //             'firstName' => $r['firstName'],
        //             'otherName' => $r['otherName'],
        //             'dateofbirth' => $r['dateOfBirth'],
        //             'memberid' => $r['memberId']
        //         ]
        //     ];
        // }
        $weekly = $notify->getChildrenWeeklyBirthday($_SESSION['orgId']);
    }

    if(isset($_GET['memberBirthday']))
    {
        $daily = $notify->getMemberDailyBirthday($_SESSION['orgId']);
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
                $daily = $notify->getChildrenDailyBirthday($_SESSION['orgId']);
                
                echo
                '
                    <table class="table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full name</th>
                                <th>Date of Birth</th>
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
                                <td><a href="../members/view.php?find='.$data['memberId'].'">'.$data['firstName'].' '.$data['otherName'].'</a></td>                                    
                                <td>'.toLongDateString($data['dateOfBirth']).'</td>
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
    <div class="card-o p-4 shadow-lg">
            <?php

                echo '<h4 class="text-center text-capitalize pt-0 border-bottom text-dark">This Week\'s Celebrants</h4>';
                if($weekly != null)
                {
                    $count = 0;                    
                    $weekly = $notify->getChildrenWeeklyBirthday($_SESSION['orgId']);
                    echo
                    '
                        <table class="table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full name</th>
                                    <th>Date of Birth</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                        while($data = $weekly->getResults())
                        {
                            echo
                            '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td><a href="../members/view.php?find='.$data['memberId'].'">'.$data['firstName'].' '.$data['otherName'].'</a></td>                                    
                                    <td>'.toLongDateString($data['dateOfBirth']).'</td>
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
                    echo '<h4 class="text-center text-lowercase pt-3">nobody is celebrating this week</h4>';                
                }
            ?>
    </div>
</div>

<?php require ('../shared/_footer.php')?>