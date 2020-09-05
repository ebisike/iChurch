<?php
include_once '../../../Services/init.php';
$account = new AccountStatement();
$data = array();

if(isset($_GET['source']) && isset($_GET['sDate']) && isset($_GET['eDate']) && isset($_GET['orgId']))
{
    $source = $_GET['source'];
    $sDate = $_GET['sDate'];
    $eDate = $_GET['eDate'];
    $orgId = $_GET['orgId'];
    $resp = $account->getExpenseSourceSummaryDetails($source, $sDate, $eDate, $orgId);
    while($r = $resp->getResults())
    {
        $data[] = $r;
    }
    echo json_encode($data);
}