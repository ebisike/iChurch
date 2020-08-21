<?php

    $houseFellowship = new HouseFellowship(); //instance of the class
    if(isset($_POST['add_house_fellowship']))
    {
        foreach ($_POST as $key => $value) {
            # code...
            $_POST[$key] = $validate->validateForm($value);
        }
        $houseFellowship->createFellowshipUnit($_POST);
    }

    if(isset($_POST['assign_member']))
    {
        foreach ($_POST as $key => $value) {
            # code...
            $_POST[$key] = $validate->validateForm($value);
        }
        $houseFellowship->addMemberToFellowshipUnit($_POST);
        header('location: house-fellowships.php');
    }