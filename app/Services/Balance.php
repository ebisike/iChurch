<?php
    class Balance
    {
        public $amount;
        private $orgId;
        private $userId;
        public $balance;

        public function __construct($orgId, $userId)
        {
            $this->amount = 0.0;
            $this->orgId = $orgId;
            $this->userId = $userId;

            $this->balance = $this->getBalance(); #set the value of balance
        }
        public function initializeBalance()
        {
            $sql = "INSERT INTO `balance` (`currentbalance`, `orgId`, `userId`)
                VALUES ('".$this->amount."', '".$this->orgId."', '".$this->userId."')";

            $runsql = DB::DBInstance()->query($sql);
            if($runsql)
            {
                return true;
            }
            return false;
        }

        public function setBalance($amount)
        {
            $this->getBalance();
            //$currentBal = $result['currentbalance'];

            $newBal = $this->balance + ($amount);            

            $sql = "UPDATE balance
                    SET currentbalance = '$newBal'
                    WHERE orgId = '$this->orgId'";
            $run = DB::DBInstance()->query($sql);
            if($run)
            {
                return true;
            }
            return false;
        }

        public function getBalance()
        {
            $sql = "SELECT * FROM balance WHERE orgId = '$this->orgId'";
            $run = DB::DBInstance()->query($sql);
            if($run)
            {
                $result = $run->getResults();
                #$this->balance = $result['currentbalance'];
                return $result['currentbalance'];
            }
        }
    }