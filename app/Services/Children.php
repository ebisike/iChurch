<?php

class Children
{
    public $Id;
    public $orgId;
    public $userId;
    public $memberId;
    public $childFirstName;
    public $childOtherName;
    public $dateOfBirth;
    public $age;

    public function addChild($values)
    {
        $sql = "INSERT INTO `children` (`Id`, `orgId`, `userId`, `memberId`, `firstName`, `otherName`, `dateOfBirth`)
                VALUES (NULL, '{$values['orgId']}', '{$values['userId']}', '{$values['memberId']}', '{$values['firstName']}', '{$values['otherName']}', '{$values['dob']}');";
        $runsql = DB::DBInstance()->query($sql);

        if($runsql)
        {
            return true;
        }
        return false;
    }

    public function updateChild($values)
    {
        $sql = "UPDATE children SET                
                firstName = '{$values['firstName']}',
                otherName = '{$values['otherName']}',
                dateOfBirth = '{$values['dob']}'
                WHERE orgId = '{$values['orgId']}'  AND Id = '{$values['id']}'";

        $runsql = DB::DBInstance()->query($sql);
        if($runsql)
        {
            return true;
        }
        return false;
    }

    public function getAllChildren($orgId)
    {
        $sql = "SELECT * FROM children WHERE orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        return $run;
    }

    public function getChild($id, $orgId)
    {
        $sql = "SELECT * FROM children WHERE orgId = '$orgId' AND Id = '$id'";
        $run = DB::DBInstance()->query($sql);
        return $run->getResults();
    }

    public function getMemberChildren($memberId, $orgId)
    {
        $sql = "SELECT * FROM children WHERE orgId = '$orgId' AND memberId = '$memberId'";
        $run = DB::DBInstance()->query($sql);
        return $run;
    }
}