<?php

    class Transactions
    {
        public $transactionType; #boolean 1=Credit 0=Debit;
        public $source;
        public $desc;
        public $amount;
        public $transactionDate;
        public $systemDate;
        public $orgId;
        public $userId;

        public function postCreditTransaction($values)
        {
            //$sysdate = date('Y-m-d');
            $sql = "INSERT INTO `transactions` (`Id`, `transactiontype`, `source`, `transactiondescription`, `amount`, `transactiondate`, `orgId`, `userId`)
            VALUES (NULL, '".$values['transactiontype']."', '".$values['source']."', '".$values['descriptions']."','".$values['amount']."', '".$values['transactiondate']."', '".$values['orgId']."', '".$values['userId']."')";

            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                //if succesful, update balance accordingly
                $bal = new Balance($values['orgId'], $values['userId']);
                if($bal->setBalance($values['amount']))
                {
                    return true;
                }
            }
            return false;
        }

        public function postDebitTransaction($values)
        {
            //$sysdate = date('Y-m-d');
            $sql = "INSERT INTO `transactions` (`Id`, `transactiontype`, `source`, `transactiondescription`, `amount`, `transactiondate`, `orgId`, `userId`)
            VALUES (NULL, '".$values['transactiontype']."', '".$values['source']."', '".$values['descriptions']."','".$values['amount']."', '".$values['transactiondate']."', '".$values['orgId']."', '".$values['userId']."')";

            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                //if successfull update balance accordingly
                $bal = new Balance($values['orgId'], $values['userId']);
                if($bal->setBalance(-$values['amount']))
                {
                    return true;
                }
            }
            return false;
        }

        public function getAllTransactions($orgId)
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.orgId = '$orgId'
                    ORDER BY transactions.Id DESC";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
            return false;
        }

        public function getCreditTransactions($orgId)
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.orgId = '$orgId' AND transactions.transactiontype = 1
                    ORDER BY transactions.Id DESC";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
            return false;
        }

        public function getDebitTransactions($orgId)
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.orgId = '$orgId' AND transactions.transactiontype = 0
                    ORDER BY transactions.Id DESC";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt;
            }
            return false;
        }

        public function getTransaction($transactionId, $orgId)
        {
            $sql = "SELECT * FROM transactions
                    INNER JOIN users
                    ON transactions.userId = users.Id
                    WHERE transactions.orgId = '$orgId' AND transactions.Id = '$transactionId'";
            $stmt = DB::DBInstance()->query($sql);
            if($stmt)
            {
                return $stmt->getResults();
            }
            return false;
        }
    }