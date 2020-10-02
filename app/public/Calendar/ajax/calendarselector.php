<?php
include_once '../../../Services/init.php';
$calendar = new Calendar();

if(isset($_GET['select']))
{
    //var_dump('here');

    $date = $_GET['select'];
    $data = array();
    
    $resp = $calendar->GetCalendarEvent($date, $_SESSION['orgId']);
    while($r = $resp->getResults())
    {
        $data[] = $r;
    }
    echo json_encode($data);
}