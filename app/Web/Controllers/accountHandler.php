<?php

if(isset($_POST['signin']))
{
    if($result = $account->signin($_POST))
    {
        //check if user is suspended
        //echo $result['isActive'];
       if( $result['isActive'])
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
        echo "<script>alert('Invalid Login Details')</script>";
    }
}

if(isset($_GET['logout']))
{
    $account->signout();
}

if($account->loggedIn())
{
    //header('location: '); //redirect to dashboard
}