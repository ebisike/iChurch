<?php

class Roles
{
    public $roleName;
    private $roleId;

    public function createRole($value)
    {
        //$name = $validate->validateForm($value['roleName']);
        $sql = "INSERT INTO Roles (roleName, orgId) VALUES ('".$value['roleName']."', '".$value['orgId']."')";
        $run = DB::DBInstance()->query($sql);
        if ($run)
        {
            return true;
        }
        return false;
    }

    public function deleteRole($orgId, $name)
    {
        $sql = "DELETE FROM Roles WHERE roleName = '$name' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if ($run)
        {
            # code...
            #DELETE ALL USERS FRON THE ROLE
            $userRole = new UsersInRole();
            $userRole->removeAllUsersFromRole($name, $orgId);
            return true;
        }
        return false;
    }

    public function listRoles($orgId)
    {
        $sql = "SELECT * FROM roles WHERE orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return $run;
        }
    }
}


