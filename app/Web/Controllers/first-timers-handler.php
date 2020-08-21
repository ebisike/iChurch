<?php

$firstTimer = new FirstTimers();

if(isset($_POST['add_first_timer']))
{
    echo 'hit';
    foreach ($_POST as $key => $value) {
        $_POST[$key] = $validate->validateForm($value);
    }
    $firstTimer->addFirstTimer($_POST);
}