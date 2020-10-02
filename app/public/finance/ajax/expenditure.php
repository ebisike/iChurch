<?php
include_once '../../../Services/init.php';

if(isset($_GET['source']) && isset($_GET['sDate']) && isset($_GET['eDate']) && isset($_GET['orgId']))
{

    $datax = 
    [
        "startdate" => $_GET['sDate'],
        "enddate" => $_GET['eDate'],
        "orgId" => $_GET['orgId']
    ];
    $account = new AccountStatement($datax);
    $data = array();

    $source = $_GET['source'];
    $sDate = $_GET['sDate'];
    $eDate = $_GET['eDate'];
    $orgId = $_GET['orgId'];
    $resp = $account->getExpenseSourceSummaryDetails($source);
    while($r = $resp->getResults())
    {
        $data[] = $r;
    }
    echo json_encode($data);
}