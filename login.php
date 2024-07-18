<?php
include('config/con_open.php');

include("class/user-class.php");
session_start();
if (isset($_POST) && !empty($_POST)) {
    $user_obj = new user();
    
     $user_obj->login($_POST);
   
    // include("includes/footer-inc.php");
}

include("includes/login-inc.php");
