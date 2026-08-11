<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM products WHERE id=$id");
if ($result->num_rows != 1) {
    echo "Product not found!";
    exit();
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Purchase Successful</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff0f6;
            margin: 0;
            padding: 40px 20px;
            color: #333;
            text-align: center;
        }
        h3 {
            color: #ff1493;
            font-weight: 700;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #555;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            transition: background-color 0.3s ease;
            user-select: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Thank you for your purchase! 🎁</h3>
    <p>You have successfully purchased <strong><?php echo htmlspecialchars($product['name']); ?></strong>.</p>

    <a href="index.php" class="btn">Back to Home</a>
</div>

</body>
</html>

