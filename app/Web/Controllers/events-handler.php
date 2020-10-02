<?php
$event = new Events(); //create an instance of the class Events
$calendar = new Calendar();

if(isset($_POST['add_event']))
{
    foreach ($_POST as $key => $value) {
        $_POST[$key] = $validate->validateForm($value);
    }
    $event->createEvent($_POST);
    header('location: ../Events/allevents.php');

}

if(isset($_POST['addCalendarEvent']))
{
    foreach ($_POST as $key => $value) {
        $_POST[$key] = $validate->validateForm($value);
    }
    $calendar->CreateEvent($_POST);
    header('location: ../calendar/calendar.php');
}