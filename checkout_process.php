<?php
session_start();
include 'db.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$fullname = $_POST['fullname'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';
$customization = $_POST['customization'] ?? '';


if (empty($fullname) || empty($address) || empty($phone)) {
    echo "All fields are required.";
    exit();
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "Your cart is empty.";
    exit();
}

$total_amount = 0;


$ids = implode(',', array_keys($cart));
$result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");

while ($row = $result->fetch_assoc()) {
    $total_amount += $row['price'] * $cart[$row['id']];
}

$stmt = $conn->prepare("INSERT INTO orders (customer_id, fullname, address, phone, customization, total_amount) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssd", $customer_id, $fullname, $address, $phone, $customization, $total_amount);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();


unset($_SESSION['cart']);

$_SESSION['thank_you_name'] = $fullname;
$_SESSION['thank_you_shown'] = true;
$_SESSION['last_order_id'] = $order_id;

header("Location: thank_you.php");
exit();
?>
