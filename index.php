<?php
session_start();
 
include('config/con_open.php');

include("class/user-class.php");

if (empty($_SESSION['uid'])) {
    header('location:login.php');
}

include('includes/header-inc.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $Page = 'home';
}

switch ($page) {
    case 'home':
        include('includes/home-inc.php');
        break;

    case 'register':
        die("Server Error");
        break;
    case 'product':
        
        $product = new Products();

        if (isset($_POST) && !empty($_POST)) {
            if( empty($_POST['id']) ){
                $product->save($_POST);
            }else{
                $product->update($_POST);
            }
        }

        include('includes/product-inc.php');
        break;

    default:
        include('includes/home-inc.php');
}
include('includes/footer-inc.php');
