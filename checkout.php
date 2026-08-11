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
    <title>Your Cart</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff0f6;
            padding: 20px;
        }
        h2 { color:rgb(111, 40, 78); text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        .btn {
            background-color:rgb(94, 27, 60);
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            font-weight: 600;
        }
        .btn:hover { background-color: #ff1493; }
        #checkout-form {
            max-width: 500px;
            margin: 30px auto 0;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(255, 182, 193, 0.5);
            display: none;
        }
        #checkout-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color:rgb(171, 77, 127);
        }
        #checkout-form input, #checkout-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        #success-message {
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 8px;
            display: none;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body>

<h2>Your Shopping Cart</h2>

<?php if (empty($products)): ?>
    <p style="text-align: center; font-weight: 600;">Your cart is empty.</p>
    <div style="text-align: center;">
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
            <td colspan="3" style="text-align: right;"><strong>Grand Total:</strong></td>
            <td><strong>Rs. <?php echo number_format($grand_total, 2); ?></strong></td>
        </tr>
    </table>
    <div style="text-align: center; margin-top: 10px;">
        <button id="show-checkout" class="btn">Proceed to Checkout</button>
        <a href="index.php" class="btn">Continue Shopping</a>
    </div>

    <form id="checkout-form" method="POST" action="checkout_process.php">
        <h3 style="color:#15040e; text-align:center; margin-bottom: 20px;">Shipping Information</h3>

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" required>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" required>

        <label for="customization">Customization Request (names, messages, preferences):</label>
        <textarea name="customization" id="customization" placeholder="Enter any special requests or details here..." rows="4"></textarea>

        <button type="submit" class="btn" style="display: block;">Place Order</button>
    </form>

    <div id="success-message"></div>

<?php endif; ?>

<script>
    document.getElementById('show-checkout').addEventListener('click', function () {
        document.getElementById('checkout-form').style.display = 'block';
        this.style.display = 'none';
        window.scrollTo({top: document.getElementById('checkout-form').offsetTop, behavior: 'smooth'});
    });
</script>

</body>
</html>
