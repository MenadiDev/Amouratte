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

<html>
<head>
    <meta charset="UTF-8" />
    <title><?php echo htmlspecialchars($product['name']); ?> - Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff0f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        a {
            text-decoration: none;
        }
        .container {
            max-width: 950px;
            height: 500px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            color:rgb(150, 67, 111);
            margin-bottom: 40px;
            font-weight: 700;
        }
        .product-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(255, 182, 193, 0.4);
            padding: 20px;
        }
        .product-image {
            flex: 1 1 300px;
            max-width: 400px;
            border-radius: 12px;
            overflow: hidden;
        }
        .product-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
        }
        .product-info {
            flex: 1 1 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-info h4 {
            margin: 0 0 10px 0;
            color:rgb(218, 101, 159);
            font-weight: 600;
        }
        .product-info p {
            font-size: 1rem;
            line-height: 1.5;
            color: #555;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            border: none;
            color: white;
            transition: background-color 0.3s ease;
            margin-right: 15px;
            user-select: none;
        }
        .btn-green {
            background-color: #28a745;
        }
        .btn-green:hover {
            background-color: #218838;
        }
        .btn-grey {
            background-color: #6c757d;
        }
        .btn-grey:hover {
            background-color: #5a6268;
        }

        @media (max-width: 700px) {
            .product-detail {
                flex-direction: column;
                padding: 15px;
            }
            .product-image, .product-info {
                max-width: 100%;
                flex: 1 1 100%;
            }
            .product-image img {
                height: auto;
                max-height: 350px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <h2><?php echo htmlspecialchars($product['name']); ?></h2>

    <div class="product-detail">
        <div class="product-image">
            <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="product-info">
            <div>
                <h4>Category: <?php echo htmlspecialchars($product['category']); ?></h4>
                <h4>Price: Rs. <?php echo number_format($product['price'], 2); ?></h4>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
            </div>
            <div>
                <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-green">Add to Cart</a>
                <a href="purchase.php?id=<?php echo $product['id']; ?>" class="btn btn-green">Purchase</a>
                <a href="index.php" class="btn btn-grey">Go back</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
