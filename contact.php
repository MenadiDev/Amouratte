<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Amouratte</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff0f6;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;     
            min-height: 100vh;
        }

        .contact-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(255, 182, 193, 0.5);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;             
            flex-grow: 1;                
        }

        h2 {
            text-align: center;
            color: rgb(99, 38, 71);
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: rgb(172, 75, 127);
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            width: 100%;
            background-color: rgb(118, 42, 80);
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
            background-color: rgb(255, 180, 220);
        }

        @media (max-width: 500px) {
            .contact-container {
                padding: 20px;
            }

            button {
                padding: 10px;
            }
        }

        footer {
            margin-top: 40px;
            padding: 20px;
            text-align: center;
            background-color: rgb(232, 138, 185);
            color: white;
            border-radius: 8px;
            font-weight: 600;
        }

        footer div a {
            margin: 0 10px;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
        footer div a:hover {
            color: #ff1493;
        }
        .contact-info {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 50px;
    padding: 40px 20px;
}

.contact-card {
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 50%;
    padding: 30px;
    width: 180px;
    height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

.contact-icon img {
    margin-bottom: 10px;
}

.contact-card h4 {
    margin: 10px 0 5px 0;
    font-size: 1.2rem;
}

.contact-card p a {
    color: #555;
    text-decoration: none;
}

.contact-card p a:hover {
    text-decoration: underline;
}

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="contact-container">
    <h2>Contact Us</h2>

    <form action="contact_process.php" method="POST">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Your Message:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>
<section class="contact-info">
    <div class="contact-card">
        <div class="contact-icon">
            <img src="uploads/free-mail-icon-142-thumb.png" alt="Contact Email" width="50" height="50">
        </div>
        <h4>Contact Email</h4>
        <p><a href="mailto:amourattedirect@gmail.com">amourattedirect@gmail.com</a></p>
    </div>

    <div class="contact-card">
        <div class="contact-icon">
            <img src="uploads/phone-icon.png " alt="Phone Number" width="50" height="50">
        </div>
        <h4>Phone Number</h4>
        <p>+94 123456789</p>
    </div>
</section>

<footer>
    © 2025 Amouratte - All rights reserved
    <div>
        <a href="https://www.instagram.com/amouratte.1?igsh=YXFoMzR0c2ZrMmth" target="_blank" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.facebook.com/share/16W1HUWfDW/" target="_blank" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="http://tiktok.com/@thizz..amouratted" target="_blank" aria-label="TikTok">
            <i class="fab fa-tiktok"></i>
        </a>
        <a href="https://x.com/amourattedirect" target="_blank" aria-label="Twitter">
            <i class="fab fa-x-twitter"></i>
        </a>
    </div>
</footer>

</body>
</html>
