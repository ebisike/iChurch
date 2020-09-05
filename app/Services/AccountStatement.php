<?php

    class AccountStatement extends Transactions
    {
        public $report;
        public $startDate;
        public $endDate;
        public $orgId;
        
        // public function __construct()
        // {
        //     #constructor            
        // }
        
        public function getStatement($values)
        {
            $startDate = strtotime($values['startdate']);
            $startDay = date('d', $startDate);
            $startMonth = date('m', $startDate);
            $startYear = date('Y', $startDate);

            $endDate = strtotime($values['enddate']);
            $endDay = date('d', $endDate);
            $endMonth = date('m', $endDate);
            $endYear = date('Y', $endDate);

            // $sql = "SELECT * FROM transactions WHERE
            //         (DAY(transactiondate) BETWEEN $startDay AND $endDay) AND
            //         (MONTH(transactiondate) BETWEEN $startMonth AND $endMonth) AND
            //         (YEAR(transactiondate) BETWEEN $startYear AND $endYear) AND orgId = '".$values['orgId']."'
            //         ORDER BY transactiondate DESC";

            // $sql = "SELECT * FROM transactions WHERE
            //     transactiondate BETWEEN '".$values['startdate']."' AND '".$values['enddate']."' AND orgId = '".$values['orgId']."'";

            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.transactiondate BETWEEN '".$values['startdate']."' AND '".$values['enddate']."' AND transactions.orgId = '".$values['orgId']."'";
            //var_dump($sql);

            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
            return false;
        }

        public function getOpenningBalance($values)
        {
            #THOUGHT
            #1 - Get the total credited amount before the start date of the statement request
            #2 - Get the total debited amount before the start of the statement request
            #3 - Subtract the two values
            /**************************************************************** */
                #1
            /***************************************************************** */
            $sql = "SELECT SUM(amount) AS credit FROM transactions
                    WHERE transactiontype = 1 AND transactiondate < '{$values['startdate']}' AND orgId = '{$values['orgId']}'";
            //var_dump($sql);

            $stmt = DB::DBInstance()->query($sql);
            $result = $stmt->getResults();
            $TotalCredit = $result['credit'];
            //echo 'credit= '.$TotalCredit.'<br>';
            /**************************************************************** */
                #2
            /***************************************************************** */
            $sql = "SELECT sum(amount) AS debit FROM transactions
                    WHERE transactiontype = 0 AND transactiondate < '{$values['startdate']}' AND orgId = '{$values['orgId']}'";
            $stmt = DB::DBInstance()->query($sql);
            $result = $stmt->getResults();
            $TotalDebit = $result['debit'];
            //echo 'debit= '.$TotalDebit.'<br>';


            #3.
            $diff =  $TotalCredit - $TotalDebit;
            //$sign = ($TotalCredit > $TotalDebit) ? "" : "-";
            return $diff;
        }

        public function getCLosingBalance($values)
        {
            $creditBalance = 0;
            $debitBalance = 0;
            $closingBalance = 0;
            $statementData = $this->getStatement($values);
            while($result = $statementData->getResults())
            {
                $result['transactiontype'] ? $creditBalance += $result['amount'] : $debitBalance += $result['amount'];
            }

            $closingBalance = ($creditBalance - $debitBalance) + $this->getOpenningBalance($values);
            //echo $closingBalance;
            return $closingBalance;
        }

        private function getSourceList($orgId)
        {
            #THOUGHT
            # GET ALL DISTINCT TRANSACTION SOURCE IN AN ARRAY
            #ITRATE THROUGH THE ARRAY AND GET SUM OF EACH AMOUNT FOR EACH PARTICULAR SOURCE
            $sourceList = array();
            $sql = "SELECT DISTINCT source FROM transactions WHERE orgId = '$orgId'";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                while($source = $stmt->getResults())
                {
                    $sourceList[] = $source;
                }
                return $sourceList;
                //json_encode($sourceList, JSON_PRETTY_PRINT);
                //var_dump(json_encode($sourceList, JSON_PRETTY_PRINT));
            }
        }

        public function getIncomeSourceSummary($orgId)
        {
            $data = array();
            $sourceList = $this->getSourceList($orgId); //get distinct sources for transactions
            //var_dump($sourceList);
            for ($i=0; $i < count($sourceList); $i++)
            { 
                $sql = "SELECT source, amount FROM transactions
                        WHERE source = '{$sourceList[$i]['source']}' AND orgId = '$orgId' AND transactiontype=1";
                $run = DB::DBInstance()->query($sql);
                $temp = array("source"=>"","amount"=>0);
                while ($r = $run->getResults())
                {
                    //echo $r['amount'].' = '.$sourceList[$i]['source'].'<br>';
                    $temp['amount'] += $r['amount'];
                    $temp['source'] = $sourceList[$i]['source'];
                }
                array_push($data, $temp);
            }
            //var_dump($data);
            return $data;
        }

        public function getExpenditureSourceSummary($orgId)
        {
            $data = array();
            $sourceList = $this->getSourceList($orgId); //get distinct sources for transactions
            //var_dump($sourceList);
            for ($i=0; $i < count($sourceList); $i++)
            { 
                $sql = "SELECT source, amount FROM transactions
                        WHERE source = '{$sourceList[$i]['source']}' AND orgId = '$orgId' AND transactiontype=0";
                $run = DB::DBInstance()->query($sql);
                $temp = array("source"=>"","amount"=>0);
                while ($r = $run->getResults())
                {
                    //echo $r['amount'].' = '.$sourceList[$i]['source'].'<br>';
                    $temp['amount'] += $r['amount'];
                    $temp['source'] = $sourceList[$i]['source'];
                }
                array_push($data, $temp);
            }
            //var_dump($data);
            return $data;
        }

        public function getTransactionBySource($source, $transactiontype, $orgId)
        {
            $sql = "SELECT * FROM transactions
                    WHERE source = '$source' AND transactiontype = '$transactiontype' AND orgId = '$orgId'";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                $data = array();
                while($result = $stmt->getResults())
                {
                    array_push($data, $result);
                }
                return $data;
            }
        }

        public function getIncomeSourceSummaryDetails($source, $sDate, $eDate, $orgId)
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.transactiondate BETWEEN '".$sDate."' AND '".$eDate."' AND transactions.transactiontype = 1 AND transactions.orgId = '$orgId' AND transactions.source = '$source'";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
        }

        public function getExpenseSourceSummaryDetails($source, $sDate, $eDate, $orgId)
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.transactiondate BETWEEN '".$sDate."' AND '".$eDate."' AND transactions.transactiontype = 0 AND transactions.orgId = '$orgId' AND transactions.source = '$source'";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
        }
    }
    