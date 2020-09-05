<?php

include_once '../../../Services/init.php';
$attendance = new Attendance();
$data = array();

if(isset($_GET['date']) && isset($_GET['orgId']))
{
    $result = $attendance->getAttendanceByDate($_GET['date'], $_GET['orgId']);
    while($r = $result->getResults()){
        $data[] = $r;
    }
    echo json_encode($data);
}