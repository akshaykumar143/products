<?php
session_start();
 
include('config/con_open.php');

include("class/user-class.php");

if (empty($_SESSION['uid'])) {
  die();
}
 
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $Page = 'home';
}
$data=[];
switch ($page) {
    case 'product-view':
        $product = new Products();
        if (isset($_POST) && !empty($_POST)) {
            $data =  $product->getById($_POST);
        }
        break;
        case 'product-delete':
            $product = new Products();
            if (isset($_POST) && !empty($_POST)) {
                $data =  $product->delete($_POST);
            }
            break;
    default:
} 
echo json_encode($data);