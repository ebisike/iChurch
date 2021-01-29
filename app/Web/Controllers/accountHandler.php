<?php

if(isset($_POST['signin']))
{
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = $validate->validateForm($value); //striping the user input            
    }
    
    if($account->verifyOrganisation($_POST))
    {
        //check if user is suspended
        //echo $result['isActive'];
        $user = $account->signin($_POST);
        if($user)
        {
            header('location: public/mgt/index.php'); //redirect to dashboard            
        }
        else
        {
            echo "<script>alert('account suspended')</script>";
        }
    }
    else
    {
        $admin = "<a maito='georgefx.creativecompany@gmail.com'>Admin</a>";
        echo '<script>alert("Sorry Account Suspened. Please contact the '.$admin.' for more info")</script>';
    }
}
if(isset($_GET['logout']))
{
    $account->signout();
}

if($account->loggedIn())
{
   // header('location: /ichurch/app/public/mgt/index.php'); //redirect to dashboard
}else{
    //header('location: /ichurch/index.html');
}