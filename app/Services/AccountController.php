<?php

class AccountController
{    
    public function signin($values)
    {
        $sql = "SELECT * FROM users WHERE username = '".$values['username']."' AND passwords = '".$values['passwords']."'";
        $runsql = DB::DBInstance()->query($sql);

        if($runsql->isExist())
        {
            $result = $runsql->getResults();
            //verify organisation
            $org = $this->verifyOrganisation($result['orgId']);
            if($org)
            {
                $this->setSessionVariables($result);
                return $result;
            }
            return false;
        }
        return false;
    }

    private function verifyOrganisation($orgId)
    {
        $sql = "SELECT * FROM organisation WHERE id = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run->isExist())
        {
            return true;
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

    public function isSignedIn(){
		if(isset($_SESSION['orgId']) && isset($_SESSION['userId']))
        {
            return true;
        }
        header('Location: /ichurch/index.html');
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