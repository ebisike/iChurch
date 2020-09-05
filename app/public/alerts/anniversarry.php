<?php
    
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    #get notigications
    
    $daily = null;
    $weekly = null;
    if( isset($_GET['anni']))
    {
        $daily = $notify->getMemberDailyWeddingAnniversary($_SESSION['orgId']);
        $weekly = $notify->getMemberWeeklyWeddingAnniversary($_SESSION['orgId']);
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
            echo '<h4 class="text-center text-capitalize pt-0 border-bottom text-dark">Today\'s Anniversary Celebrants</h4>';
            if($daily != null)
            {
                $count = 0;
                $daily = $notify->getMemberDailyWeddingAnniversary($_SESSION['orgId']);
                
                echo
                '
                    <table class="table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full name</th>
                                <th>Name of Spouse</th>
                                <th>Date of Anniversary</th>
                                <th>Number of years</th>
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
                            <td><a href="../members/view.php?find='.$data['Id'].'">'.$data['lastName'].' '.$data['firstName'].' '.$data['otherName'].'</a></td>
                            <td>'.$data['nameofspouse'].'</td>
                            <td>'.toLongDateString($data['dateofmarriage']).'</td>
                            <td>'.calculateAge($data['dateofmarriage']).' years</td>
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

                echo '<h4 class="text-center text-capitalize pt-0 border-bottom text-dark">This Week\'s Anniversary Celebrants</h4>';
                if($weekly != null)
                {
                    $count = 0;                    
                    $weekly = $notify->getMemberWeeklyWeddingAnniversary($_SESSION['orgId']);
                    echo
                    '
                        <table class="table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full name</th>
                                    <th>Name of Spouse</th>
                                    <th>Date of Anniversary</th>
                                    <th>Number of years</th>
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
                                <td><a href="../members/view.php?find='.$data['Id'].'">'.$data['lastName'].' '.$data['firstName'].' '.$data['otherName'].'</a></td>                                 
                                <td>'.$data['nameofspouse'].'</td>                                 
                                <td>'.toLongDateString($data['dateofmarriage']).'</td>
                                <td>'.calculateAge($data['dateofmarriage']).' years anni.</td>
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