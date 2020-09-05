<?php
class Subscriptions
{
    public $package;
    public $orgId;
    public $date;
    public $data;
    public function __construct()
    {
        $this->date = date('Y-m-d');
        $this->data = array();
    }

    public function requestPackage($orgId, $packageId)
    {
        $sql = "INSERT INTO subscriptionrequests (Id, orgId, paymentpackageId, 	daterequested)
                VALUES (NULL, '$orgId', '$packageId', '$this->date')";
        $stmt = DB::DBInstance()->query($sql);
        //var_dump($stmt); die("error");
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function getSubscriptions($orgId)
    {
        $sql = "SELECT * FROM subscriptionrequests WHERE orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            while($r = $stmt->getResults())
            {
                $this->data[] = $r;
            }
            return $this->data;
        }
    }

    public function deleteSubscription($Id, $orgId)
    {
        $sql = "DELETE FROM subscriptionrequests WHERE Id = '$Id' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt){
            return true;
        }
        return false;
    }

    public function activateSubscription($Id, $orgId)
    {
        $sql = "UPDATE subscriptionrequests SET isTreated = 1 WHERE Id = '$Id' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function readAllPendingRequests()
    {
        $sql = "SELECT * FROM subscriptionrequests WHERE isTreated = 0";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            while($r = $stmt->getResults())
            {
                $this->data[] = $r;
            }
            return $this->data;
        }
    }
}