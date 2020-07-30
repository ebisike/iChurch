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
    //echo 'hit <br>';
    $d = $members->addMember($_POST);
    //$x = $members->getAllMembers($_SESSION['orgId']);
    var_dump($d);
    //echo $d;
}