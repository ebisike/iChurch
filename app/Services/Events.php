<?php

class Events
{
    public $eventName;
    public $eventDate;
    public $numberOfGuest;

    public function __construct()
    {
        
    }

    public function createEvent($values)
    {
        $sql = "INSERT INTO events (Id, eventname, eventdate, numberofguests, orgId, userId)
                VALUES (NULL, '".$values['eventname']."', '".$values['eventdate']."', '".$values['numberofguests']."', '".$values['orgId']."', '".$values['userId']."')";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }

    public function getAllEvents($orgId)
    {
        $sql = "SELECT * FROM events WHERE orgId = '$orgId' ORDER BY Id DESC";
        $stmt = DB::DBInstance()->query($sql);
        return $stmt;
    }

    public function getEvent($Id, $orgId)
    {
        $sql = "SELECT * FROM events WHERE Id = '$Id' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        return $stmt->getResults();
    }

    public function deleteEvent($Id, $orgId)
    {
        $sql = "DELETE FROM events WHERE Id = '$Id' AND orgId ='$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {
            return true;
        }
        return false;
    }
}