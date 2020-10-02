<?php
$event = new Events(); //create an instance of the class Events

if(isset($_POST['searchBirthday']))
{
    $startDate = $_POST['startdate'];
    $endDate = $_POST['enddate'];
    header("location: /ichurch/app/public/alerts/quickbirthday.php?sd=".$startDate."&ed=".$endDate."");
}

if(isset($_POST['searchAnniversary']))
{
    $startDate = $_POST['startdate'];
    $endDate = $_POST['enddate'];
    header("location: /ichurch/app/public/alerts/quickanniversary.php?sd=".$startDate."&ed=".$endDate."");
}

if(isset($_POST['searchFamily']))
{
    $familyId = $_POST['familyId'];
    header("location: /ichurch/app/public/alerts/quickfamily.php?fam=".$familyId."");
}