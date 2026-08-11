<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$id = intval($_GET['id']); 

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Product not found!";
    exit();
}

$product = $result->fetch_assoc();
$stmt->close();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $newImageName = uniqid('img_', true) . '.' . $imageFileType;
        $imagePath = 'uploads/' . $newImageName;

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            
            $stmt = $conn->prepare("UPDATE products SET name=?, category=?, description=?, price=?, image=? WHERE id=?");
            $stmt->bind_param("sss dsi", $name, $category, $description, $price, $newImageName, $id);
        } else {
            echo "<script>alert('Image upload failed! Product not updated.');</script>";
            exit();
        }
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, category=?, description=?, price=? WHERE id=?");
        $stmt->bind_param("sssdi", $name, $category, $description, $price, $id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully!'); window.location='admin_dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating product!');</script>";
    }
    $stmt->close();
}
?>

<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Edit Product - Amouratte</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #fff0f6;
    padding: 20px;
    margin: 0;
  }
  h3 {
    text-align: center;
    color: #4f263cff;
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
    color: #ba4181ff;
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
  img {
    display: block;
    margin: 10px auto 20px;
    border-radius: 12px;
    max-width: 150px;
    height: auto;
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
    background-color: #ff1493;
  }
  .btn.grey {
    background-color: #aaa;
    margin-left: 10px;
  }
  .btn.grey:hover {
    background-color: #888;
  }
  .buttons {
    text-align: center;
  }
</style>
</head>
<body>

<h3>Edit Product</h3>

<form action="edit_product.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">

    <label for="name">Product Name</label>
    <input id="name" type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

    <label for="category">Category</label>
    <input id="category" type="text" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>

    <label for="description">Description</label>
    <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

    <label for="price">Price (Rs.)</label>
    <input id="price" type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>

    <p>Current Image:</p>
    <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">

    <div class="file-upload">
        <label for="image">Change Image </label>
        <input id="image" type="file" name="image" accept="image/*">
    </div>

    <div class="buttons">
        <button type="submit" name="update">Update Product</button>
        <a href="admin_dashboard.php" class="btn grey">Cancel</a>
    </div>

</form>

</body>
</html>
