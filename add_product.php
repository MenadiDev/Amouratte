<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}


if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $uploadDir = 'uploads/';

    
    $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $newImageName = uniqid('img_', true) . '.' . $imageFileType;
    $imagePath = $uploadDir . $newImageName;

    if (move_uploaded_file($imageTmpName, $imagePath)) {
        
        $stmt = $conn->prepare("INSERT INTO products (name, category, description, price, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $name, $category, $description, $price, $newImageName);

        if ($stmt->execute()) {
            echo "<script>alert('Product added successfully!'); window.location='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Error adding product!');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Image upload failed!');</script>";
    }
}
?>

<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Add Product - Amouratte</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #fff0f6;
    padding: 20px;
    margin: 0;
  }
  h3 {
    text-align: center;
    color: #45172fff;
    margin-bottom: 30px;
  }
  form {
    max-width: 600px;
    margin: 0 auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(255, 182, 193, 0.5);
  }
  label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #aa5582ff;
  }
  input[type="text"],
  input[type="number"],
  textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    box-sizing: border-box;
    resize: vertical;
  }
  textarea {
    min-height: 100px;
  }
  .file-upload {
    margin-bottom: 20px;
  }
  .file-upload input[type="file"] {
    display: block;
    margin-top: 8px;
  }
  button, .btn {
    background-color: #ff69b4;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button:hover, .btn:hover {
    background-color: #ef9fc9ff;
  }
  .btn.grey {
    background-color: #aaa;
    margin-left: 10px;
    text-decoration: none;
    display: inline-block;
    
  }
  .buttons {
    text-align: center;
  }
</style>
</head>
<body>

<h3>Add New Product</h3>

<form action="add_product.php" method="POST" enctype="multipart/form-data">

  <label for="name">Product Name</label>
  <input id="name" type="text" name="name" required>

  <label for="category">Category</label>
  <input id="category" type="text" name="category" required>

  <label for="description">Description</label>
  <textarea id="description" name="description" required></textarea>

  <label for="price">Price (Rs.)</label>
  <input id="price" type="number" step="0.01" name="price" required>

  <div class="file-upload">
    <label for="image">Upload Image</label>
    <input id="image" type="file" name="image" required accept="image/*">
  </div>

  <div class="buttons">
    <button type="submit" name="add">Add Product</button>
    <a href="admin_dashboard.php" class="btn grey">Back</a>
  </div>

</form>

</body>
</html>
