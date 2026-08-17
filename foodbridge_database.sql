-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2026 at 08:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodbridge_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

DROP TABLE IF EXISTS `donation`;
CREATE TABLE `donation` (
  `Donation_ID` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `collected_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`Donation_ID`, `request_id`, `status`, `collected_at`, `completed_at`) VALUES
(1, 1, 'Completed', '2026-07-29 01:47:56', '2026-07-29 01:47:56'),
(2, 2, 'Completed', '2026-07-24 18:15:00', '2026-07-24 18:15:00'),
(3, 3, 'Completed', '2026-07-29 01:47:58', '2026-07-29 01:47:58'),
(4, 6, 'Completed', '2026-08-01 23:26:34', '2026-08-01 23:26:34'),
(5, 9, 'Completed', '2026-07-30 00:07:08', '2026-07-30 00:07:08'),
(6, 14, 'Completed', '2026-07-31 16:21:36', '2026-07-31 16:21:36'),
(8, 4, 'Completed', '2026-08-13 05:47:47', '2026-08-13 05:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `food_deletion_history`
--

DROP TABLE IF EXISTS `food_deletion_history`;
CREATE TABLE `food_deletion_history` (
  `deletion_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `food_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_deletion_history`
--

INSERT INTO `food_deletion_history` (`deletion_id`, `listing_id`, `donor_id`, `food_name`, `quantity`, `deleted_at`) VALUES
(1, 16, 13, 'Chicken Biryani', 9, '2026-08-16 04:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `food_listing`
--

DROP TABLE IF EXISTS `food_listing`;
CREATE TABLE `food_listing` (
  `listing_ID` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `Food_Name` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `location` varchar(200) NOT NULL,
  `expiry_time` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_listing`
--

INSERT INTO `food_listing` (`listing_ID`, `donor_id`, `Food_Name`, `description`, `quantity`, `unit`, `location`, `expiry_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chicken Biryani', 'Freshly cooked biryani', 45, 'plates', 'Dhanmondi, Dhaka', '2026-07-24 22:00:00', 'Completed', '2026-07-24 17:00:00', '2026-08-16 03:46:10'),
(2, 1, 'Vegetable Curry', 'Mixed vegetable curry', 20, 'packs', 'Dhanmondi, Dhaka', '2026-07-24 21:30:00', 'Completed', '2026-07-24 16:30:00', '2026-07-24 18:15:00'),
(3, 2, 'Bread', 'Fresh bakery bread', 40, 'packs', 'Banani, Dhaka', '2026-07-25 08:00:00', 'Completed', '2026-07-24 15:00:00', '2026-07-24 15:00:00'),
(4, 2, 'Fruit Juice', 'Mixed fruit juice bottles', 25, 'bottles', 'Banani, Dhaka', '2026-07-24 23:30:00', 'Completed', '2026-07-24 14:00:00', '2026-07-24 20:00:00'),
(5, 1, 'Rice and Beef', 'Cooked rice with beef', 30, 'plates', 'Dhanmondi, Dhaka', '2026-07-24 22:30:00', 'Completed', '2026-07-24 13:00:00', '2026-07-24 21:00:00'),
(8, 1, 'kacchi', 'plz!', 20, 'Plates', 'Dhanmondi, Dhaka', '2026-07-30 19:40:00', 'Completed', '2026-07-30 03:37:43', NULL),
(9, 9, 'xpresso', 'Fresh', 4, 'Cups', 'uttara,sec12', '2026-07-31 17:00:00', 'Requested', '2026-07-31 11:56:39', NULL),
(11, 2, 'Pasta', 'Fresh', 3, 'Packs', 'uttara,sec4', '2026-07-31 16:10:00', 'Expired', '2026-07-31 16:09:35', NULL),
(12, 2, 'Pasta', 'Come', 5, 'Packs', 'uttara,sec4', '2026-07-31 21:30:00', 'Completed', '2026-07-31 16:20:06', NULL),
(13, 2, 'Fruits', 'Hi', 10, 'Kg', 'uttara,sec4', '2026-08-03 15:20:00', 'Expired', '2026-08-01 23:16:23', NULL),
(14, 5, 'Biriyani ', '', 4, 'Plates', 'uttara,sec4', '2026-08-03 16:50:00', 'Expired', '2026-08-02 00:46:14', NULL),
(15, 13, 'Chicken Biryani', 'Fresh!', 6, 'Packs', 'Dhanmondi, Dhaka', '2026-08-16 18:30:00', 'Available', '2026-08-16 01:05:37', '2026-08-16 03:54:58');

--
-- Triggers `food_listing`
--
DROP TRIGGER IF EXISTS `after_deleting_food`;
DELIMITER $$
CREATE TRIGGER `after_deleting_food` AFTER DELETE ON `food_listing` FOR EACH ROW BEGIN
    INSERT INTO FOOD_DELETION_HISTORY
    (
        listing_id,
        donor_id,
        food_name,
        quantity,
        deleted_at
    )
    VALUES
    (
        OLD.listing_ID,
        OLD.donor_id,
        OLD.food_name,
        OLD.quantity,
        NOW()
    );
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_deleteting_listed_food`;
DELIMITER $$
CREATE TRIGGER `before_deleteting_listed_food` BEFORE DELETE ON `food_listing` FOR EACH ROW BEGIN

    IF EXISTS (
        SELECT 1
        FROM REQUEST
        WHERE listing_id = OLD.listing_ID
        AND request_status = 'Completed'
    ) THEN

        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT =
        'Cannot delete this food listing because this request has been completed.';

    ELSEIF OLD.expiry_time > NOW()
       AND EXISTS (
           SELECT 1
           FROM REQUEST
           WHERE listing_id = OLD.listing_ID
           AND request_status IN ('Pending', 'Approved')
       )
    THEN

        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT =
        'Cannot delete this food listing because it has an active request.';

    END IF;

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_updating_completed_listing`;
DELIMITER $$
CREATE TRIGGER `before_updating_completed_listing` BEFORE UPDATE ON `food_listing` FOR EACH ROW BEGIN

    IF OLD.status = 'Completed'
       AND EXISTS (
           SELECT 1
           FROM REQUEST
           WHERE listing_id = OLD.listing_ID
           AND request_status = 'Completed'
       )
    THEN

        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT =
        'Cannot update this food listing because its request has been completed.';

    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `Request_ID` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `Requested_Quantity` int(11) NOT NULL,
  `request_status` varchar(30) NOT NULL,
  `requested_at` datetime NOT NULL,
  `responded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`Request_ID`, `listing_id`, `requester_id`, `Requested_Quantity`, `request_status`, `requested_at`, `responded_at`) VALUES
(1, 1, 3, 20, 'Completed', '2026-07-24 17:30:00', '2026-07-29 01:47:56'),
(2, 2, 4, 10, 'Completed', '2026-07-24 18:00:00', '2026-07-24 18:15:00'),
(3, 3, 3, 15, 'Completed', '2026-07-24 18:30:00', '2026-07-29 01:47:58'),
(4, 4, 4, 15, 'Completed', '2026-07-24 19:00:00', '2026-07-24 19:20:00'),
(5, 5, 3, 25, 'Approved', '2026-07-24 20:00:00', '2026-07-24 20:15:00'),
(6, 1, 1, 4, 'Completed', '2026-07-28 01:26:28', '2026-08-01 23:26:34'),
(7, 1, 1, 5, 'Rejected', '2026-07-28 01:27:42', '2026-08-16 03:13:46'),
(8, 1, 1, 5, 'Rejected', '2026-07-28 01:28:54', '2026-07-29 01:54:33'),
(9, 8, 4, 5, 'Completed', '2026-07-29 23:39:18', '2026-07-30 00:07:08'),
(13, 9, 8, 1, 'Approved', '2026-07-31 15:52:09', '2026-08-16 06:40:22'),
(14, 12, 8, 2, 'Completed', '2026-07-31 16:20:55', '2026-07-31 16:21:36'),
(15, 13, 8, 10, 'Rejected', '2026-08-02 00:30:05', '2026-08-16 04:24:44'),
(16, 13, 11, 10, 'Rejected', '2026-08-02 00:31:14', '2026-08-16 04:25:01'),
(17, 15, 11, 3, 'Rejected', '2026-08-16 01:06:51', '2026-08-16 04:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(8) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `password`, `phone`, `role`, `address`, `created_at`) VALUES
(1, 'Green Garden Restaurant', 'greengarden@gmail.com', 'pass123', '01711111111', 'Donor', 'Dhanmondi, Dhaka', '2026-07-20 09:00:00'),
(2, 'Fresh Bite Cafeteria', 'freshbite@gmail.com', 'pass456', '01822222222', 'Donor', 'Banani, Dhaka', '2026-07-20 10:15:00'),
(3, 'Helping Hands NGO', 'helpinghands@gmail.com', 'ngo12345', '01933333333', 'NGO', 'Mirpur, Dhaka', '2026-07-20 11:30:00'),
(4, 'Hope Foundation', 'hopefoundation@gmail.com', 'hope2026', '01644444444', 'Recipient', 'Uttara, Dhaka', '2026-07-20 12:00:00'),
(5, 'AdminUser', 'admin@foodbridge.com', 'admin123', '01555555555', 'Admin', 'NSU Campus, Bashundhara', '2026-07-20 08:30:00'),
(7, 'Abdullah', 'abd019@gmail.com', '123456@a', '01999999999', 'NGO', 'Dhaka, Bangladesh', '2026-07-26 16:26:49'),
(8, 'acc', 'ps@gmail.com', '090924@@', '01965432347', 'Recipient', 'Dhaka, Bangladesh', '2026-07-31 11:14:09'),
(9, 'Cafe X', 'xcafe@gmail.com', 'xcafe01@', '01700000000', 'Donor', 'Uttara', '2026-07-31 11:52:19'),
(10, 'jam', 'jam@gmail.com', '123123@@', '01700000001', 'NGO', 'Dhaka, Bangladesh', '2026-07-31 17:08:42'),
(11, 'Qalu', 'qaluuu@gmail.com', '09oish@!', '01700111001', 'Recipient', 'Dhaka, Bangladesh', '2026-08-02 00:13:24'),
(12, 'polatok', 'polatok@gmail.com', '019977@@', '01997765444', 'Recipient', 'Dhaka, Bangladesh', '2026-08-10 03:40:25'),
(13, 'Ahmad Sifat', 'ahmadsifat@gmail.com', '101010@!', '01111111111', 'Admin', 'Bashundhara, Dhaka', '2026-08-13 03:34:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`Donation_ID`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `food_deletion_history`
--
ALTER TABLE `food_deletion_history`
  ADD PRIMARY KEY (`deletion_id`);

--
-- Indexes for table `food_listing`
--
ALTER TABLE `food_listing`
  ADD PRIMARY KEY (`listing_ID`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `listing_id` (`listing_id`),
  ADD KEY `requester_id` (`requester_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `Donation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food_deletion_history`
--
ALTER TABLE `food_deletion_history`
  MODIFY `deletion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_listing`
--
ALTER TABLE `food_listing`
  MODIFY `listing_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `request` (`Request_ID`);

--
-- Constraints for table `food_listing`
--
ALTER TABLE `food_listing`
  ADD CONSTRAINT `food_listing_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`listing_id`) REFERENCES `food_listing` (`listing_ID`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`requester_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
