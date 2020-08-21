<?php
$event = new Events(); //create an instance of the class Events

if(isset($_POST['add_event']))
{
    foreach ($_POST as $key => $value) {
        $_POST[$key] = $validate->validateForm($value);
    }
    $event->createEvent($_POST);
}