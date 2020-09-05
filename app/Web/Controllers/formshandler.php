<?php

//handle all form submission for family tree and members

if(isset($_POST['oldBranch']))
{
    $_SESSION['familyId'] = $_POST['familyId'];
    header("Location: forms.php");
}

if(isset($_POST['newBranch']))
{
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = $validate->validateForm($value); //striping the user input            
    }

    $data = $family->createTreeBranch($_POST['branchName'], $_SESSION['orgId']);
    $_SESSION['familyId'] = $data['familyId'];
     var_dump($data);
    //echo $_SESSION['familyId'];
    //header("Location: forms.php");
}

if(isset($_POST['submit']))
{
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = $validate->validateForm($value); //striping the user input            
    }

    if($id = $members->addMember($_POST))
    {
        if(strtolower($_POST['maritalStatus']) != 'single' || $_POST['numberOfChildren'] > 0)
        {
            $_SESSION['lastId'] = $id['Id'];
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
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = $validate->validateForm($value); //striping the user input            
    }

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
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = $validate->validateForm($value); //striping the user input            
    }

    $members->updateMember($_POST);
    header('location: allmembers.php');
}

if(isset($_POST['updateChild']))
{
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = $validate->validateForm($value); //striping the user input            
    }
    
    $url = $_POST['callbackURL'];
    echo $url;

    if ($child->updateChild($_POST)) {
        # code...
        header("Location: ../mgt/index.php");
        //header('Location: '.$url);
    }
}

if(isset($_GET['delete']))
{
    $memberId = $_GET['delete'];
    $members->deleteMember($memberId, $_SESSION['orgId']);
}