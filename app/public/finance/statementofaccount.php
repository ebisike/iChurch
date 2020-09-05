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

<h2 class="text-dark font-weight-bold p-3">YOUR ACCOUNT STATEMENT</h2>

<div class="pt-0 pl-3 pr-3" id="mReport">
    <div class="card pt-2 pl-5 pr-5 pb-2 border-0 shadow-lg">
        <div class="row p-3">
            <div class="col-md-6">
                <h5 class="font-weight-bold text-warning">Account Details</h5>
                <p><b>Organisation Name: </b><span><?php echo $orgName?></span></p>
                <p><b>Fullname: </b><span><?php echo $fullname.' @'.$username?></span></p>
                <p><b>Start Date: </b><span><?php echo toLongDateString($data['startdate'])?></span></p>
            </div>
            <div class="col-md-6">
                <p><b>End Date: </b><span><?php echo toLongDateString($data['enddate'])?></span></p>
                <input type="hidden" name="" id="eDate" value="<?php echo $data['enddate']?>">
                <input type="hidden" name="" id="sDate" value="<?php echo $data['startdate']?>">
                <p><b>Current Balance: </b><span class="text-success"><?php echo '&#8358;'.$bal->getBalance()?></span></p>
                <p><b>Openning Balance: </b><span><?php echo '&#8358;'.$openBal?></span></p>
                <p><b>Closing Balance: </b><span><?php echo '&#8358;'.$closeBal?></span></p>
            </div>
        </div>
    </div><br>

    <div class="card border-0 pt-2 pl-5 pr-5 pb-2 shadow-lg">
        <h3 class="text-success font-weight-bold p-3">Income Summary</h3>
        <div class="table-responsive">
            <table class="table table-hover table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody id="income-sourcelist">
                    <?php
                        $summary = $statement->getIncomeSourceSummary($_SESSION['orgId']);
                        $totalCredits = 0;
                        for ($i=0; $i < count($summary); $i++)
                        {
                            if($summary[$i]['source']==""){
                                continue;
                            }
                            $totalCredits += $summary[$i]['amount'];
                            echo
                            '
                                    <tr class="income-row" id="'.$summary[$i]['source'].'">
                                        <td>'.$summary[$i]['source'].'</td>
                                        <td>&#8358;'.$summary[$i]['amount'].'</td>
                                    </tr>
                            ';
                        }                        
                    ?>
                    <tr>
                        <td></td>
                        <td><span class="font-weight-bold border-bottom-dark pb-2 pt-2"><?php echo '&#8358;'.$totalCredits?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> <br>

    <div class="card pt-2 pl-5 pr-5 pb-2 border-0 shadow-lg">
        <h3 class="text-danger font-weight-bold p-3">Expenditure Summary</h3>
        <div class="table-responsive">
            <table class="table table-hover table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody id="expenditure-sourcelist">
                    <?php
                        $summary = $statement->getExpenditureSourceSummary($_SESSION['orgId']);
                        $totalDebits = 0;
                        for ($i=0; $i < count($summary); $i++)
                        {
                            if($summary[$i]['source']==""){
                                continue;
                            }
                            $totalDebits += $summary[$i]['amount'];
                           echo
                           '
                                <tr class="expense-row" id="'.$summary[$i]['source'].'">
                                    <td>'.$summary[$i]['source'].'</td>
                                    <td>&#8358;'.$summary[$i]['amount'].'</td>
                                </tr>
                           ';
                        }
                    ?>
                    <tr>
                        <td></td>
                        <td><span class="font-weight-bold border-bottom-dark pb-2 pt-2"><?php echo '&#8358;'.$totalDebits?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> <br>

    <div class="card pt-2 pl-2 pr-2 pb-2 border-0 shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-dark table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="font-weight-bold">
                            <th>#</th>
                            <th>author</th>
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
                                $credit = $result['transactiontype'] ? '₦'.$result['amount'] : " -- ";
                                $debit = $result['transactiontype'] ? " -- " : '₦'.$result['amount'];

                                echo
                                '
                                    <tr>
                                        <td>'.++$i.'</td>
                                        <td>'.$result['username'].'</td>
                                        <td>'.$pdate.'</td>
                                        <td>'.$vdate.'</td>
                                        <td>'.$result['transactiondescription'].'</td>
                                        <td>'.$result['source'].'</td>
                                        <td class="text-success text-center bg-light font-weight-bold">'.$credit.'</td>
                                        <td class="text-danger text-center bg-warning font-weight-bold">'.$debit.'</td>
                                        <td class="text-dark bg-gradient-light font-weight-bold">₦'.$balance.'</td>
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
        document.getElementById('expenditure-sourcelist').addEventListener('click', getExpenditureSource)
        document.getElementById('income-sourcelist').addEventListener('click', getIncomeSource)
        let summary = document.getElementById('summary')
        let DOMelement = document.getElementById('detailsView')
        let sourceTitle = document.getElementById('sourceTitle')
        let eDate = document.getElementById('eDate').value
        let sDate = document.getElementById('sDate').value

        function getExpenditureSource(e){
            let source;
            if(e.target.classList.contains('expense-row'))
                source = e.target.parentNode.id
            else
                source = e.target.parentNode.id
            if(source){
                console.log('id = ' + e.target.parentNode.id)
                $.ajax({
                    method: "GET",
                    url: "ajax/expenditure.php?source="+source+"&sDate="+sDate+"&eDate="+eDate+"&orgId=<?php echo $_SESSION['orgId']?>",
                    success: function(resp){
                        console.log('htt');
                        let sourceObj = JSON.parse(resp)
                        sourceTitle.innerHTML = source + " Expenditure Details"
                        let totalAmount = loadAccountStatmentDetailsModal(sourceObj, DOMelement)
                        if(totalAmount)
                        {
                            loadSummary(summary, totalAmount)
                            $('#accountStatementDetails').modal('show')
                        }
                    }
                })
            }
        }

        function getIncomeSource(e){
            let source;
            if(e.target.classList.contains("income-row"))
                source = e.target.parentNode.id
            else
                source = e.target.parentNode.id
            //console.log(`ajax/income.php?source=${source}&sDate=${sDate}&eDate=${eDate}&orgId=${<?php echo $_SESSION['orgId']?>}`)
            //"ajax/income.php?source="+source+"&sDate="+sDate+"&eDate="+eDate+"&orgId=<?php echo $_SESSION['orgId']?>"
            if(source){
                $.ajax({
                    method: "GET",
                    url: `ajax/income.php?source=${source}&sDate=${sDate}&eDate=${eDate}&orgId=${<?php echo $_SESSION['orgId']?>}`,
                    success: function(resp){
                        let sourceObj = JSON.parse(resp)
                        //console.log(sourceObj)
                        sourceTitle.innerHTML = source + " Income Details"
                        //DOMelement.removeChild()
                        let totalAmount = loadAccountStatmentDetailsModal(sourceObj, DOMelement)
                        if(totalAmount){
                            loadSummary(summary, totalAmount)
                            $('#accountStatementDetails').modal('show')
                        }
                    }
                })
            }                
        }

        function loadSummary(DOMelement, total)
        {
            DOMelement.textContent = ""
            var paragraph = document.createElement('p'); //for total
            paragraph.appendChild(document.createTextNode(`Total Amount: ₦` + total))
            paragraph.setAttribute('class', "text-primary font-weight-bold p-2")
            DOMelement.appendChild(paragraph)
        }
        function loadAccountStatmentDetailsModal(arr, DOMelement)
        {
            DOMelement.textContent = "";  //clear the dom first
            let i=0; let total = 0

            for (let index = 0; index < arr.length; index++)
            {
                total += parseInt(arr[index].amount)

                var tRow = document.createElement('tr'); //for data
                
                var tData1 = document.createElement("td");
                var tData2 = document.createElement("td");
                var tData3 = document.createElement('td');
                var tData4 = document.createElement('td');
                var tData5 = document.createElement('td');                    

                tData1.appendChild(document.createTextNode(++i))                    
                tData2.appendChild(document.createTextNode(arr[index].transactiondescription))
                tData3.appendChild(document.createTextNode('₦'+arr[index].amount))
                tData4.appendChild(document.createTextNode(arr[index].transactiondate))
                tData5.appendChild(document.createTextNode(arr[index].username))
                tRow.appendChild(tData1)
                tRow.appendChild(tData2)
                tRow.appendChild(tData3)
                tRow.appendChild(tData4)
                tRow.appendChild(tData5)
                
                DOMelement.appendChild(tRow);
            }
            return total
        }
    })
</script>