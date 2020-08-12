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

    public function __construct($orgId)
    {
        //create roles needed for minimal processes
        $this->superAdminRole =
        [
            "roleName" => "superAdmin",
            "orgId" => $orgId
        ];

        $this->vicarRole = 
        [
            "roleName" => "vicar",
            "orgId" => $orgId
        ];

        #super user details
        $this->superUser = 
        [
            "firstName" => "George",
            "lastName" => "Ebisike",
            "passwords" => "admin",
            "username" => "georgefx",
            "orgId" => $orgId
        ];

        $this->addUser2SuperAdminRole =
        [
            "users" => $this->superUser['username'],
            "roleName" => $this->superAdminRole['roleName'],
            "orgId" => $orgId
        ];        

        $this->role = new Roles();
        $this->user = new Users();
        $this->add_user_to_role = new UsersInRole();
    }
    public function seedSuperAdminRoles()
    {
        $this->role->createRole($this->superAdminRole);        
    }

    public function seedVicarRole()
    {
        $this->role->createRole($this->vicarRole);
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