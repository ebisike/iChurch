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
        $sql = "INSERT INTO childern (orgId, userId, memberId, firstName, otherName, dateOfBirth)
                VALUES ('{$values['orgId']}', '{$values['userId']}', '{$values['memberId']}', '{$values['firstName']}', '{$values['otherName']}', '{$values['dob']}')";
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
                orgId = '{$values['orgId']}',
                userId = '{$values['userId']}',
                memberId = '{$values['memberId']}',
                firstName = '{$values['firstName']}',
                lastName = '{$values['lastName']}',
                dateOfBirth = '{$values['dateOfBirth']}'
                WHERE orgId = '{$values['orgId']}' AND userId = '{$values['userId']}' AND id = '{$values['id']}'";

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
        $sql = "SELECT * FROM children WHERE orgId = '$orgId' AND id = '$id'";
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