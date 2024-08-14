-- Adminer 4.8.1 MySQL 11.2.3-MariaDB-1:11.2.3+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `email` varchar(125) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` (`email`, `username`, `password`, `admin_id`) VALUES
('admin@gmail.com',	'admin',	'$2y$10$sz99CUJ0.v83.fx2fAp0a.4clst0/NQsPNnJ0s49XL8zeog0G3DSO',	2);

DROP TABLE IF EXISTS `auction`;
CREATE TABLE `auction` (
  `auction_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `categoryId` varchar(255) NOT NULL,
  `endDate` date NOT NULL,
  `startingBid` varchar(255) NOT NULL,
  `photoPath` blob NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`auction_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `auction` (`auction_id`, `title`, `description`, `categoryId`, `endDate`, `startingBid`, `photoPath`, `user_id`) VALUES
(25,	'mahindra thar',	'The Mahindra Thar is a rugged and iconic off-road vehicle, known for its robust design and exceptional capability in challenging terrain. With its distinctive styling and dependable performance, the Thar appeals to adventure seekers and enthusiasts alike, embodying the spirit of exploration and adventure on and off the road.',	'4x4',	'2024-05-17',	'800007',	'images/thar.jpg',	1),
(26,	'koinseg regera',	'\r\nThe Koenigsegg Regera is a pioneering hypercar renowned for its innovative hybrid powertrain, delivering over 1,500 horsepower through a combination of V8 engine and electric motors. Its revolutionary direct-drive system ensures seamless acceleration, eliminating the need for traditional gears and enhancing performance. With aerodynamic design and luxurious interiors, the Regera offers a blend of speed, craftsmanship, and comfort, setting new standards in the realm of hypercar excellence',	'Hybrid',	'2024-04-26',	'20001',	'images/koinseg.jpg',	7),
(27,	'BMW 5 SERIES',	'\r\nThe BMW 5 Series Estate combines practicality with luxury, offering ample cargo space without compromising on comfort or performance. With sleek styling and advanced technology, it delivers a sophisticated driving experience. Its versatile design makes it ideal for both daily commutes and long journeys, while its range of powerful engines ensures dynamic performance on the road.',	'Estate',	'2024-04-23',	'200000',	'images/bmw 5.jpg',	7),
(28,	'Citroën C5 X',	'\r\nThe Citroën C5 X Estate blends elegant design with versatile functionality, offering ample cargo space and a comfortable ride. Its distinctive styling and innovative features make it stand out in its class, catering to both practical needs and aesthetic preferences. With advanced technology and efficient engines, it provides a smooth and enjoyable driving experience for both city streets and long-distance journeys.',	'Estate',	'2024-03-16',	'50000',	'images/Citroën C5 X.jpg',	7),
(29,	'SUPRA',	'\r\nThe Toyota Supra is an iconic sports car revered for its powerful performance and sleek design. With its turbocharged inline-six engine and rear-wheel drive layout, it delivers thrilling acceleration and handling. Renowned for its agility on the track and its timeless appeal, the Supra continues to captivate enthusiasts worldwide.',	'Sports',	'2024-04-12',	'600000',	'images/supra.jpg',	1),
(30,	'BMW I7',	'The BMW i7 is a flagship electric luxury sedan that epitomizes sustainable mobility and cutting-edge technology. With its spacious interior, advanced infotainment features, and luxurious appointments, it offers a premium driving experience. Equipped with state-of-the-art electric powertrain technology, the i7 delivers impressive performance and range, setting new standards for electric vehicles in the luxury segment.',	'Electric',	'2024-04-05',	'10222',	'images/bmw i7.jpg',	1),
(31,	'Aston Martin DB12',	'The Aston Martin DB12 Coupe, if it exists, would likely represent the pinnacle of British automotive luxury and performance. It would blend the timeless elegance of Aston Martin\'s design language with cutting-edge technology and formidable power. Expect a handcrafted interior adorned with premium materials and state-of-the-art infotainment systems, providing a luxurious driving experience. Under the hood, a potent engine, possibly a V12 or hybrid powertrain, would deliver exhilarating performance befitting the DB lineage, ensuring a thrilling ride on both road and track',	'Coupe',	'2024-04-02',	'12340',	'images/Aston Martin DB12.jpg',	8),
(32,	'Tesla Model S',	'\r\nThe Tesla Model S is a groundbreaking electric sedan known for its sleek design and cutting-edge technology. With instant acceleration and long-range capabilities, it offers an exhilarating driving experience while emitting zero emissions. Its minimalist yet luxurious interior features a large touchscreen interface and advanced autopilot capabilities, setting new standards for automotive innovation. Renowned for its performance, efficiency, and forward-thinking design, the Model S continues to redefine the electric vehicle landscape.',	'Saloon',	'2024-04-06',	'20000',	'images/Tesla Model S.jpg',	8),
(33,	'Tesla Model X',	'The Tesla Model X is an all-electric SUV renowned for its groundbreaking design and cutting-edge technology. With its distinctive falcon-wing doors and spacious interior, it offers versatility and comfort for passengers and cargo alike. Powered by dual electric motors, the Model X delivers impressive acceleration and long-range capability while prioritizing safety with advanced features such as Autopilot. Its combination of performance, innovation, and sustainability makes it a standout in the electric vehicle market.',	'Electric',	'2024-03-28',	'96300',	'images/Tesla Model X.jpg',	8),
(34,	'Land Rover Defender',	'The Land Rover Defender is an iconic off-road vehicle celebrated for its rugged capability and timeless design. Renowned for its go-anywhere attitude, it boasts advanced off-road technology and terrain response systems, ensuring confidence in the most challenging conditions. With its versatile interior and durable construction, it offers both practicality and comfort for adventurers and urban dwellers alike. As a symbol of adventure and exploration, the Defender continues to captivate enthusiasts worldwide with its legendary heritage and unmatched off-road prowess',	'4x4',	'2024-04-02',	'7410',	'images/Land Rover Defender.jpg',	8);

DROP TABLE IF EXISTS `bid`;
CREATE TABLE `bid` (
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_amount` double NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `fk_auction_id` (`auction_id`),
  CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`auction_id`),
  CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_auction_id` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`auction_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `bid` (`auction_id`, `user_id`, `bid_amount`) VALUES
(25,	1,	800005),
(25,	1,	800006),
(25,	1,	800007);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` (`id`, `name`) VALUES
(1,	'Estate'),
(2,	'Electric'),
(3,	'Coupe'),
(4,	'Saloon'),
(5,	'4x4'),
(6,	'Sports'),
(7,	'Hybrid'),
(9,	'users');

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `review` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `auction_id` (`auction_id`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`auction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `email` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`email`, `username`, `password`, `user_id`) VALUES
('sudipsapko@gmail.com',	'sudip sapkota',	'$2y$10$WFH0BMrD/mWrJl2f9S8MTu7QCz5Dco7a021g31ufnvhQYSDUxyfYa',	1),
('user@gmail.com',	'user',	'$2y$10$gALJmbUrSybHuic6UIzyJu.zorq.w0mK1Vv0Ps6gjvkZVvjTEHajW',	7),
('shymtamang@gmail.com',	'shyam',	'$2y$10$BXoO/7/D4S5smzXibQvsC.ozJotvsigancDry5KvnKJo7j7gzk7QK',	8);

-- 2024-03-17 06:55:08