<?php
    include_once '../../Services/init.php';
    if(isset($_GET['id']))
    {
        $orgId = $_GET['id'];

        $data = array();
        $event = new Events();
        $results = $event->getAllEvents($orgId);
        while($result = $results->getResults())
        {
            $data[] = $result;            
        }
        echo json_encode($data);
    }
?>
