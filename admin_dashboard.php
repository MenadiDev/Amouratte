<?php
session_start();
include 'db.php';


if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}


$result = $conn->query("SELECT * FROM products");
?>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color:rgb(252, 218, 232);
    padding: 20px;
    margin: 0;
  }
  h2 {
    text-align: center;
    color:rgb(100, 36, 70);
    margin-bottom: 20px;
  }
  a.btn {
    display: inline-block;
    padding: 10px 16px;
    margin: 5px 10px 20px 0;
    background-color:rgb(142, 191, 255);
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }
  a.btn.red {
    background-color:rgb(14, 46, 81);
  }
  a.btn:hover {
    background-color:rgb(245, 175, 212);
  }
  a.btn.red:hover {
    background-color:rgb(139, 187, 255);
  }
  a.btn-small {
    padding: 6px 10px;
    font-size: 0.85rem;
    border-radius: 6px;
  }
  a.btn-small.blue {
    background-color:rgb(172, 217, 255);
  }
  a.btn-small.blue:hover {
    background-color:rgb(108, 164, 210);
  }
  a.btn-small.red {
    background-color:rgb(251, 158, 207);
  }
  a.btn-small.red:hover {
    background-color: #ab000d;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(255, 182, 193, 0.5);
  }
  thead tr {
    background-color: #ffb6c1;
  }
  thead th {
    padding: 12px 15px;
    text-align: left;
    color: #800040;
  }
  tbody tr:nth-child(even) {
    background-color: #fff0f6;
  }
  tbody td {
    padding: 12px 15px;
    border-bottom: 1px solid #ffcce6;
  }
</style>

</head>
<body>

<h2>Admin Dashboard - Amouratte𐙚</h2>
<a href="add_product.php" class="btn">Add New Product</a>
<a href="logout.php" class="btn red">Logout</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Category</th>
            <th>Price (Rs.)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><?php echo number_format($row['price'], 2); ?></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn-small blue">Edit</a>
                    <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn-small red" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
