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
        $this->$familyId = $this->generateFamilyID($branchName);
        $sql = "INSERT INTO familyTree (familyId, branchName, orgId) VALUES ('{$this->familyId}', '{$branchName}', '{$orgId}')";
        //$run = DB::DBInstance()->query($sql);
        if ($insertId = $run->getLastId($sql)) {
            # code...
            return $insertId;
        }
    }

    private function generateFamilyID($branchName)
    {
        $familyID = $branchName.'_'.mt_rand(100000,999999);
        if(!$this->isBranchTaken($familyID))
        {
            return $familyID;
        }
        $this->generateFamilyID($branchName);
    }

    public function isBranchTaken($number)
    {
        $sql = "SELECT * FROM FamilyTree WHERE familyId = '{$number}' AND orgId = '{orgId}'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt->isExist())
        {
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