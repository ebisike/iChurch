<?php

include_once '../../../Services/init.php';

$familyTree = new FamilyTree();
if(isset($_GET['id']))
{
    $treeBranches = $familyTree->getAllTreeBranch($_GET['id']);
    while ($result = $treeBranches->getResults()) {
        $data[] = $result;
    }

    echo json_encode($data);
}