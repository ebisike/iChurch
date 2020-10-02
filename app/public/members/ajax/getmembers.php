<?php

include_once '../../../Services/init.php';

$members = new Members();
if(isset($_GET['orgId']) && isset($_GET['familyId']))
{
    $treeBranches = $members->getFamilyMembers($_GET['familyId'], $_GET['orgId']);
    while ($result = $treeBranches->getResults()) {
        $data[] = $result;
    }

    echo json_encode($data);
}