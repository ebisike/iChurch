<?php
class HouseFellowship
{
    public $cordinatorId;
    public $address;
    public $meetingDay;
    public $meetingTime;
    public $dateCreated;

    public function createFellowshipUnit($values)
    {
        $sql = "INSERT INTO housefellowship (Id, fellowshipname, cordinatorId, addresss, meetingday, meetingtime, orgId, userId)
                VALUES (NULL, '".$values['fellowshipname']."', '".$values['cordinatorId']."', '".$values['addresss']."', '".$values['meetingday']."', '".$values['meetingtime']."', '".$values['orgId']."', '".$values['userId']."')";
        $run = DB::DBInstance()->query($sql);
        //var_dump($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    public function getAllFellowshipUnits($orgId)
    {
        $sql = "SELECT * FROM housefellowship
                INNER JOIN members
                ON housefellowship.cordinatorId = members.Id
                WHERE housefellowship.orgId = '$orgId'
                ORDER BY housefellowship.Id DESC";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
        return false;
    }

    public function readAllFellowshipUnits($orgId)
    {
        $sql = "SELECT * FROM housefellowship                
                WHERE orgId = '$orgId'
                ORDER BY Id DESC";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
        return false;
    }

    public function getHouseFellowshipUnit($Id, $orgId)
    {
        $sql = "SELECT * FROM housefellowship
        INNER JOIN members
        ON housefellowship.cordinatorId = members.Id
        WHERE housefellowship.orgId = '$orgId' AND housefellowship.Id = '$Id'
        ORDER BY housefellowship.Id DESC";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt;
        }
        return false;
    }

    public function updateHouseFellowship($values)
    {
        $sql = "UPDATE housefellowship SET
                cordinatorId = '".$values['cordinatorId']."', addresss = '".$values['addresss']."'
                WHERE Id = '".$values['fellowshipId']."' AND orgId = '".$values['orgId']."'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function deleteFellowshipUnit($Id, $orgId)
    {
        $sql = "DELETE FROM housefellowship WHERE Id = '$Id' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            $this->deleteAllMembersFromFellowship($Id, $orgId);
            return true;
        }
        return false;
    }

    //private function getMemberId()

    public function addMemberToFellowshipUnit($values)
    {
        $sql = "INSERT INTO housefellowshipmembers (Id, fellowshipId, memberId, orgId, userId)
                VALUES (NULL, '".$values['fellowshipId']."', '".$values['memberId']."', '".$values['orgId']."', '".$values['userId']."')";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function isMemberAdded($memberId, $orgId)
    {
        $sql = "SELECT * FROM housefellowshipmembers WHERE memberId = '$memberId' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run->isExist())
        {
            return true;
        }
        return false;
    }

    public function removeMemberFromFellowshipUnit($values)
    {
        $sql = "DELETE FROM housefellowshipmembers
                WHERE Id = '".$values['Id']."' AND memberId = '".$values['memberId']."' AND orgId = '".$values['orgId']."'";
        $stmt = DB::DBInstance()->query($sql);
        return true;
    }

    public function deleteAllMembersFromFellowship($fellowshipId,$orgId)
    {
        $sql = "DELETE FROM housefellowshipmembers
                WHERE fellowshipId = '$fellowshipId' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function getAllHouseFellowshipMembers($fellowshipId, $orgId)
    {
        $sql = "SELECT * FROM housefellowshipmembers
        INNER JOIN members 
        ON housefellowshipmembers.memberId = members.Id
        WHERE housefellowshipmembers.fellowshipId = '$fellowshipId' AND housefellowshipmembers.orgId = '$orgId'";
        $stmt  = DB::DBInstance()->query($sql);
        return $stmt;
    }
}