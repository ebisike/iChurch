<?php

    class AccountStatement extends Transactions
    {
        public $report;
        public $startDate;
        public $endDate;
        public $orgId;
        
        public function __construct($values)
        {
            $this->startDate = $values['startdate'];
            $this->endDate = $values['enddate'];
            $this->orgId = $values['orgId'];
        }
        
        public function getStatement()
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.transactiondate BETWEEN '".$this->startDate."' AND '".$this->endDate."' AND transactions.orgId = '".$this->orgId."'";
            //var_dump($sql);

            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
            return false;
        }

        public function getOpenningBalance()
        {
            #THOUGHT
            #1 - Get the total credited amount before the start date of the statement request
            #2 - Get the total debited amount before the start of the statement request
            #3 - Subtract the two values
            /**************************************************************** */
                #1
            /***************************************************************** */
            // $sql = "SELECT SUM(amount) AS credit FROM transactions
            //         WHERE transactiontype = 1 AND transactiondate < '{$this->startDate}' AND orgId = '{$this->orgId}'";
            // //var_dump($sql);

            // $stmt = DB::DBInstance()->query($sql);
            // $result = $stmt->getResults();
            // $TotalCredit = $result['credit'];
            // //echo 'credit= '.$TotalCredit.'<br>';
            // /**************************************************************** */
            //     #2
            // /***************************************************************** */
            // $sql = "SELECT sum(amount) AS debit FROM transactions
            //         WHERE transactiontype = 0 AND transactiondate < '{$this->startDate}' AND orgId = '{$this->endDate}'";
            // $stmt = DB::DBInstance()->query($sql);
            // $result = $stmt->getResults();
            // $TotalDebit = $result['debit'];
            //echo 'debit= '.$TotalDebit.'<br>';
            $TotalCredit = 0;
            $TotalDebit = 0;
            $sql = "SELECT amount, transactiontype FROM transactions
                    WHERE transactiondate < '{$this->startDate}' AND orgId = '{$this->orgId}'";

            $stmt = DB::DBInstance()->query($sql);
            while ($result = $stmt->getResults()) {
                # code...
                $result['transactiontype'] ? $TotalCredit += $result['amount'] : $TotalDebit += $result['amount'];
            }


            #3.
            $diff =  $TotalCredit - $TotalDebit;            
            return $diff;
        }

        public function getCLosingBalance()
        {
            $creditBalance = 0;
            $debitBalance = 0;
            $closingBalance = 0;
            $statementData = $this->getStatement();
            while($result = $statementData->getResults())
            {
                $result['transactiontype'] ? $creditBalance += $result['amount'] : $debitBalance += $result['amount'];
            }

            $closingBalance = ($creditBalance - $debitBalance) + $this->getOpenningBalance();
            //echo $closingBalance;
            return $closingBalance;
        }

        private function getSourceList()
        {
            #THOUGHT
            # GET ALL DISTINCT TRANSACTION SOURCE IN AN ARRAY
            #ITRATE THROUGH THE ARRAY AND GET SUM OF EACH AMOUNT FOR EACH PARTICULAR SOURCE
            $sourceList = array();
            $sql = "SELECT DISTINCT source FROM transactions
                    WHERE orgId = '$this->orgId' AND transactiondate BETWEEN '".$this->startDate."' AND '".$this->endDate."'";
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

        public function getIncomeSourceSummary()
        {
            $data = array();
            $sourceList = $this->getSourceList(); //get distinct sources for transactions
            //var_dump($sourceList);
            for ($i=0; $i < count($sourceList); $i++)
            { 
                $sql = "SELECT source, amount FROM transactions
                        WHERE source = '{$sourceList[$i]['source']}' AND orgId = '$this->orgId' AND transactiontype=1";
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

        public function getExpenditureSourceSummary()
        {
            $data = array();
            $sourceList = $this->getSourceList(); //get distinct sources for transactions
            //var_dump($sourceList);
            for ($i=0; $i < count($sourceList); $i++)
            { 
                $sql = "SELECT source, amount FROM transactions
                        WHERE source = '{$sourceList[$i]['source']}' AND orgId = '$this->orgId' AND transactiontype=0";
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

        public function getIncomeSourceSummaryDetails($source)
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.transactiondate BETWEEN '".$this->startDate."' AND '".$this->endDate."' AND transactions.transactiontype = 1 AND transactions.orgId = '$this->orgId' AND transactions.source = '$source'";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
        }

        public function getExpenseSourceSummaryDetails($source)
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.transactiondate BETWEEN '".$this->startDate."' AND '".$this->endDate."' AND transactions.transactiontype = 0 AND transactions.orgId = '$this->orgId' AND transactions.source = '$source'";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
        }
    }
    