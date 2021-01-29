<?php

class AccountController
{    
    public function verifyOrganisation($values)
    {
        $sql = "SELECT * FROM users WHERE username = '".$values['username']."' AND passwords = '".$values['passwords']."'";
        $runsql = DB::DBInstance()->query($sql);

        if($runsql->isExist())
        {
            $result = $runsql->getResults();
            //verify organisation            
            if($this->checkActivationStatus($result['orgId']))
            {                
                return true;
            }
            return false;
        }
        return false;
    }

    private function checkActivationStatus($orgId)
    {
        $sql = "SELECT * FROM organisation WHERE Id = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run->isExist())
        {
            $org = $run->getResults();
            if($org['isActive'])
            {
                return true;
            }
        }
        return false;
    }    

    
    /*THIS METHOD IS USED TO SIGN THE USER IN*/
    public function signin($values)
    {
        $sql = "SELECT * FROM users WHERE username = '".$values['username']."' AND passwords = '".$values['passwords']."'";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql)
        {
            $user = $runsql->getResults();
            if($user['isActive'])
            {
                $this->setSessionVariables($user);
                return true;
            }
            return false;
        }
        return false;
    }
    
    private function setSessionVariables($data)
    {
        $_SESSION['orgId'] = $data['orgId'];
        $_SESSION['userId'] = $data['Id'];
    }

    public function loggedIn()
    {
        if(isset($_SESSION['orgId']) && isset($_SESSION['userId']))
        {
            return true;
        }
        return false;
    }

    public function isSignedIn()
    {
		if(isset($_SESSION['orgId']) && isset($_SESSION['userId']))
        {
            return true;
        }
        header('Location: /ichurch/index.html');
    }

    public function isExpired($orgId)
    {
        $org = new Organisations();
        $result = $org->getOrgById($orgId);
        $today = date('Y-m-d');
        if($result['expireyDate'] <= $today)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function signout()
    {
        session_start();
        $_SESSION['orgId'] = '';
        $_SESSION['userId'] = '';
        session_destroy();
        header("Location: /ichurch/index.html");
    }
}