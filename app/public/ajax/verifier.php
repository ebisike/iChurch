<?php
    include_once '../../Services/init.php';
    if(isset($_GET['orgId']))
    {
        $org = new Organisations();
        $result = $org->getOrgById($_GET['orgId']);
        echo json_encode($result);
    }