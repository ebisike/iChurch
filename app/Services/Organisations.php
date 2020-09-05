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
            $today = date('Y-m-d');
            $sql = "INSERT INTO Organisation (OrgName, OrgEmail, expirydate) VALUES ('".$orgName."', '".$orgEmail."', '".$today."')";
            //$sql = "INSERT INTO Organisation (OrgName, OrgEmail) VALUES ('femi kuti', 'femi@g.com')";
            $runsql = DB::DBInstance()->query($sql);
            if($runsql)
            {
                return true;
            }
        }
        return "Not Created"; //0779475243
        
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
        //$email = stripslashes($email);
        $email = addslashes($email);
        $sql = "SELECT * FROM organisation WHERE OrgEmail = '{$email}'";
        $stmt = DB::DBInstance()->query($sql);
        //var_dump($sql); exit();
        if($stmt)
        {
            return $stmt->getResults();
            // var_dump(json_encode($x)); exit();
            // //echo 'yh: '.$x; exit();
        }else{
            var_dump(json_encode($stmt));
            echo "not found"; exit();
        }
    }

    public function validateForm($data)
    {
        $data = addslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function getOrgById($orgId)
    {
        $sql = "SELECT * FROM organisation WHERE Id = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt->isExist())
        {
            $data = $stmt->getResults();
            return $data;
        }
    }
    public function updateActivationStatus($orgId)
    {
        $sql = "UPDATE organisation
                SET isActive = 1
                WHERE Id = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    public function calculateExpiryDate($orgId)
    {
        $today = date('Y-m-d');
        $org = $this->getOrgById($orgId);
        $orgExpiryDate = $org['expirydate'];
    }
}