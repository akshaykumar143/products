<?php
session_start();


if (isset($_POST) && !empty($_POST)) {
    include("includes/header-inc.php");

    include("class/user-class.php");
    $user_obj = new user();
    if(  $user_obj->register($_POST) ){
        header('location:login.php');
    }

    include("includes/register.php");
} else {
    include("includes/register.php");
}
