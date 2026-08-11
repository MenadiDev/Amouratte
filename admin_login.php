<?php
session_start();
include 'db.php';


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $result = $conn->query("SELECT * FROM admins WHERE username='$username'");

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        
        if ($password == $admin['password']) {
            $_SESSION['admin'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect Password'); window.location='admin_login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('User not found'); window.location='admin_login.php';</script>";
        exit();
    }
}
?>

<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Login - Amouratte</title>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #fff0f6;
    padding: 20px;
    margin: 0;
  }
  h3 {
    text-align: center;
    color:rgb(113, 36, 78);
    margin-bottom: 30px;
  }
  form {
    max-width: 400px;
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
    color:rgb(202, 107, 158);
  }
  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    box-sizing: border-box;
  }
  button {
    width: 100%;
    background-color:rgb(250, 95, 172);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color:rgb(255, 152, 207);
  }
</style>

</head>
<body>

<h3>Admin Login - Amouratte</h3>
<form action="admin_login.php" method="POST">

  <label for="username">Username</label>
  <input id="username" type="text" name="username" required>

  <label for="password">Password</label>
  <input id="password" type="password" name="password" required>

  <button type="submit" name="login">Login</button>

</form>

</body>
</html>
