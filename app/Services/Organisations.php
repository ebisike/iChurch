<?php

class Organisations
{
    public $id;
    public $organisationName;
    public $organisationEmail;
    private $password;
    public $emailList;

    public function CreateOrganisation($orgEmail, $orgName)
    {
        $orgName = $this->validateForm($orgName);
        $orgEmail = $this->validateForm($orgEmail);
        
        //first we check that the email is not taken already
        $result = $this->isEmailTaken($orgEmail);
        if (!$result)
        {
            $sql = "INSERT INTO Organisation (OrgName, OrgEmail) VALUES ('".$orgName."', '".$orgEmail."')";
            //$sql = "INSERT INTO Organisation (OrgName, OrgEmail) VALUES ('femi kuti', 'femi@g.com')";
            $runsql = DB::DBInstance()->query($sql);
            if($runsql)
            {
                return true;
            }
        }
        return "Not Created";
        
    }

    private function isEmailTaken($email)
    {
        $sql = "SELECT OrgEmail From Organisation WHERE OrgEmail = '$email'";
        $runsql = DB::DBInstance()->query($sql);
        if ($runsql->isExist())
        {
            # code...
            return true;
        }
        return false;
    }
    public function AllEmailsUsed()
    {
        $sql = "SELECT orgEmail FROM Organisation";
        $runsql = DB::DBInstance()->query($sql);
        if ($runsql)
        {
            # code...
            while($result = $runsql->getResults())
            {

            }
        }
    }

    public function getOrgName($OrgId)
    {
        $sql = "SELECT OrgName FROM Organisation WHERE Id = '$OrgId'";
        $runsql = DB::DBInstance()->query($sql);
        if ($runsql)
        {
            # code...
            $x = $runsql->getResults();
            return $x['OrgName'];
        }
    }

    public function getOrgEmail($OrgId)
    {
        $sql = "SELECT OrgEmail FROM Organisation WHERE Id = '$OrgId'";
        $runsql = DB::DBInstance()->query($sql);
        if ($runsql)
        {
            # code...
            $x = $runsql->getResults();
            return $x['OrgEmail'];
        }
    }

    public function getOrgByEmail($email)
    {
        $sql = "SELECT * FROM organisation WHERE OrgEmail = '$email'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt->isExist())
        {
            return $stmt->getResults();
        }
    }

    public function validateForm($data)
    {
        $data = addslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}