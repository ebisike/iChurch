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

            $sql = "SELECT * FROM transactions WHERE
                transactiondate BETWEEN '".$values['startdate']."' AND '".$values['enddate']."' AND orgId = '".$values['orgId']."'";
            //var_dump($sql);

            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {   //var_dump($stmt);
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
    }
    