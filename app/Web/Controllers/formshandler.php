<?php

//handle all form submission for family tree and members

if(isset($_POST['oldBranch']))
{
    $_SESSION['familyId'] = $_POST['familyId'];
    header("Location: forms.php");
}

if(isset($_POST['newBranch']))
{
    $_SESSION['familyID'] = $family->generateFamilyID($_POST['branchName']);
    header("Location: form.php");
}

if(isset($_POST['submit']))
{
    if($id = $members->addMember($_POST))
    {
        if(strtolower($_POST['maritalStatus']) != 'single' || $_POST['numberOfChildren'] > 0)
        {
            $_SESSION['lastId'] = $id;
            header('location: childform.php');
        }
        else
        {
            header('location: ../mgt/index.php');
        }        
    }

}

if(isset($_POST['addChild']))
{
    if($child->addChild($_POST))
    {
        if(isset($_POST['new_child']))
        {
            header('location: childform.php');
        }else{
            header('location: ../mgt/index.php');
        }
    }
}

if(isset($_POST['updateMember']))
{
    $members->updateMember($_POST);
    header('loaction: allmembers.php');
}

if(isset($_POST['updateChild']))
{
    $url = $_POST['callbackURL'];

    if ($child->updateChild($_POST)) {
        # code...
        header("Location: ../mgt/index.php");
    }
}