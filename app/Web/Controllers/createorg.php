<?php

    $validate = new InputValidation();
    if(isset($_POST['register']))
    {
        $orgName = $validate->validateForm( $_POST['orgName']);
        $orgName = $_POST['orgName'];
        //$orgEmail = $validate->validateForm($_POST['orgEmail']);
        $orgEmail = $_POST['orgEmail'];

        $org = new Organisations();
        $create = $org->CreateOrganisation($orgEmail, $orgName);
        if($create)
        {
            $result = $org->getOrgByEmail($orgEmail);

            //var_dump($result['OrgEmail']); exit();
            #initialize SeedData
            $seed = new SeedData($result['Id'], $result['OrgEmail']);

            #add registered user to vicar role
            #build vicar object
            $leadPastor = 
            [
                "firstName" => $_POST['firstName'],
                "lastName" => $_POST['lastName'],
                "passwords" => $_POST['passwords'],
                "username" => $_POST['username'],
                "orgId" => $result['Id'],
            ];

            $addUser2VicarRole = 
            [
                "roleName" => "lead_pastor",
                "users" => $leadPastor['username'],
                "orgId" => $result['Id'],
            ];

            $new_user = new Users();
            if($new_user->createUser($leadPastor))
            {
                #seed the superAdmin role and vicar role;
                $seed->seedSuperAdminRoles();
                $seed->seedLeadPastorRole();
                $seed->seedRegularRole();
                $seed->seedAsstPastorRole();
                $seed->seedChurchSecRole();

                //assign new users to respective roles
                $assignRole = new UsersInRole();
                $assignRole->addUserToRole($addUser2VicarRole);

                #add superadmin to role
                $seed->seedSuperUser();
                $seed->addSuperUserToRole();


                #initialize organisation balance
                $userResult = $new_user->getUserByName($leadPastor['username'], $leadPastor['orgId']);
                //$initialBalance = 0.0;
                $bal = new Balance($userResult['orgId'], $userResult['Id']);
                $bal->initializeBalance();

                //Redirect to login page/.
                header('Location: signin.php');
            }
            else
            {
                echo "sorry username is taken";
            }

            //ok when u get home, continue.
        }
    }