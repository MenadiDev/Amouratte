<?php
session_start();

if (!isset($_SESSION['thank_you_shown']) || !$_SESSION['thank_you_shown']) {
    header("Location: index.php");
    exit();
}


$name = $_SESSION['thank_you_name'] ?? 'Valued Customer';


unset($_SESSION['thank_you_name']);
unset($_SESSION['thank_you_shown']);
unset($_SESSION['last_order_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You - Amouratte</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff0f6;
            color: #333;
            text-align: center;
            padding: 50px 20px;
        }

        .thank-you-container {
            background: #fff;
            padding: 40px;
            max-width: 500px;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(255, 182, 193, 0.5);
        }

        h1 {
            color:rgb(138, 39, 102);
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn {
            background-color:rgb(250, 126, 188);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #ff1493;
        }
    </style>
</head>
<body>

<div class="thank-you-container">
    <h1>Thank You, <?php echo htmlspecialchars($name); ?>!💗</h1>
    <p>Your order has been placed successfully. We’ll get started on your gift right away!</p>
    <a href="index.php" class="btn">Back to Home</a>
</div>

</body>
</html>
