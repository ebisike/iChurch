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
        if($_POST['maritalStatus'] != 'Single' || $_POST['numberOfChildren'] > 0)
        {
            //echo $id['Id'];
            $x=$id->getResults(); echo $x['Id'];
            //header('location: childform.php');
        }
        header('location: ../mgt/index.php');
    }

}