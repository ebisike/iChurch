<?php
class Config extends DB
{
    public function __construct()
    {
       $this->createTableOrganisation();
       $this->createTableRoles();
       $this->createTableUsersInRole();
       $this->createTableUsers();
       $this->createTableFamilyTree();
       $this->createTableMembers();
       $this->createTableChildren();
    }

    private function createTableOrganisation()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `ichurch`.`Organisation` ( `Id` INT(10) NOT NULL AUTO_INCREMENT , `OrgName` VARCHAR(30) NOT NULL , `OrgEmail` VARCHAR(30) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;";

        $runsql = DB::DBInstance()->query($sql);
        if ($runsql) {
            # code...
            //echo 'created';
        }
    }

    private function createTableRoles()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `ichurch`.`Roles` ( `Id` INT(10) NOT NULL AUTO_INCREMENT , `roleName` VARCHAR(255) NOT NULL , `orgId` INT(255) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;";
        $run = DB::DBInstance()->query($sql);
    }

    private function createTableUsersInRole()
    {
        $sql = "CREATE TABLE IF NOT EXISTS`ichurch`.`UsersInRole` ( `Id` INT(10) NOT NULL AUTO_INCREMENT , `roleName` VARCHAR(255) NOT NULL , `userId` INT(255) NOT NULL , `orgId` INT(255) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;
        ";
        $run = DB::DBInstance()->query($sql);
    }

    private function createTableUsers()
    {
        $sql = "CREATE TABLE `ichurch`.`Users` ( `Id` INT(10) NOT NULL AUTO_INCREMENT , `firstName` VARCHAR(255) NOT NULL , `lastName` VARCHAR(255) NOT NULL , `username` VARCHAR(255) NOT NULL , `isActive` BOOLEAN NOT NULL DEFAULT TRUE , `orgId` INT(255) NOT NULL , `passwords` VARCHAR(255) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;";

        $stmt = DB::DBInstance()->query($sql);
    }

    private function createTableFamilyTree()
    {
        $sql = "CREATE TABLE `ichurch`.`familytree` ( `Id` INT(255) NOT NULL AUTO_INCREMENT , `branchName` VARCHAR(255) NOT NULL , `familyId` INT(255) NOT NULL , `orgId` INT(255) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;";

        $run = DB::DBInstance()->query($sql);
    }

    private function createTableMembers()
    {
        $sql = "CREATE TABLE `ichurch`.`members` ( `Id` INT(255) NOT NULL AUTO_INCREMENT , `orgId` INT(255) NOT NULL , `userId` INT(255) NOT NULL , `familyId` INT(255) NOT NULL , `stewardship` VARCHAR(255) NULL , `firstName` VARCHAR(255) NOT NULL , `lastName` VARCHAR(255) NOT NULL , `otherName` VARCHAR(50) NOT NULL , `dateOfBirth` DATE NOT NULL , `gender` VARCHAR(255) NOT NULL , `addresss` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `phone1` VARCHAR(255) NOT NULL , `phone2` VARCHAR(255) NULL , `stateoforigin` VARCHAR(255) NOT NULL , `lga` VARCHAR(255) NULL , `village` VARCHAR(255) NULL , `maritalstatus` VARCHAR(255) NOT NULL , `nameofspouse` VARCHAR(255) NOT NULL , `natureofmarriage` VARCHAR(255) NOT NULL , `dateofmarriage` DATE NOT NULL , `numberofchildren` INT(255) NULL , `academicqualification` VARCHAR(255) NULL , `profession` VARCHAR(255) NULL , `occupation` VARCHAR(255) NULL , `occupationaddress` VARCHAR(255) NULL , `isbaptised` BOOLEAN NOT NULL , `baptismdate` DATE NULL , `isconfirmed` BOOLEAN NOT NULL , `confirmationdate` DATE NULL , `group` VARCHAR(255) NULL , `imagepath` VARCHAR(255) NULL , `isAlive` BOOLEAN NOT NULL DEFAULT TRUE , PRIMARY KEY (`Id`)) ENGINE = InnoDB;
        ";

        $run = DB::DBInstance()->query($sql);
    }

    private function createTableChildren()
    {
        $sql = "CREATE TABLE `ichurch`.`children` ( `Id` INT(255) NOT NULL AUTO_INCREMENT , `orgId` INT(255) NOT NULL , `userId` INT(255) NOT NULL , `memberId` INT(255) NOT NULL , `firstName` VARCHAR(255) NOT NULL , `otherName` VARCHAR(255) NOT NULL , `dateOfBirth` DATE NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;";

        $run = DB::DBInstance()->query($sql);
    }
}