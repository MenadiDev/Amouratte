<?php
session_start();
include 'db.php';


$category = isset($_GET['category']) ? $_GET['category'] : 'All';
$search = isset($_GET['search']) ? $_GET['search'] : '';


$category_result = $conn->query("SELECT DISTINCT category FROM products");


if ($category == 'All' && empty($search)) {
    $query = "SELECT * FROM products";
    $stmt = $conn->prepare($query);
} elseif ($category != 'All' && empty($search)) {
    $query = "SELECT * FROM products WHERE category = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $category);
} elseif ($category == 'All' && !empty($search)) {
    $query = "SELECT * FROM products WHERE name LIKE ?";
    $stmt = $conn->prepare($query);
    $search_param = "%$search%";
    $stmt->bind_param("s", $search_param);
} else {
    $query = "SELECT * FROM products WHERE category = ? AND name LIKE ?";
    $stmt = $conn->prepare($query);
    $search_param = "%$search%";
    $stmt->bind_param("ss", $category, $search_param);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Amouratte - Home</title>

<style>
    * {
        box-sizing: border-box;
    }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff0f6;
        margin: 0;
        padding: 20px;
        color: #333;
    }
    header {
        position: sticky;
        top: 0; 
        z-index: 1000;
        background-color: rgb(226, 119, 172);
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 4px 10px rgba(255, 182, 193, 0.5);
    }


        header h1 {
            color: white;
            font-family: 'Pacifico', cursive;
            font-size: 2rem;
            margin: 0;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-weight: 600;
            margin-left: 20px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #ff1493;
        }

        nav span {
            color: white;
            font-weight: 600;
            margin-right: 20px;
        }

        /* Responsive tweaks */
        @media (max-width: 600px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            nav {
                display: flex;
                flex-wrap: wrap;
                margin-top: 10px;
            }

            nav a {
                margin: 5px 10px 0 0;
            }
    }
    form.search-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 30px;
        justify-content: center;
    }
    form.search-filter input[type="text"],
    form.search-filter select {
        padding: 10px;
        font-size: 1rem;
        border: 2px solid #ffb6c1;
        border-radius: 6px;
        min-width: 200px;
    }
    form.search-filter button {
        background-color:rgb(198, 77, 138);
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 1rem;
        cursor: pointer;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }
    form.search-filter button:hover {
        background-color:rgb(255, 171, 216);
    }
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }
    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(255, 182, 193, 0.4);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(255, 105, 180, 0.7);
    }
    .card img {
        border-radius: 12px 12px 0 0;
        height: 200px;
        width: 100%;
        object-fit: cover;
    }
    .card-content {
        padding: 15px 20px;
        flex-grow: 1;
    }
    .card-title {
        font-weight: 700;
        color:rgb(123, 50, 89);
        margin: 0 0 10px 0;
        font-size: 1.3rem;
    }
    .product-description {
        color: #555;
        font-size: 0.95rem;
        margin-bottom: 15px;
        min-height: 60px;
    }
    .product-info {
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    .card-action {
        padding: 15px 20px;
        border-top: 1px solid #f0c4d1;
        text-align: right;
    }
    .btn {
        background-color: #ff69b4;
        color: white;
        border: none;
        padding: 10px 18px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 1rem;
        display: inline-block;
    }
    .btn:hover {
        background-color: #ff1493;
    }
    footer {
        margin-top: 50px;
        padding: 20px;
        text-align: center;
        background-color: #ff69b4;
        color: white;
        border-radius: 8px;
        font-weight: 600;
    }
    footer a:hover {
    color: #ffd1dc;
    transition: color 0.3s ease;
    }

    @media (max-width: 480px) {
        form.search-filter {
            flex-direction: column;
            align-items: stretch;
        }
        form.search-filter input[type="text"],
        form.search-filter select,
        form.search-filter button {
            width: 100%;
            min-width: unset;
        }
        .card img {
            height: 180px;
        }
    }
    .banner {
    width: 100%;
    height: 800px;
    overflow: hidden;
    margin-bottom: 30px;
    margin-top: 30px;

    }

    .banner-img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 10px;
    }

nav {
    display: flex;
    gap: 15px;
    align-items: center;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
}

.dropdown-content a {
    color: black;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ffb6c1;
    color: white;
}

.dropdown:hover .dropdown-content {
    display: block;
}


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<header>
    <h1>Amouratte𐙚</h1>
    <nav>
    <?php if (isset($_SESSION['customer_id'])): ?>
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['customer_username']); ?>!</span>
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="index.php">Home</a>
        <a href="customer_login.php">Login</a>
        <a href="customer_register.php">Register</a>
    <?php endif; ?>

    <div class="dropdown">
        <a href="#">Categories ▼</a>
        <div class="dropdown-content">
            <?php
            $category_result = $conn->query("SELECT DISTINCT category FROM products");
            while ($cat = $category_result->fetch_assoc()):
            ?>
                <a href="index.php?category=<?php echo urlencode($cat['category']); ?>">
                    <?php echo htmlspecialchars($cat['category']); ?>
                </a>
            <?php endwhile; ?>
        </div>
    </div>

    <a href="contact.php">Contact Us</a>
</nav>

</header>
<div class="banner">
    <img src="uploads/Hero banner.png" alt="Amouratte Banner" class="banner-img">
</div>


<h2 style="text-align:center; color:#a03076; margin-bottom:40px;">Personalize your Gifts</h2>

<form method="GET" action="index.php" class="search-filter">
    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search products..." />

    <select name="category" onchange="this.form.submit()">
        <option value="All" <?php if ($category == 'All') echo 'selected'; ?>>All Categories</option>
        <?php while ($cat = $category_result->fetch_assoc()): ?>
            <option value="<?php echo htmlspecialchars($cat['category']); ?>" <?php if ($category == $cat['category']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($cat['category']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Search</button>
</form>

<div class="products-grid">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" />
                <div class="card-content">
                    <div class="card-title"><?php echo htmlspecialchars($row['name']); ?></div>
                    <div class="product-info"><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></div>
                    <div class="product-info"><strong>Price:</strong> Rs. <?php echo number_format($row['price'], 2); ?></div>
                </div>
                <div class="card-action">
                    <a href="view_product.php?id=<?php echo $row['id']; ?>" class="btn">View</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center; font-weight:600;">No products found.</p>
    <?php endif; ?>
</div>

<footer style="margin-top: 50px; padding: 20px; text-align: center; background-color:rgb(232, 138, 185); color: white; border-radius: 8px; font-weight: 600;">
    © 2025 Amouratte - All rights reserved
    <div style="margin-top: 10px; font-size: 1.5rem;">
        <a href="https://www.instagram.com/amouratte.1?igsh=YXFoMzR0c2ZrMmth" target="_blank" style="margin: 0 10px; color: white; text-decoration: none;">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.facebook.com/share/16W1HUWfDW/" target="_blank" style="margin: 0 10px; color: white; text-decoration: none;">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="http://tiktok.com/@thizz..amouratted" target="_blank" style="margin: 0 10px; color: white; text-decoration: none;">
            <i class="fab fa-tiktok"></i>
        </a>
        <a href="https://x.com/amourattedirect" target="_blank" style="margin: 0 10px; color: white; text-decoration: none;">
            <i class="fab fa-x-twitter"></i>
        </a>
    </div>
</footer>


</body>
</html>
