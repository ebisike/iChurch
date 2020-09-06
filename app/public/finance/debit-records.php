<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    $org = new Organisations();   
?>

<div class="p-3">
    <a href="postdebit.php" class="btn btn-dark">post debit transaction</a>
</div>


<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All financial (Debit) records of: <?php echo $org->getOrgName($_SESSION['orgId'])?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Source</th>
                        <th>Description</th>
                        <th>Value Date</th>
                        <th>Posted by</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Source</th>
                        <th>Description</th>
                        <th>Value Date</th>
                        <th>Posted by</th>
                    </tr>
                </tfoot>
                <tbody class="text-dark">
                    <?php
                        $count = 0;
                        $list = $transaction->getDebitTransactions($_SESSION['orgId']);
                        while($result = $list->getResults())
                        {
                            //the if condition does nothing really.
                            #just left cos of laziness.
                            if(1)
                            {                                
                                $date = toLongDateString($result['transactiondate']);
                                /**************************************************/
                                echo
                                '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td>-&#8358;'.$result['amount'].'</td>
                                    <td>'.$result['source'].'</td>
                                    <td>'.$result['transactiondescription'].'</td>
                                    <td>'.$date.'</td>
                                    <td>'.$result['username'].'</td>
                                </tr>
                                ';
                            }                            
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