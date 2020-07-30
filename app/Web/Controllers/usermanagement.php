<?php

    //create user
    if(isset($_POST['create']))
    {
        if($user->createUser($_POST))
        {
            header('location: listusers.php');
        }else{
            echo 'username is taken';
        }
    }

    //update user
    if(isset($_POST['update']))
    {
        if($user->updateUser($_POST))
        {
            header('location: listusers.php');
        }else{
            echo 'username is taken';
        }
    }

    //single updates
    if(isset($_POST['updateFirstName']))
    {
        if($user->updateFirstName($_POST)){
            header('location: ../mgt/index.php');
        }
    }

    if(isset($_POST['updateLastName']))
    {
        if($user->updateLastName($_POST)){
            header('location: ../mgt/index.php');
        }
    }
?>