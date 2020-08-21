<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    
    if(isset($_GET['sd']) && isset($_GET['ed']))
    {
        $org = new Organisations();
        $user = new Users();
        $statement = new AccountStatement();
        $bal = new Balance($_SESSION['orgId'], $_SESSION['userId']);
        $orgName = $org->getOrgName($_SESSION['orgId']);
        $result = $user->getUser($_SESSION['userId'], $_SESSION['orgId']);
        $fullname = strtoupper($result['firstName']). ' ' .strtoupper($result['lastName']);
        $username = $result['username'];
        
        $data = 
        [
            "startdate" => $_GET['sd'],
            "enddate" => $_GET['ed'],
            "orgId" => $_SESSION['orgId']
        ];        
        $openBal = $statement->getOpenningBalance($data);
        $closeBal = $statement->getCLosingBalance($data);
    }
?>


<div class="pt-0 pl-3 pr-3" id="mReport">
    <div class="card pt-2 pl-5 pr-5 pb-2 border-0 shadow-lg">
        <h2 class="text-dark font-weight-bold">YOUR ACCOUNT STATEMENT</h2>
        <h5>Account Details</h5>
        <p><b>Organisation Name: </b><span><?php echo $orgName?></span></p>
        <p><b>Fullname: </b><span><?php echo $fullname.' @'.$username?></span></p>
        <p><b>Start Date: </b><span><?php echo toLongDateString($data['startdate'])?></span></p>
        <p><b>End Date: </b><span><?php echo toLongDateString($data['enddate'])?></span></p>
        <p><b>Current Balance: </b><span class="text-success"><?php echo '&#8358;'.$bal->getBalance()?></span></p>
        <p><b>Openning Balance: </b><span><?php echo '&#8358;'.$openBal?></span></p>
        <p><b>Closing Balance: </b><span><?php echo '&#8358;'.$closeBal?></span></p>
    </div><br>

    <div class="card pt-2 pl-2 pr-2 pb-2 border-0 shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-dark table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="font-weight-bold">
                            <th>#</th>
                            <th>post date</th>
                            <th>value date</th>
                            <th>Narration</th>
                            <th>Source</th>
                            <th class="text-success">Credit</th>
                            <th class="text-danger">Debit</th>
                            <th class="text-info">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $report = $statement->getStatement($data);
                            $i = 0;
                            $balance = $openBal;                            
                            while($result = $report->getResults())
                            {
                                $result['transactiontype'] ? $balance += $result['amount'] : $balance -= $result['amount'];
                                //echo ++$i . ' = '.$balance . '('.$result['amount'].')<br>';
                                $pdate = toLongDateString($result['transactiondate']);
                                $vdate = toLongDateString($result['systemdate']);
                                $credit = $result['transactiontype'] ? $result['amount'] : " -- ";
                                $debit = $result['transactiontype'] ? " -- " : $result['amount'];

                                echo
                                '
                                    <tr>
                                        <td>'.++$i.'</td>
                                        <td>'.$pdate.'</td>
                                        <td>'.$vdate.'</td>
                                        <td>'.$result['transactiondescription'].'</td>
                                        <td>'.$result['source'].'</td>
                                        <td class="text-success text-center bg-light">'.$credit.'</td>
                                        <td class="text-danger text-center bg-warning">'.$debit.'</td>
                                        <td class="text-info bg-gradient-light">'.$balance.'</td>
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