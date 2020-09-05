<?php

include_once '../../../Services/init.php';

$houseFellowship = new HouseFellowship();
$members = new Members();
$data = array();
$filteredData = array(); //for filtering out members that have been assigned.

//view all fellowships and their members
if(isset($_GET['fellowshipList']))
{
    $results = $houseFellowship->readAllFellowshipUnits($_GET['fellowshipList']);
    while($result = $results->getResults())
    {
        $data[] = $result;
    }
    echo json_encode($data);
}


if(isset($_GET['fellowshipID']) && isset($_GET['orgId']))
{
    $results = $houseFellowship->getAllHouseFellowshipMembers($_GET['fellowshipID'], $_GET['orgId']);
    while($result = $results->getResults())
    {
        $data[] = $result;
    }
    echo json_encode($data);
}

//get fellowship cordinator
if(isset($_GET['fetchCordinator']) && isset($_GET['orgId']))
{
    $results = $houseFellowship->getHouseFellowshipUnit($_GET['fetchCordinator'], $_GET['orgId']);
    $result = $results->getResults();
    echo json_encode($result);
}