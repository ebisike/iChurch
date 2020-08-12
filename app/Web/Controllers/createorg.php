<?php
    if(isset($_POST['register']))
    {
        $orgName = $_POST['orgName'];
        $orgEmail = $_POST['orgEmail'];

        $org = new Organisations();
        $create = $org->CreateOrganisation($orgEmail, $orgName);
        if($create)
        {
            $result = $org->getOrgByEmail($_POST['orgEmail']);

            #initialize SeedData
            $seed = new SeedData($result['Id']);

            #seed the superAdmin role and vicar role;
            $seed->seedSuperAdminRoles();
            $seed->seedVicarRole();

            #add superadmin to role
            $seed->seedSuperUser();
            $seed->addSuperUserToRole();

            #add registered user to vicar role
            #build vicar object
            $vicarUser = 
            [
                "firstName" => $_POST['firstName'],
                "lastName" => $_POST['lastName'],
                "passwords" => $_POST['passwords'],
                "username" => $_POST['username'],
                "orgId" => $result['Id'],
            ];

            $addUser2VicarRole = 
            [
                "roleName" => "vicar",
                "users" => $vicarUser['username'],
                "orgId" => $result['Id'],
            ];

            $new_user = new Users();
            $new_user->createUser($vicarUser);

            //assign new users to respective roles
            $assignRole = new UsersInRole();
            $assignRole->addUserToRole($addUser2VicarRole);


            #initialize organisation balance
            $userResult = $new_user->getUserByName($vicarUser['username'], $vicarUser['orgId']);
            //$initialBalance = 0.0;
            $bal = new Balance($userResult['orgId'], $userResult['Id']);
            $bal->initializeBalance();

            //Redirect to login page/.
            header('Location: signin.php');

            //ok when u get home, continue.
        }
    }