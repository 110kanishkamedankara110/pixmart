-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.26 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table eshop.admin: ~1 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
REPLACE INTO `admin` (`email`, `verification`, `f_name`, `l_name`) VALUES
	('110kqnishkamedankara110@gmail.com', '6179168a0d9cd', 'kanishka', 'medankara');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping data for table eshop.brand: ~5 rows (approximately)
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
REPLACE INTO `brand` (`id`, `name`) VALUES
	(1, 'apple'),
	(2, 'samsung'),
	(3, 'sony'),
	(4, 'htc'),
	(5, 'nokia');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;

-- Dumping data for table eshop.cart: ~0 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping data for table eshop.category: ~5 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
REPLACE INTO `category` (`id`, `name`) VALUES
	(1, 'Celphones and Accoserories'),
	(2, 'Computer And Tablets'),
	(4, 'Cameras Drons'),
	(5, 'Video Game And Consoles'),
	(7, 'Sound');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping data for table eshop.chat: ~11 rows (approximately)
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- Dumping data for table eshop.city: ~8 rows (approximately)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
REPLACE INTO `city` (`id`, `name`, `postalcode`) VALUES
	(1, 'kandy', '20000'),
	(2, 'Trincomalee', NULL),
	(3, 'Anuradhapura', NULL),
	(4, 'Jaffna', NULL),
	(5, 'Kurunegala', NULL),
	(6, 'Ratnapura', NULL),
	(7, 'Galle', NULL),
	(8, 'Badulla', NULL),
	(9, 'Colombo', NULL);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;

-- Dumping data for table eshop.color: ~5 rows (approximately)
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
REPLACE INTO `color` (`id`, `name`) VALUES
	(1, 'gold'),
	(2, 'Silver'),
	(3, 'Graphite'),
	(4, 'Pacific Blue'),
	(5, 'Rose Gold'),
	(6, 'Jet Black');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;

-- Dumping data for table eshop.condition: ~0 rows (approximately)
/*!40000 ALTER TABLE `condition` DISABLE KEYS */;
REPLACE INTO `condition` (`id`, `condition`) VALUES
	(1, 'brandnew'),
	(2, 'Used');
/*!40000 ALTER TABLE `condition` ENABLE KEYS */;

-- Dumping data for table eshop.district: ~25 rows (approximately)
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
REPLACE INTO `district` (`id`, `name`) VALUES
	(1, 'kandy'),
	(2, 'Ampara'),
	(3, 'Anuradhapura'),
	(4, 'Badulla'),
	(5, 'Batticaloa'),
	(6, 'Colombo'),
	(7, 'Galle'),
	(8, 'Gampaha'),
	(9, 'Hambantota'),
	(10, 'Jaffna'),
	(11, 'Kalutara'),
	(12, 'Kegalle'),
	(13, 'Kilinochchi'),
	(14, 'Kurunegala'),
	(15, 'Mannar'),
	(16, 'Matale'),
	(17, 'Matara'),
	(18, 'Monaragala'),
	(19, 'Mullaitivu'),
	(20, 'Nuwara Eliya'),
	(21, 'Polonnaruwa'),
	(22, 'Puttalam'),
	(23, 'Ratnapura'),
	(25, 'Vavuniya');
/*!40000 ALTER TABLE `district` ENABLE KEYS */;

-- Dumping data for table eshop.feedback: ~0 rows (approximately)
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Dumping data for table eshop.gender: ~2 rows (approximately)
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
REPLACE INTO `gender` (`id`, `name`) VALUES
	(1, 'Male'),
	(2, 'Female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;

-- Dumping data for table eshop.images: ~9 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping data for table eshop.invoice: ~9 rows (approximately)
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;

-- Dumping data for table eshop.location: ~9 rows (approximately)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
REPLACE INTO `location` (`id`, `city_id`, `province_id`, `district_id`) VALUES
	(1, 1, 1, 1),
	(2, 2, 2, 25),
	(3, 3, 3, 3),
	(4, 4, 4, 10),
	(5, 5, 4, 15),
	(6, 6, 6, 23),
	(7, 7, 7, 7),
	(8, 8, 8, 4),
	(9, 9, 9, 6);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;

-- Dumping data for table eshop.model: ~7 rows (approximately)
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
REPLACE INTO `model` (`id`, `name`) VALUES
	(1, 'iphone x'),
	(2, 'iphone 5'),
	(3, 'xperia x'),
	(4, 'xpeira xz'),
	(5, 'galaxy note 8'),
	(6, 'c'),
	(7, 'm8');
/*!40000 ALTER TABLE `model` ENABLE KEYS */;

-- Dumping data for table eshop.model_has_brand: ~5 rows (approximately)
/*!40000 ALTER TABLE `model_has_brand` DISABLE KEYS */;
REPLACE INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 4, 7),
	(4, 5, 6),
	(5, 3, 4),
	(6, 3, 3),
	(7, 2, 5);
/*!40000 ALTER TABLE `model_has_brand` ENABLE KEYS */;

-- Dumping data for table eshop.product: ~9 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping data for table eshop.province: ~8 rows (approximately)
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
REPLACE INTO `province` (`id`, `name`) VALUES
	(1, 'central'),
	(2, 'Eastern'),
	(3, 'North Central'),
	(4, 'Northern'),
	(5, 'North Western'),
	(6, 'Sabaragamuwa	'),
	(7, ' Southern'),
	(8, 'Uva'),
	(9, 'Western');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;

-- Dumping data for table eshop.recent: ~0 rows (approximately)
/*!40000 ALTER TABLE `recent` DISABLE KEYS */;
/*!40000 ALTER TABLE `recent` ENABLE KEYS */;

-- Dumping data for table eshop.status: ~2 rows (approximately)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
REPLACE INTO `status` (`id`, `name`) VALUES
	(1, 'active'),
	(2, 'deactive');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping data for table eshop.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`email`, `first_name`, `last_name`, `password`, `mobile`, `register_date`, `status`, `gender_id`, `verification_code`, `image`) VALUES
	('110kqnishkamedankara110@gmail.com', 'Kanishka', 'Medankara', '123456789', '0705715007', '2021-10-05 19:40:51', 1, 1, '6170e773378f1', 'userprofileimg//615fedf90616ebeach_nature_14-wallpaper-3000x2000.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping data for table eshop.user_has_address: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_has_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_has_address` ENABLE KEYS */;

-- Dumping data for table eshop.watchlist: ~0 rows (approximately)
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `watchlist` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
