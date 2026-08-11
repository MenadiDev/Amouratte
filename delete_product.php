<?php
session_start();
include 'db.php';


if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}


if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No product ID specified.";
}

$conn->close();
?>
