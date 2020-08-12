<?php

class UsersInRole
{
    public $Id;
    public $roleId;
    public $roleName;
    public $userId;
    public $orgId;

    public function isUserInRole($name, $userid, $orgId)
    {
        $sql = "SELECT * FROM UsersInRole WHERE roleName = '$name' AND userId = '$userid' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if ($run->isExist())
        {
            $result = $run->getResults();
            if(strtolower($result['roleName']) == strtolower($name))
            {
                return true;
            }
            return false;
        }
    }

    public function getUserInRole($userId, $orgId)
    {
        $sql = "SELECT * FROM usersInRole WHERE userId = '$userId' AND orgId = '$orgId'";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql->isExist())
        {
            return true;
        }
        return false;
    }

    public function getUserRole($userId, $orgId)
    {
        $sql = "SELECT * FROM usersInRole WHERE userId = '$userId' AND orgId = '$orgId'";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql->isExist())
        {
            return $runsql->getResults();
        }
        return false;
    }

    public function isRoleAssigned($orgId)
    {
        $sql = "SELECT * FROM users WHERE orgId = '$orgId'";
        $runsql = DB::DBInstance()->query($sql);

        if($runsql->isExist())
        {
            while($result = $runsql->getResults())
            {
                if($this->getUserInRole($result['Id'], $result['orgId']))
                {
                    continue;
                }
                //$result = $result;
                var_dump($result);
            }
            //return $result;
        }        
        //return false;
    }

    public function isRoleAssignedx($orgId)
    {
        $sql = "SELECT * FROM users AS ux
                LEFT OUTER JOIN usersinrole AS us
                ON ux.Id = us.userId
                WHERE ux.orgId = '$orgId'";

        $stmt = DB::DBInstance()->query($sql);
        if($stmt)
        {            
            return $stmt;
        }
        return false;
    }

    public function addUserToRole($values)
    {
        $sql = "SELECT * FROM users WHERE username = '".$values['users']."' AND orgId = '".$values['orgId']."'";
        $stmt = DB::DBInstance()->query($sql);
        $x = $stmt->getResults();

        $sql = "INSERT INTO UsersInRole (roleName, userId, orgId)
                VALUES ('".$values['roleName']."', '".$x['Id']."', '".$values['orgId']."')";
        $run = DB::DBInstance()->query($sql);
        if ($run) {
            return true;
        }
        return false;
    }

    public function removeUserFromRole($userId, $orgId)
    {
        $sql = "DELETE FROM UsersInRole WHERE userId = '$userId' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if ($run) {
            # code...
            return true;
        }
        return false;
    }

    public function removeAllUsersFromRole($roleName, $orgId)
    {
        $sql = "DELETE FROM usersinrole WHERE roleName = '$roleName' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        $run ?  true : false;
    }

    public function allUsersInRole($orgId)
    {
        $sql = "SELECT * FROM usersinrole
                INNER JOIN users
                ON usersinrole.userId = Users.Id
                WHERE usersinrole.orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        return $stmt;
    }

    // public function allUsersInRolev($orgId)
    // {
    //     $sql = "SELECT * FROM usersinrole                
    //             WHERE orgId = '$orgId'";
    //     $stmt = DB::DBInstance()->query($sql);
    //     return $stmt;
    // }
}