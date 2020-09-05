<?php

class Attendance
{
    public function postAttendance($values)
    {
        $sql = "INSERT INTO `attendance` (`Id`, `malecount`, `femalecount`, `childrencount`, `attendancedate`, `orgId`, `userId`)
                VALUES (NULL, '".$values['males']."', '".$values['females']."', '".$values['children']."', '".$values['dates']."', '".$values['orgId']."', '".$values['userId']."')";
        
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    public function getAllAttendanceList($orgId)
    {
        $sql = "SELECT * FROM attendance
                WHERE orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return $run;
        }
        return false;
    }

    public function getAttendanceByDate($date, $orgId)
    {
        $sql  = "SELECT * FROM attendance
                INNER JOIN users
                ON attendance.userId = users.Id
                WHERE attendance.orgId = '$orgId' AND attendance.attendancedate = '$date'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return $run;
        }
        return false;
    }

    public function deleteAttendance($Id, $orgId)
    {
        $sql = "DELETE FROM attendance WHERE Id = '$Id' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }
}