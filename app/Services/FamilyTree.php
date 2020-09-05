<?php
class FamilyTree
{
    public $Id;
    public $familyId;
    public $branchName;
    public $memberId;
    public $orgId;

    public function createTreeBranch($branchName, $orgId)
    {
        //generate a branch
        $this->familyId = $this->generateFamilyID($branchName,$orgId);
        $sql = "INSERT INTO familyTree (familyId, branchName, orgId) VALUES ('{$this->familyId}', '{$branchName}', '{$orgId}')";
        $run = DB::DBInstance()->query($sql);
        if ($run) {
            return $this->getLastInput($orgId); //check if this returns 
        }
    }

    public function getLastInput($orgId)
    {
        //get the Id of the last record that was inserted into the members table.
        $sql = "SELECT * FROM familytree WHERE orgId = '$orgId' ORDER BY Id DESC limit 1";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql)
        {
            $lastId = $runsql->getResults();
            return $lastId;
        }
        return false;
    }

    public function generateFamilyID($branchName, $orgId)
    {
        $num = mt_rand(100000,999999);
        //$familyId = $branchName."/".$num; var_dump($familyId);
        $isTaken = $this->isBranchTaken($num, $orgId);
        if($isTaken)
        {
            //echo 'exit'; exit();
            $this->generateFamilyID($branchName, $orgId);
        }
        else
        {
            //echo 'new'; exit();
            return $num;
        }
    }

    public function isBranchTaken($number, $orgId)
    {
        $sql = "SELECT * FROM familytree WHERE familyId = '$number' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);        
        if($stmt->isExist())
        {
            //var_dump($stmt->isExist());
            return true;
        }
        return false;
    }

    public function getAllTreeBranch($orgId)
    {
        $sql = "SELECT * FROM familytree WHERE orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        return $stmt;
    }
}