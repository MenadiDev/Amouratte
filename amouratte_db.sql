-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2025 at 05:55 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amouratte_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'admin2', 'admin456');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`) VALUES
(1, 'customer1', '$2y$10$QVRRhnNffDin376HyXeICer7/olqK5bikDh2nuuhAmb0r/YygmDsC'),
(3, 'dulhari', '$2y$10$8ftflg1TmEXMlskJRL7tC.XkDWGwlzCtmRV2B4f9396qQ6hOSk6z.'),
(4, 'Kaushi', '$2y$10$EKPJUsBb0HzjLE.wMDrctua6RIY/53JJWdOstS4doaRht71rF.kXy'),
(5, 'Customer', '$2y$10$x9QVRroyJK5YXrDDWQtv2uukVIUYZ0P/JZX7aj0DiWEGgkONqvLee');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Rory Fernando', 'Leanororo@gmail.com', 'Hi, I love the gift collections on your site! I’m especially interested in the brownie boxes and wanted to ask if you offer handwritten notes inside the package. Also, how long does delivery usually take within Colombo? Thanks!\r\n', '2025-08-23 17:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `customization` text,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `fullname`, `address`, `phone`, `customization`, `total_amount`, `order_date`) VALUES
(1, 3, 'customer', 'abcdefghu', '12345500', 'name should be rory', 1000.00, '2025-07-08 11:14:14'),
(2, 3, 'customer', 'vtukl', '12345500', 'io', 5800.00, '2025-07-11 17:06:36'),
(3, 3, 'kaushiyaa', 'aswrfeythrgyir', '0740688055', '-', 13000.00, '2025-07-22 11:04:49'),
(4, 3, 'customer', 'abc street ,usa', '12345500', '', 10000.00, '2025-08-02 15:52:59'),
(5, 4, 'customer', 'abcdssss', '12345500', 'no request', 2900.00, '2025-08-10 22:22:17'),
(6, 5, 'customer', 'abcd', '12345500', 'no', 1000.00, '2025-08-22 22:36:52'),
(7, 5, 'customer', 'abc street , USA', '0710759970', 'NAME-Rory', 1000.00, '2025-08-22 22:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `price`, `image`) VALUES
(1, 'Birthday Gift Box', 'Celebrate life’s special moments with our thoughtfully curated Birthday Gift Box. Each box is filled with handpicked treasures designed to bring smiles, warmth, and a sprinkle of joy to the birthday star. Whether it’s delicious treats, cozy keepsakes, or personalized goodies, this gift box is the perfect way to show how much you care.', 'Gift Box', 2000.00, '56cbd6f1c2ba9c26d63ce3f31453bc57.jpg'),
(2, 'Valentine Special Box', 'Celebrate love in the most heartfelt way with our Valentine’s Special Box, thoughtfully curated to make your sweetheart’s day unforgettable. This box is filled with exquisite treats and romantic surprises that speak the language of love — from sweet indulgences to meaningful keepsakes, each item is chosen to create moments of joy and connection. Elegantly packaged to express your deepest feelings, the Valentine’s Special Box is the perfect gift to say “I love you” in style.', 'Gift Box', 3200.00, 'bfe28d447961ee9d56d77287c35936df.jpg'),
(3, 'Personalized Mug', 'Start every day with a smile and a mug that’s as special as you are. Our Personalized Mug lets you add your own touch — a name, a meaningful quote, a special date, or a fun design — making every sip feel personal and memorable. Perfect for coffee lovers, tea enthusiasts, or anyone who enjoys their favorite drink in style!', 'Customized Gifts', 1000.00, 'cf39d16d6fc3a74230bb98ad09f17d95.jpg'),
(4, 'Handmade Bracelet', 'Looking for a thoughtful gift that truly shows you care? Our Handmade Bracelets are crafted with love and attention to detail, making them a meaningful present for someone special. Each bracelet tells its own story through unique designs and natural materials — a beautiful symbol of friendship, love, or appreciation.', 'Accessories', 800.00, 'bracelets.jpg'),
(5, 'Personalized Tumbler', 'Make every sip special with our Personalized Tumbler, designed just for you or your loved ones. Whether it’s your name, a favorite quote, or a custom design, this tumbler is the perfect blend of style and practicality. Ideal for hot coffee, iced drinks, or smoothies on the go, it’s a thoughtful gift that adds a personal touch to everyday moments. Surprise someone special (or yourself!) with a tumbler that’s practical, stylish, and uniquely theirs. Sip in Style, Your Way ✨', 'Customized Gifts', 2000.00, 'tumbler.png'),
(6, ' For Him ❤︎', 'Looking for the perfect gift to make him feel special? Our Gift Box for Him is carefully curated with handpicked items that combine style, comfort, and a personal touch. Whether it’s for his birthday, anniversary, Valentine’s Day, or just to show you care, this box is designed to bring a genuine smile to his face. Make him feel appreciated with a box that’s as unique and special as he is.', 'Gift Box', 3900.00, 'giftforhim.jpg'),
(7, 'For her ❤︎', 'Surprise the special woman in your life with our beautifully curated Gift Box for Her. Whether it’s for her birthday, anniversary, Valentine’s Day, or just because, this box is filled with handpicked treasures that radiate love, care, and joy. From self-care treats to stylish accessories, every item is chosen to make her feel cherished. Give her a box full of love, appreciation, and a little sparkle — because she deserves it.', 'Gift Box', 3900.00, 'giftforher.jpg'),
(8, 'Mama\'s Special ❀', 'Show your love and gratitude with our beautifully curated Gift Box for Mom, designed to make her feel truly special. Whether it’s for her birthday, Mother’s Day, or just to say \"thank you,\" this box is filled with thoughtful items that bring comfort, joy, and a smile to her face.', 'Gift Box', 2900.00, 'giftformom.jpg'),
(9, 'Dad\'s Special! (deluxe ver.)', 'A Premium Gift for Your Everyday Hero 🖤\r\n\r\nCelebrate the man who’s always been there with our Deluxe Gift Box for Dad, specially curated to offer both luxury and love. Perfect for Father’s Day, birthdays, or simply to show your appreciation, this box is filled with high-quality, thoughtful items he’ll truly enjoy — because your dad deserves the very best. It is more than just a gift — it’s a grand gesture of love and appreciation.', 'Gift Box', 40000.00, 'giftfordad.jpg'),
(10, 'Paper Charm ☘︎ ', 'Unbox creativity and charm with PaperCharm, our beautifully curated stationery gift box designed for those who love to write, plan, and create. Whether it’s for journaling, note-taking, or simply adding a stylish touch to their desk, this box is filled with handpicked stationery essentials that inspire and delight.', 'Gift Box', 2500.00, 'stationary.jpg'),
(11, 'Grad special 🎓', 'Celebrate a proud achievement with our specially curated Graduation Gift Box designed to honor hard work, new beginnings, and exciting futures. This box is filled with meaningful keepsakes, beautiful goodies and flowers that inspire, motivate, and make the graduate feel truly celebrated.', 'Gift Box', 2900.00, 'graduation.jpg'),
(12, 'ChocoLuxe 🍫', 'ChocoLuxe ✨  – Because happiness comes in chocolate.\r\nIndulge in pure bliss with ChocoLuxe, our decadent Chocolate Gift Box crafted for true chocolate lovers. Perfect for birthdays, anniversaries, Valentine’s Day, or simply to brighten someone’s day, this box is packed with rich, velvety treats that melt hearts and bring instant joy.', 'Gift Box', 3000.00, 'chocogift.jpg'),
(13, 'Personalized Necklace', 'Carry a special name, date, or message close to your heart with our Personalized Necklace. Thoughtfully crafted to make each piece truly one-of-a-kind, this necklace is the perfect keepsake for celebrating love, friendship, or unforgettable moments. It is a simple yet meaningful way to say, \"This is just for you!\"', 'Customized Gifts', 600.00, 'customnecklace.jpg'),
(14, 'Couple T-shirts ', 'Celebrate your perfect match with our Couple T-Shirts, designed for duos who love to show off their connection in style. Whether it’s for anniversaries, photoshoots, Valentine’s Day, or just casual twinning, these comfy and adorable tees are the ultimate way to say, \"We belong together.\" ❤︎', 'Couple\'s Collection', 5000.00, 'coupletshirt.jpg'),
(15, 'Couple Hoodies', 'Show off your perfect bond with our Couple Hoodies, designed for lovebirds who love to match in comfort and style. Whether you’re out on a chilly date, lounging at home, or capturing memories in a cute photoshoot, these hoodies are the ultimate symbol of togetherness.❤︎', 'Couple\'s Collection', 5500.00, 'couplehoddie.jpg'),
(16, 'Couple Bracelets', 'Celebrate your special bond with our Couple Bracelets, a beautiful symbol of love, connection, and togetherness. Whether you’re near or far, these matching bracelets are a daily reminder that you’re always linked by heart.❤︎', 'Couple\'s Collection', 500.00, 'cpuplebracelet.jpg'),
(17, 'Couple Mugs', 'Start your mornings with love and laughter with our adorable Couple Mugs. Perfect for cozy coffee dates, breakfast in bed, or simply sharing your favorite drinks, these matching mugs are a cute way to celebrate your special connection every day.❤︎', 'Couple\'s Collection', 2000.00, 'couplemug.jpg'),
(18, 'GlamGlow Set ✨ (Special)', 'Unbox beauty, confidence, and a little sparkle with our GlamGlow Makeup Gift Box – Special Edition. Perfect for makeup lovers, beauty beginners, or anyone who deserves to feel radiant, this carefully curated box is filled with high-quality essentials to create stunning everyday or glam looks.', 'Girl\'s Collection', 10000.00, 'glamgirlset.jpg'),
(19, 'Glow & Bloom 🌸 ', 'Treat her to glowing skin and peaceful self-care moments with our Glow & Bloom Skincare Gift Box, specially curated for girls who love to feel fresh, confident, and beautifully cared for. Perfect for beginners or skincare enthusiasts, this box is a bundle of gentle, skin-loving essentials made to pamper.', 'Girl\'s Collection', 9000.00, 'cleangirl.jpg'),
(20, 'Blush Bites 🤎', 'Our rich, fudgy brownies just got more personal! Each box comes with a delicious brownie slab topped with colorful sprinkles and edible letters that let you customize your own message. Whether it’s “Happy Birthday,” “Thank You,” or a sweet inside joke, these brownie boxes turn dessert into a heartfelt gift.\r\n\r\nBeautifully packed and made to order, they’re the perfect way to add a personal touch to birthdays, anniversaries, surprises, or just to brighten someone’s day.', 'Confectionery Collection', 2500.00, 'brownie.jpg'),
(21, 'Amour Macarons 💝', 'Delicate, colorful, and irresistibly sweet — our Amour Macarons brings you a handpicked selection of French-style macarons that you can customize, crafted to perfection. Each bite is crisp on the outside and luxuriously soft within, offering a medley of flavors that feel as dreamy as they look.\r\n\r\nPackaged in an elegant gift box, these macarons are more than a treat — they’re a gesture of love, celebration, and charm. Perfect for birthdays, anniversaries, or simply to make someone’s day sweeter.', 'Confectionery Collection', 2600.00, 'macaron.jpg'),
(22, 'Sweetheart Sanrio Set 🫧', 'Bring a touch of cuteness and nostalgia to your gift box with our Sweetheart Sanrio Set. Featuring adorable Sanrio characters in miniature figurine form, this set is perfect for collectors, pastel lovers, or anyone who can’t resist a little dose of kawaii charm.\r\n\r\nEach figurine is crafted with fine detail, making it a playful yet aesthetic keepsake. Whether displayed on a desk, shelf, or tucked into your Amouratte gift box, these Sanrio darlings are guaranteed to spread smiles and sweetness.', 'Girl\'s Collection', 2500.00, 'sanrio.jpg'),
(23, 'Twirl & Charm 🎀', 'A delightful set of scrunchies, clips, and ribbons in soft pastel shades, designed to make every hairstyle effortlessly cute. Whether it’s a casual day out or a special occasion, Twirl & Charm adds a playful, stylish touch while being perfect for gifting to someone special—or treating yourself.', 'Accessories', 1000.00, 'hairclip.jpg'),
(27, 'Crumble Couture 🍪', 'Indulge in the delightful world of Crumble Couture, a beautifully curated box of cookies baked to perfection. Each cookie is a little masterpiece—crispy edges, soft centers, and flavors that bring warmth and joy with every bite with customized designs as you wish. Ideal for gifting someone special, sharing with friends, or treating yourself to a moment of sweet bliss.', 'Confectionery Collection', 1500.00, 'cookies.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
