<?php

ob_start();
session_start();

require 'DB.php';
require 'InputValidation.php';
include 'Config.php';
include 'Organisations.php';
include 'Roles.php';
include 'UsersInRole.php';
include 'Users.php';
include 'AccountController.php';
include 'FamilyTree.php';
include 'Members.php';
include 'Children.php';
include 'Notifications.php';

$db = new DB();
$validate = new InputValidation();
$config = new Config();
$org = new Organisations();
$role = new Roles();
$userInRole = new UsersInRole();
$user = new Users();
$account = new AccountController();
$family = new FamilyTree();
$members = new Members();
$child = new Children();
$notify = new Notifications();

//$org->CreateOrganisation();
//$x = $org->getOrgName(1);
//echo $x;
