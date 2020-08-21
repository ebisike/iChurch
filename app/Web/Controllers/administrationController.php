<?php
//create role
if(isset($_POST['createrole']))
{
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = $validate->validateForm($value); //striping the user input            
    }

    $role->createRole($_POST);
}

//add user to role
if(isset($_POST['addUserToRole']))
{    
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = $validate->validateForm($value); //striping the user input            
    }
    
    if ($userInRole->addUserToRole($_POST)) {
        header('Location: ../mgt/index.php');
    }
}

//delete role
if(isset($_POST['deleteRole']))
{
    $orgId = $_POST['orgId'];
    $roleName = $_POST['roleName'];
    $role->deleteRole($orgId, $roleName);
}

//remove user
if(isset($_POST['removeUser']))
{
    $orgId = $_POST['orgId'];
    $userId = $_POST['users'];
    $userInRole->removeUserFromRole($userId, $orgId);
}