<?php

class SeedData
{
    public $superAdminRole;
    public $superUser;

    public $vicarRole;
    
    public $role;
    public $user;

    public $add_user_to_role;

    public $addUser2SuperAdminRole;

    public function __construct($orgId, $orgEmail)
    {
        //create roles needed for minimal processes
        $this->superAdminRole =
        [
            "roleName" => "superAdmin",
            "orgId" => $orgId
        ];

        $this->LeadPastor = 
        [
            "roleName" => "lead_pastor",
            "orgId" => $orgId
        ];

        $this->AsstPastor = 
        [
            "roleName" => "asst_pastor",
            "orgId" => $orgId
        ];

        $this->ChurchSec = 
        [
            "roleName" => "secretary",
            "orgId" => $orgId
        ];

        $this->regular = 
        [
            "roleName" => "regular",
            "orgId" => $orgId
        ];

        #super user details
        $this->superUser = 
        [
            "firstName" => "George",
            "lastName" => "Ebisike",
            "passwords" => "admin",
            "username" => "georgefx"."_".$orgEmail,
            "orgId" => $orgId
        ];

        $this->addUser2SuperAdminRole =
        [
            "users" => $this->superUser['username'],
            "roleName" => $this->superAdminRole['roleName'],
            "orgId" => $orgId
        ];

        //create subscription packages


        $this->role = new Roles();
        $this->user = new Users();
        $this->add_user_to_role = new UsersInRole();
    }
    public function seedSuperAdminRoles()
    {
        $this->role->createRole($this->superAdminRole);        
    }

    public function seedLeadPastorRole()
    {
        $this->role->createRole($this->LeadPastor);
    }

    public function seedAsstPastorRole()
    {
        $this->role->createRole($this->AsstPastor);
    }

    public function seedChurchSecRole()
    {
        $this->role->createRole($this->ChurchSec);
    }

    public function seedRegularRole()
    {
        $this->role->createRole($this->regular);
    }

    public function seedSuperUser()
    {
        $this->user->createUser($this->superUser);
    }

    public function addSuperUserToRole()
    {
        $this->add_user_to_role->addUserToRole($this->addUser2SuperAdminRole);
    }
}