<?php

    //create user
    if(isset($_POST['create']))
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = $validate->validateForm($value); //striping the user input            
        }

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
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = $validate->validateForm($value); //striping the user input            
        }

        if($user->updateUser($_POST))
        {
            header('location: listusers.php');
        }else{
            echo 'username is taken';
        }
    }

    //single updates
    if(isset($_POST['updateUserProfile']))
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = $validate->validateForm($value); //striping the user input            
        }

        if($user->updateUser($_POST)){
            header('location: ../mgt/index.php');
        }
    }
?>