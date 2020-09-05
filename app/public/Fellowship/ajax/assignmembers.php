<?php

include_once '../../../Services/init.php';

$houseFellowship = new HouseFellowship();
$members = new Members();
$data = array();
$filteredData = array(); //for filtering out members that have been assigned.

#get all the house fellowships.
if(isset($_GET['fetchFellowship']))
{
    $results = $houseFellowship->readAllFellowshipUnits($_GET['fetchFellowship']);
    while($result = $results->getResults())
    {
        $data[] = $result;
    }
    echo json_encode($data);
}

//get members to add to house fellowship
if(isset($_GET['fetchMember']))
{
    $results = $members->getAllMembers($_GET['fetchMember']);
    while($result = $results->getResults())
    {
        $data[] = $result;
    }

    foreach ($data as $key => $value)
    {
        #check if a particular member has already been assigned to a house fellowship
        #if yes, skip
        #if NOT add the member to the filtered list.
        if($houseFellowship->isMemberAdded($value['Id'], $value['orgId']))
        {
            continue;
        }
        $filteredData[] = $value;
    }
    echo json_encode($filteredData);
}