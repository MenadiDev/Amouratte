<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Registration - Amouratte</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff0f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .register-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(255, 182, 193, 0.5);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color:rgb(113, 34, 76);
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color:rgb(184, 107, 148);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        button:hover {
            background-color: #ff1493;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color:rgb(169, 67, 118);
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            .register-container {
                padding: 20px;
            }

            button {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Customer Registration</h2>
    <form action="customer_register_process.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>

    <div class="back-link">
        <a href="index.php">Back to Home</a>
    </div>
</div>

</body>
</html>
