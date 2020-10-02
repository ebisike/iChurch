<?php

class Calendar
{
    public function CreateEvent($values)
    {
        $sql = "INSERT INTO Calendar (Id, EventDate, Title, Descriptions, Organizers, orgId, userId)
                VALUES (NULL, '".$values['EventDate']."', '".$values['Title']."', '".$values['descriptions']."', '".$values['organizer']."', '".$values['orgId']."', '".$values['userId']."')";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt){
            return true;
        }
        return false;
    }

    public function GetCalendarAllEvents($orgId)
    {
        $sql = "SELECT * FROM calendar INNER JOIN users
                ON calendar.userId = users.Id
                WHERE calendar.orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        return $stmt;
    }

    public function GetCalendarEvent($eventdate, $orgId)
    {
        $sql = "SELECT * FROM calendar INNER JOIN users
                ON calendar.userId = users.Id
                WHERE calendar.EventDate = '$eventdate' AND calendar.orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        return $stmt;
    }

    public function DeleteCalendarEvent($eventDate, $orgId)
    {
        $sql = "DELETE FROM calendar WHERE EventDate = '$eventDate' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt){
            return true;
        }
        return false;
    }
}