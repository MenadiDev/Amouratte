<?php
session_start();
include 'db.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];
$products = [];

if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");

    while ($row = $result->fetch_assoc()) {
        $row['quantity'] = $cart[$row['id']];
        $products[] = $row;
    }
}
?>

<html>
<head>
    <title>Your Cart - Amouratte</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff0f6;
            padding: 20px;
            margin: 0;
        }

        h2 {
            color:rgb(116, 22, 72);
            text-align: center;
            margin-bottom: 30px;
        }

        .cart-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(255, 182, 193, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #f0c4d1;
            text-align: center;
        }

        th {
            background-color:rgb(245, 133, 189);
            color: white;
            font-weight: 600;
        }

        td {
            font-size: 1rem;
            color: #555;
        }

        .btn {
            background-color:rgb(185, 88, 136);
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 10px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #ff1493;
        }

        .empty-cart {
            text-align: center;
            font-weight: 600;
            color: #777;
            padding: 50px 0;
        }

        .actions {
            text-align: center;
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            th, td {
                padding: 10px;
                font-size: 0.9rem;
            }

            .btn {
                padding: 10px 16px;
                margin: 8px;
            }
        }
    </style>
</head>
<body>

<h2>Your Shopping Cart</h2>

<div class="cart-container">
    <?php if (empty($products)): ?>
        <div class="empty-cart">
            <p>Your cart is empty.</p>
            <a href="index.php" class="btn">Continue Shopping</a>
        </div>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php $grand_total = 0; ?>
            <?php foreach ($products as $product): ?>
                <?php $total = $product['price'] * $product['quantity']; ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td>Rs. <?php echo number_format($product['price'], 2); ?></td>
                    <td>Rs. <?php echo number_format($total, 2); ?></td>
                </tr>
                <?php $grand_total += $total; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: right; font-weight: 600;">Grand Total:</td>
                <td style="font-weight: 600;">Rs. <?php echo number_format($grand_total, 2); ?></td>
            </tr>
        </table>

        <div class="actions">
            <a href="clear_cart.php" class="btn" >Clear Cart</a>
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
            <a href="index.php" class="btn">Continue Shopping</a>
            
        </div>
    <?php endif; ?>
</div>

</body>
</html>
