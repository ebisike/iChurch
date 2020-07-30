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
        $imagepath = "passportfilepath";

        $sql = "INSERT INTO members (orgId,userId,imagepath, familyId, firstName, lastName, otherName, dateOfBirth, gender, addresss, email, phone1, phone2, stateoforigin, lga, village, maritalstatus, nameofspouse, natureofmarriage, dateofmarriage, numberofchildren, academicqualification, profession, occupation, occupationaddress, isbaptised, baptismdate, isconfirmed, confirmationdate, group)
        
        VALUES ('".$value['orgId']."', '".$value['userId']."', '".$imagepath."', '".$value['familyId']."', '".$value['firstName']."',  '".$value['lastName']."', '".$value['otherName']."', '".$value['dateOfBirth']."', '".$value['gender']."', '".$value['addresss']."', '".$value['email']."', '".$value['phone1']."', '".$value['phone2']."', '".$value['stateOfOrigin']."', '".$value['lga']."', '".$value['village']."','".$value['maritalStatus']."','".$value['nameOfSpouse']."','".$value['natureOfMarriage']."','".$value['dateOfMarriage']."', '".$value['numberOfChildren']."', '".$value['academic']."', '".$value['profession']."', '".$value['occupation']."', '".$value['occupationAddress']."', '".$value['isBaptised']."', '".$value['baptismDate']."', '".$value['isConfirmed']."', '".$value['confirmationDate']."', '".$value['group']."')";

        $runsql = DB::DBInstance()->query($sql);
        if ($runsql)
        {
            var_dump($runsql);
            return true;
        }
        var_dump($sql);
        return false;
    }

    public function getAllMembers($orgId)
    {
        $sql = "SELECT * FROM members WHERE orgId = '$orgId'";
        $runsql = DB::DBInstance()->query($sql);
        return $runsql;
    }

    public function getMember($orgId, $memberId)
    {
        $sql = "SELECT * FROM members WHERE id = '$memberId' AND orgId = '$orgId'";
        $run = DB::DBInstance()->query($sql);
        if ($run)
        {
            return $run->getResults();
        }
    }

    public function deleteMember($orgId, $memberId)
    {
        $sql = "DELETE FROM members WHERE orgId = '$orgId' AND id = '$memberId'";
        $run = DB::DBInstance()->query($sq1);
        if($run)
        {
            return true;
        }
        return false;
    }

}