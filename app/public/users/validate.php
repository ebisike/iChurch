<?php

    include_once '../../Services/init.php';
    $user = new Users();
    if(isset($_GET['orgId']))
    {
        $orgId = $_GET['orgId'];
        $results = $user->getAllUsers($orgId);
        $username = array(); //create an array to hold all the usernames
        while($result = $results->getResults())
        {
            $username[] = $result;
        }
        echo json_encode($username);
    }
    
?>