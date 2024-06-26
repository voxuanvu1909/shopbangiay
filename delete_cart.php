<?php
    session_start();
    $cart=$_SESSION['cart_items'];
    $id=$_GET['id'];
    function isID($var){
        return $var["pro_id"] != $_GET['id'];
    }
    if($id >= 0){
        $arr = $_SESSION['cart_items'];
        $_SESSION['cart_items'] = array_filter($arr, "isID");
    }
    header("location: shopping_cart.php");
    exit();
?>