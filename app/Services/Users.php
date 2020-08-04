<?php

class Users
{
    public $Id;
    public $firstName;
    public $lastName;
    public $username;
    public $orgId;
    public $isActive;
    private $password;

    public function createUser($values)
    {
        $this->firstName = $values['firstName'];
        $this->lastName = $values['lastName'];
        $this->password = $values['passwords'];
        $this->orgId = $values['orgId'];
        $this->username = $values['username'];

        if(empty($_FILES['file']['name'])){
            $imageName = 'fx_male_Avatar.png';
        }
        else
        {
            #get the file name
            $imageName = basename($_FILES['file']['name']);
            $fileSize = $_FILES['file']['size']; echo $fileSize/1048576 . '<br>';
            $imageName = $values['lastName'].'_'.$values['firstName'].'_'.$imageName;
            #create a directory for the image
            $targetDir = "images/";
            #create a file path
            $targetFilePath = $targetDir . $imageName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowedFileType = array('jpg','jpeg','png','JPG','JPEG','PNG');

            if(in_array($fileType, $allowedFileType)){
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                        //echo 'moved';
                }
            }else{
                echo "<script>alert('The type of image being uploaded is not allowed. Please Choose a different Image.')</script>";
            }
        }

        if(!$this->isUsernameTaken($this->username, $this->orgId))
        {
            $sql = "INSERT INTO users (firstName, lastName, username, orgId, passwords, imagepath)
                    VALUES ('".$this->firstName."','".$this->lastName."', '".$this->username."', '".$this->orgId."','".$this->password."', '".$imageName."')";
            $stmt = DB::DBInstance()->query($sql);

            if ($stmt)
            {
                # code...
                return true;
            }
        }
        return false;
    }

    private function isUsernameTaken($username, $orgId)
    {
        $sql = "SELECT * FROM users WHERE orgId = '$orgId' AND username = '$username'";
        $stmt = DB::DBInstance()->query($sql);
        if($stmt->isExist())
        {
            return true;
        }
        return false;
    }
    public function suspendUser($userId, $orgId)
    {
        //get isActive status
        $this->isActive = $this->getActiveStatus($userId, $orgId);
        if ($this->isActive)
        {
            $sql = "UPDATE users SET isActive = '0' WHERE Id = '$userId' AND orgId = '$orgId'";
            $runsql = DB::DBInstance()->query($sql);
            return true;
        }
        else
        {
            $sql = "UPDATE users SET isActive = '1' WHERE Id = '$userId' AND orgId = '$orgId'";
            $runsql = DB::DBInstance()->query($sql);
            return true;
        }
    }

    public function getActiveStatus($userId, $orgId)
    {
        $sql = "SELECT * FROM users WHERE Id = '$userId' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if ($result = $stmt->getResults())
        {
            # code...
            //return ($result['isActive']) ? 'true' : 'false';
            if($result['isActive'])
            {
                return true;
            }
            return false;
        }
    }

    public function deleteUser($userId, $orgId)
    {
        $sql = "DELETE FROM users WHERE Id = '$userId' AND orgId = '$orgId'";
        $stmt = DB::DBInstance()->query($sql);
        if ($stmt) {
            # code...
            return true;
        }
        return false;
    }

    public function getAllUsers($orgId)
    {
        $sql = "SELECT * FROM users WHERE orgId = '$orgId' AND username != 'admin'";
        $run = DB::DBInstance()->query($sql);
        return $run;
    }

    public function getUser($id, $orgId)
    {
        $sql = "SELECT * FROM users WHERE orgId = '$orgId' AND Id = '$id'";
        $run = DB::DBInstance()->query($sql);
        return $run->getResults();
    }

    public function updateUser($values)
    {
        if(empty($_FILES['file']['name'])){
            $imageName = 'fx_male_Avatar.png';
        }
        else
        {
            #get the file name
            $imageName = basename($_FILES['file']['name']);
            $fileSize = $_FILES['file']['size']; echo $fileSize/1048576 . '<br>';
            $imageName = $values['lastName'].'_'.$values['firstName'].'_'.$imageName;
            #create a directory for the image
            $targetDir = "images/";
            #create a file path
            $targetFilePath = $targetDir . $imageName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowedFileType = array('jpg','jpeg','png','JPG','JPEG','PNG');

            if(in_array($fileType, $allowedFileType)){
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                        //echo 'moved';
                }
            }else{
                echo "<script>alert('The type of image being uploaded is not allowed. Please Choose a different Image.')</script>";
            }
        }

        $sql = "UPDATE users SET                
                firstName = '{$values['firstName']}',
                lastName = '{$values['lastName']}',
                username = '{$values['username']}',
                passwords = '{$values['passwords']}',
                imagepath = '$imageName'
                WHERE orgId = '{$values['orgId']}' AND  Id = '{$values['id']}'";

        $runsql = DB::DBInstance()->query($sql);
        if($runsql)
        {
            return true;
        }
        return false;
    }

    public function updateFirstName($values)
    {
        $sql = "UPDATE users
                SET firstName = '".$values['firstName']."'
                WHERE Id = '".$values['id']."' AND orgId = '".$values['orgId']."'";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql){
            return true;
        }
        return false;
    }

    public function updateLastName($values)
    {
        $sql = "UPDATE users
                SET lastName = '".$values['lastName']."'
                WHERE Id = '".$values['id']."' AND orgId = '".$values['orgId']."'";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql){
            return true;
        }
        return false;
    }

    public function updateUsername($values)
    {
        $sql = "UPDATE users
                SET username = '".$values['username']."'
                WHERE Id = '".$values['id']."' AND orgId = '".$values['orgId']."'";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql){
            return true;
        }
        return false;
    }

    public function updatePassword($values)
    {
        $sql = "UPDATE users
                SET passwords = '".$values['passwords']."'
                WHERE Id = '".$values['id']."' AND orgId = '".$values['orgId']."'";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql){
            return true;
        }
        return false;
    }
}