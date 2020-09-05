<?php

class FirstTimers
{
    public $firstName;
    public $lastName;
    public $otherName;
    public $phone; //string
    public $addresss; //string
    public $isRetained; //boolean

    public function addFirstTimer($values)
    {
        $sql = "INSERT INTO firsttimers (Id, firstname, lastname, othername, phone, addresss, eventId, orgId, userId)
                VALUES (NULL, '".$values['firstname']."', '".$values['lastname']."', '".$values['othername']."', '".$values['phone']."', '".$values['addresss']."', '".$values['eventId']."', '".$values['orgId']."', '".$values['userId']."')";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function getAllFirstTimers($orgId)
    {
        $sql = "SELECT * FROM firsttimers
                INNER JOIN events
                ON firsttimers.eventId = events.Id
                WHERE firsttimers.orgId = '$orgId'
                ORDER BY firsttimers.Id DESC";
        $stmt = DB::DBInstance()->query($sql);
        return $stmt;
    }

    public function getFirstTimer($Id, $orgId)
    {
        $sql = "SELECT * FROM firsttimers WHERE Id = '$Id' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return $stmt->getResults();
        }
        return false;
    }

    public function retainFirstTimer($phone, $orgId)
    {
        $sql = "UPDATE firsttimers SET
                isRetained = 1
                WHERE phone = '$phone' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function deleteFirstTimer($phone, $orgId)
    {
        $sql = "DELETE FROM firsttimers WHERE phone = '$phone' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function updateFirstTimer($Id, $orgId)
    {

    }
}