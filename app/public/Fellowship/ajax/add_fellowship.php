<?php

include_once '../../../Services/init.php';

$houseFellowship = new HouseFellowship();
$members = new Members();
$data = array();
$filteredData = array(); //for filtering out members that have been assigned.

#get all members to assign as cordinator.
if(isset($_GET['id']))
{
    $results = $members->getAllMembers($_GET['id']);
    while($result = $results->getResults())
    {
        $data[] = $result;
    }

    echo json_encode($data);
}