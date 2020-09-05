<?php

class AdminUser
{
    public $subscriptionLength;
    public function login($values)
    {
        $sql  = "SELECT * FROM admin WHERE username = '".$values['username']."' AND password = '".$values['password']."'";
        $run = DB::DBInstance()->query($sql);
        if($run->isExist())
        {
            $user = $run->getResults();
            if($x=$this->updateLastLoggedin($user['Id']))
            {
                //var_dump($x);exit();
                return $user;
            }
            return false;
        }
    }

    private function updateLastLoggedin($Id)
    {
        $date = date('Y-m-d');
        $sql = "UPDATE admin SET lastloggedin = '$date' WHERE Id = '$Id'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    public function getAllOrganisations()
    {
        $sql = "SELECT * FROM organisation";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return $run;
        }
    }

    public function getOrganisation($orgId)
    {
        $sql = "SELECT * FROM organisation WHERE Id = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return $run->getResults();
        }
    }
    
    public function activateOrganisation($orgId)
    {
        $sql = "UPDATE organisation SET isActive = 1 WHERE Id = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            $this->renewSubscription($orgId, 0);
            return true;
        }
        return false;
    }

    public function deactivateOrganisation($orgId)
    {
        $sql = "UPDATE organisation SET isActive = 0 WHERE Id = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    public function renewSubscription($orgId, $duration)
    {
        //first get the organisation
        $org = $this->getOrganisation($orgId);
        $currentDay = date('d');
        
        //get the current day of the organisation's subscription
        $orgCurrentDay = date('d', strtotime($org['expirydate']));

        $diff = $orgCurrentDay - $currentDay;

        //compute new subscription duration
        $computed = $this->computeSubscriptionDuration($duration);
        //add difference as rollover subscription bonus
        $rollover = $diff + $computed;
        $today = date('Y-m-d');
        $newDate = date('Y-m-d', strtotime($today. ' + '.$rollover.' days'));
        
        $sql = "UPDATE organisation SET isActive = 1, expirydate = '$newDate' WHERE Id = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    private function computeSubscriptionDuration($duration)
    {
        switch ($duration) {
            case '0':
                # code...
                $this->subscriptionLength = 14;
                break;
            case '1':
                # code...
                $this->subscriptionLength = 30;
                break;
            case '4':
                # code...
                $this->subscriptionLength = 120;
                break;
            case '6':
                # code...
                $this->subscriptionLength = 180;
                break;
            case '12':
                # code...
                $this->subscriptionLength = 365;
                break;
            default:
                # code...
                break;
        }
        return $this->subscriptionLength;
    }
}