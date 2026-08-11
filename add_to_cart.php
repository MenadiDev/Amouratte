<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];

   
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

   
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }

    header("Location: cart.php"); 
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
