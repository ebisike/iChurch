<?php
//create role
if(isset($_POST['createrole']))
{
    $role->createRole($_POST);
}

//add user to role
if(isset($_POST['addUserToRole']))
{    
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