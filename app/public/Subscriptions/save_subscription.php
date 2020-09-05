<?php

require ('../../Services/init.php');

$subscription = new Subscriptions();
if(isset($_GET['pkgId']) && isset($_GET['orgId']))
{
    $pkgId = $_GET['pkgId'];
    $orgId = $_GET['orgId'];
    $status = $subscription->requestPackage($orgId, $pkgId);
    echo json_encode($status);
}