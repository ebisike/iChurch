<?php
class Members
{
    public $Id;
    public $imagePath;
    public $firstName;
    public $lastName;
    public $otherName;
    public $dateOfBirth;
    public $age;
    public $gender;
    public $addresss;
    public $phone1;
    public $phone2;
    public $stateOfOrigin;
    public $lga;
    public $village;
    public $maritalStatus;
    public $nameOfSpouse;
    public $natureOfMarriage;
    public $dateOfMarriage;
    public $numberOfChildren;
    public $academicQualification;
    public $profession;
    public $occupation;
    public $occupationAddress;
    public $isBaptised;
    public $baptismDate;
    public $isConfirmed;
    public $confirmationDate;
    public $group;

    public function addMember($value)
    {
        if(empty($_FILES['file']['name'])){
            if($value['gender'] == 'MALE'){
                $imageName = 'fx_male_Avatar.png';
            }else{
                $imageName = 'fx_female_Avatar.png';
            }
        }
        else
        {
            #get the file name
            $imageName = basename($_FILES['file']['name']);
            $fileSize = $_FILES['file']['size']; echo $fileSize/1048576 . '<br>';
            $imageName = $value['lastName'].'_'.$value['firstName'].'_'.$imageName;
            #create a directory for the image
            $targetDir = "passports/";
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

        $sql = "INSERT INTO `members` (`Id`, `orgId`, `userId`, `familyId`, `stewardship`, `firstName`, `lastName`, `otherName`, `dateOfBirth`, `gender`, `addresss`, `email`, `phone1`, `phone2`, `stateoforigin`, `lga`, `village`, `maritalstatus`, `nameofspouse`, `natureofmarriage`, `dateofmarriage`, `numberofchildren`, `academicqualification`, `profession`, `occupation`, `occupationaddress`, `isbaptised`, `baptismdate`, `isconfirmed`, `confirmationdate`, `group`, `imagepath`)
        
        VALUES (NULL, '".$value['orgId']."', '".$value['userId']."', '".$value['familyId']."', '".$value['stewardship']."', '".$value['firstName']."', '".$value['lastName']."', '".$value['otherName']."', '".$value['dateOfBirth']."', '".$value['gender']."', '".$value['addresss']."', '".$value['email']."', '".$value['phone1']."', '".$value['phone2']."', '".$value['stateOfOrigin']."', '".$value['lga']."', '".$value['village']."', '".$value['maritalStatus']."', '".$value['nameOfSpouse']."', '".$value['natureOfMarriage']."', '".$value['dateOfMarriage']."', '".$value['numberOfChildren']."', '".$value['academic']."', '".$value['profession']."', '".$value['occupation']."', '".$value['occupationAddress']."', '".$value['isBaptised']."', '".$value['baptismDate']."', '".$value['isConfirmed']."', '".$value['confirmationDate']."', '".$value['group']."', '$imageName');";

        $runsql = DB::DBInstance()->query($sql);
        if ($runsql)
        {
            if($lastId = $this->getLastInput($value['orgId']))
            {
                return $lastId;
            }
            return false;
        }
        return false;
    }

    public function getLastInput($orgId)
    {
        //get the Id of the last record that was inserted into the members table.
        $sql = "SELECT * FROM members WHERE orgId = '$orgId' ORDER BY Id DESC";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql)
        {
            $lastId = $runsql->getResults();
            return $lastId;
        }
        return false;
    }

    public function getAllMembers($orgId)
    {
        $sql = "SELECT * FROM members WHERE orgId = '$orgId' ORDER BY Id DESC";
        $runsql = DB::DBInstance()->query($sql);
        return $runsql;
    }

    public function getMember($memberId, $orgId)
    {
        $sql = "SELECT * FROM members WHERE Id = '$memberId' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if ($run)
        {
            return $run->getResults();
        }
    }

    public function deleteMember($memberId, $orgId)
    {
        $sql = "DELETE FROM members WHERE orgId = '$orgId' AND Id = '$memberId'";
        $run = DB::DBInstance()->query($sql);
        if($run)
        {
            return true;
        }
        return false;
    }

    public function restInPeace($memberId, $orgId)
    {
        $isAlive = false;
        $sql = "UPDATE members SET isAlive = 'isAlive' WHERE Id = '$memberId' AND orgId = '$orgId'";
        $runsql = DB::DBInstance()->query($sql);
        if($runsql)
        {
            return true;
        }
        return false;
    }


    public function updateMember($value)
    {
        if(empty($_FILES['file']['name'])){
            #the user did not upload a new picture. use the existing one
            $member = $this->getMember($value['memberId'], $value['orgId']);
            $imageName = $member['imagepath'];            
        }
        else
        {
            #get the file name
            $imageName = basename($_FILES['file']['name']);
            $fileSize = $_FILES['file']['size']; //echo $fileSize/1048576 . '<br>';
            $imageName = $value['lastName'].'_'.$value['firstName'].'_'.$imageName;
            #create a directory for the image
            $targetDir = "passports/";
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

        $sql = "UPDATE `members` SET                
                `stewardship` = '".$value['stewardship']."',
                `firstName` = '".$value['firstName']."',
                `lastName` = '".$value['lastName']."',
                `otherName` = '".$value['otherName']."',
                `dateOfBirth` = '".$value['dateOfBirth']."',
                `gender` = '".$value['gender']."',
                `addresss` = '".$value['addresss']."',
                `email` = '".$value['email']."',
                `phone1` = '".$value['phone1']."',
                `phone2` = '".$value['phone2']."',
                `stateoforigin` = '".$value['stateOfOrigin']."',
                `lga` = '".$value['lga']."',
                `village` = '".$value['village']."',
                `maritalstatus` = '".$value['maritalStatus']."',
                `nameofspouse` = '".$value['nameOfSpouse']."',
                `natureofmarriage` = '".$value['natureOfMarriage']."',
                `dateofmarriage` = '".$value['dateOfMarriage']."',
                `numberofchildren` = '".$value['numberOfChildren']."',
                `academicqualification` = '".$value['academic']."',
                `profession` = '".$value['profession']."',
                `occupation` = '".$value['occupation']."',
                `occupationaddress` = '".$value['occupationAddress']."',
                `isbaptised` = '".$value['isBaptised']."',
                `baptismdate` = '".$value['baptismDate']."',
                `isconfirmed` = '".$value['isConfirmed']."',
                `confirmationdate` = '".$value['confirmationDate']."',
                `group` = '".$value['group']."',
                `imagepath` = '$imageName'
                WHERE orgId = '".$value['orgId']."' AND Id = '".$value['memberId']."'";

        $runsql = DB::DBInstance()->query($sql);
        if ($runsql)
        {
            if($lastId = $this->getLastInput($value['orgId']))
            {
                return $lastId;
            }
            return false;
        }
        return false;
    }

}