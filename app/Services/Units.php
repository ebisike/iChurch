<?php

class Units
{
    public $unitHead;
    public $contact;
    public $meetingVenue;
    public $meetingDay;
    public $meetingTime;

    public function createUnit($values)
    {
        $sql = "INSERT INTO units (Id, unitheadId, meetingvenue, meetingday, meetingtime, orgId, userId)
                VALUES (NULL, '".$values['memberId']."', '".$values['meetingvenue']."', '".$values['meetingday']."', '".$values['meetingday']."', '".$values['orgId']."', '".$values['userId']."')";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function getAllUnits($orgId)
    {
        $sql = "SELECT * FROM units
                INNER JOIN members
                ON units.unitheadId = members.Id
                WHERE units.orgId = '$orgId'
                ORDER BY units.Id DESC";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
        return false;
    }

    public function getUnit($Id, $orgId)
    {
        $sql = "SELECT * FROM units
        INNER JOIN members
        ON units.unitheadId = members.Id
        WHERE units.orgId = '$orgId' AND units.Id = '$Id'
        ORDER BY units.Id DESC";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
        return false;
    }

    public function updateHouseFellowship($values)
    {
        $sql = "UPDATE units SET
                unitheadId = '".$values['unitheadId']."', meetingvenue = '".$values['meetingvenue']."'
                WHERE Id = '".$values['unitId']."' AND orgId = '".$values['orgId']."'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function deleteFellowshipUnit($Id, $orgId)
    {
        $sql = "DELETE FROM units WHERE Id = '$Id' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    public function addMemberToUnit($values)
    {
        $sql = "INSERT INTO unitmembers (Id, unitId, memberId, orgId, userId)
                VALUES (NULL, '".$values['unitId']."', '".$values['memberId']."', '".$values['orgId']."', '".$values['userId']."')";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function removeMemberFromUnit($values)
    {
        $sql = "DELETE FROM unitmembers
                WHERE Id = '".$values['Id']."' AND memberId = '".$values['memberId']."' AND orgId = '".$values['orgId']."'";
        $stmt = DB::DBInstance()->query($sql);
        return true;
    }


}