-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2018 at 04:51 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpha`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked_user`
--

CREATE TABLE `blocked_user` (
  `id` int(11) NOT NULL,
  `blocked_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cancel_service_token`
--

CREATE TABLE `cancel_service_token` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1=service, 2=Bid',
  `user_comment_id` int(11) NOT NULL,
  `reply_comment_id` int(11) DEFAULT NULL,
  `reply` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=not reply, 1= reply',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_token`
--

CREATE TABLE `email_token` (
  `email_token_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_token` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=token not used, 2=token used'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_token`
--

INSERT INTO `email_token` (`email_token_id`, `user_id`, `email_token`, `created`, `status`) VALUES
(2, 2, '4491', '2018-01-13 18:34:38', '1'),
(5, 6, '7685', '2018-01-13 18:47:36', '1'),
(6, 7, '8858', '2018-01-14 14:59:17', '1'),
(7, 8, '6599', '2018-01-14 15:10:08', '1'),
(8, 9, '9242', '2018-01-14 17:11:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_token`
--

CREATE TABLE `mobile_token` (
  `token_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile_token` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=token not used, 2=token used'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mobile_token`
--

INSERT INTO `mobile_token` (`token_id`, `user_id`, `mobile_token`, `created`, `status`) VALUES
(2, 2, '6429', '2018-01-13 18:34:38', '1'),
(5, 6, '4946', '2018-01-13 18:47:36', '1'),
(6, 7, '6371', '2018-01-14 14:59:17', '1'),
(7, 8, '3375', '2018-01-14 15:10:08', '1'),
(8, 9, '8486', '2018-01-14 17:11:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '0=notification not send,1=notification send',
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `place_bids`
--

CREATE TABLE `place_bids` (
  `bid_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_amount` float NOT NULL,
  `delivery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qualification` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=Disable,1=Enable',
  `bid_accept` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Bid placed,1=Bid Accepted',
  `token` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `user_rated` int(11) NOT NULL COMMENT 'User who done rating',
  `user_id` int(11) NOT NULL COMMENT 'User who got rating',
  `rating` int(4) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(8) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `name`, `description`, `created`, `updated`) VALUES
(1, 'Super Admin', 'Dedicated to admin panel work', '2017-12-27 08:00:00', '2017-12-28 04:39:05'),
(2, 'Service Requester', 'Add Service request from mobile application', NULL, '2017-12-28 04:39:05'),
(3, 'Service Provider', 'Give service to the service provider', NULL, '2017-12-28 04:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `service_attachment`
--

CREATE TABLE `service_attachment` (
  `attachment_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `attachment_name` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_notification`
--

CREATE TABLE `service_notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_types` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE `service_request` (
  `service_request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `service_types` int(11) NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `delivery` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skills` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attachment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=enable, 2=disable',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_request`
--

INSERT INTO `service_request` (`service_request_id`, `user_id`, `title`, `description`, `service_types`, `expiry_date`, `delivery`, `skills`, `attachment`, `status`, `created`, `updated`) VALUES
(3, 1, 'test', 'sdfds', 1, '2017-12-28 00:00:00', '2017-12-31 00:00:00', 'rrrr', '', '1', '2017-12-28 04:43:53', '2017-12-28 04:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `type_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`type_id`, `name`, `description`, `created`, `updated`) VALUES
(1, 'test', 'wer', NULL, '2017-12-28 04:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `spam_comment`
--

CREATE TABLE `spam_comment` (
  `spam_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('1','2') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1=Male, 2=Female',
  `user_token` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mobile token id',
  `email_id` text COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `iqama_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `user_status` enum('1','2') COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '1=Logout, 2=Login',
  `comercial_registration` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Disable,1=Enable',
  `email_token_verify` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Token not verify,1=Token verify',
  `phone_token_verify` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Token not verify,1=Token verify',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `role_id`, `username`, `gender`, `user_token`, `email_id`, `phone_no`, `iqama_id`, `address`, `user_status`, `comercial_registration`, `password`, `country`, `city`, `status`, `email_token_verify`, `phone_token_verify`, `created`, `updated`) VALUES
(1, 2, 'vikash', '1', 'jdsjfkjsd fsahfkjsndf snksd sdc smobile token', 'vikash@gmail.com', '98766463734', '236874533', 'test ihi swr\'xw\'e cr\'ew xew\r\n frewr;h ewew; h', '1', '3334', '$2y$11$b1Kblxw5UH6xojHn09z9HONcs/IYpzegWhxjsK3vx61eWeeSwdAves', NULL, NULL, '0', '0', '0', '2017-12-27 08:00:00', '2018-01-03 06:27:43'),
(2, 2, 'test', NULL, 'cyDS5uzfJus:APA91bGaTJfNlFtsfjPG_zuYfG--PdD4Fdp20IPVToCmrTmgFEfxPaQONGqiDVnZKRHeIdSebuxXt9KBqXgGwLEtbVwrsz2LrUvUJO1ILDE6L8WVngp_xJsNT0lwV_YATjFONjLSsAIj', 'test@gmail.com', '9876543675', NULL, NULL, '1', NULL, '$2y$11$4Hvowz73VhdnmVDfLxsSFe9YY.eV/o5wYmh5vbjdQau.XLxpbtTGW', NULL, NULL, '0', '0', '0', '2018-01-13 18:34:38', '2018-01-13 09:34:38'),
(6, 2, 'tere', NULL, 'dzeNRo1iuPc:APA91bGmf4whmHKyDSmwgIDVFwr_Ga7TXzu881SOTJj_jmlRvy08A8tREmDXZviHqStE8F1Aa8fWkvS42LJOQjeIIacIi2iuNyYmTXU9nJaGqy-gC7pEQDu1MXPJPb9xV9AvaRVYxikQ', 'vkeshri.14@gmail.com', '3456789234', NULL, NULL, '1', NULL, '$2y$11$X8KN1CPh8oVX/IyGE5GRfOybhDs4gZM7DPSP9psts230qzRO6RfYC', NULL, NULL, '0', '0', '0', '2018-01-13 18:47:36', '2018-01-13 09:47:36'),
(7, 2, 'test', NULL, 'dbmmLw4kgIs:APA91bGbgPQAgkYMHRC7eS99Tu7r6KI61ndJ_QTx3FojPOknS26kGkoPeMwKAqWtEzZRI5QuU3iHGFZEt5L3OujIZ4R6_7cqAcfxgOJYyU2yfuANhQEJogQiyFHqKS03wuS4xbminyYi', 'test@gmail.com', '7654876598', NULL, NULL, '1', NULL, '$2y$11$vQoOW5FVtqmRRxZZ/o/sW.YXwuk4OQTTn1WMLwc4Gk.3K/Zw8BoUi', NULL, NULL, '0', '0', '0', '2018-01-14 14:59:17', '2018-01-14 05:59:18'),
(8, 2, 'test', NULL, 'c6UGOjrYwNQ:APA91bFpavg5rNcWN4VXeqQwEXC4R7-a8IC0T9azOy86x3ldvM1EHE1h3MOHRdh4B9_1o1emGD9h02ejetEoOxQLMrD4VWOBeGGG_LuGUAEahNDvuAWqowIy8TAGIv0t_bw1UA4EGNNl', 'test@gmail.com', '876543644', NULL, NULL, '1', NULL, '$2y$11$sKC2neA1arlFxkdB9xyc3e.TYyuPzCe9Gm0oc5ES9MmXh24ISLszW', NULL, NULL, '0', '0', '0', '2018-01-14 15:10:08', '2018-01-14 06:10:08'),
(9, 2, 'test', NULL, 'ea65Telb7dk:APA91bGD4UpSZpnHBL19QoAr_3wW1iJ-ZEeBq_lYC8TfAXzeFE0mg1z61o6wRNT7MpGwCMKydIozJbR9ekxi0m0MSJ4Th5dvmGWmft6cTBHa1MRinsvLd6iZXhRUTQ-kvBEBpb6FP7Xe', 'test@gmail.com', '96784319433', NULL, NULL, '1', NULL, '$2y$11$EAHJWoLjHx5jgow81fPayuxo4fuXa6dWCglOmwQ1WxOliEIbL7S3G', NULL, NULL, '0', '0', '0', '2018-01-14 17:11:26', '2018-01-14 08:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_certification`
--

CREATE TABLE `user_certification` (
  `certification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `certification` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_qualification`
--

CREATE TABLE `user_qualification` (
  `qualification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qualification` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `watchlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked_user`
--
ALTER TABLE `blocked_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blocked_id` (`blocked_id`);

--
-- Indexes for table `cancel_service_token`
--
ALTER TABLE `cancel_service_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `service_id` (`post_id`),
  ADD KEY `user_comment_id` (`user_comment_id`),
  ADD KEY `reply_comment_id` (`reply_comment_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `email_token`
--
ALTER TABLE `email_token`
  ADD PRIMARY KEY (`email_token_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mobile_token`
--
ALTER TABLE `mobile_token`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `place_bids`
--
ALTER TABLE `place_bids`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_rated` (`user_rated`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `service_attachment`
--
ALTER TABLE `service_attachment`
  ADD PRIMARY KEY (`attachment_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service_notification`
--
ALTER TABLE `service_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `service_request`
--
ALTER TABLE `service_request`
  ADD PRIMARY KEY (`service_request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_types` (`service_types`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `spam_comment`
--
ALTER TABLE `spam_comment`
  ADD PRIMARY KEY (`spam_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `city` (`city`),
  ADD KEY `country` (`country`);

--
-- Indexes for table `user_certification`
--
ALTER TABLE `user_certification`
  ADD PRIMARY KEY (`certification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_qualification`
--
ALTER TABLE `user_qualification`
  ADD PRIMARY KEY (`qualification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watchlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocked_user`
--
ALTER TABLE `blocked_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cancel_service_token`
--
ALTER TABLE `cancel_service_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_token`
--
ALTER TABLE `email_token`
  MODIFY `email_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mobile_token`
--
ALTER TABLE `mobile_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place_bids`
--
ALTER TABLE `place_bids`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_attachment`
--
ALTER TABLE `service_attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_notification`
--
ALTER TABLE `service_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_request`
--
ALTER TABLE `service_request`
  MODIFY `service_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spam_comment`
--
ALTER TABLE `spam_comment`
  MODIFY `spam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_certification`
--
ALTER TABLE `user_certification`
  MODIFY `certification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_qualification`
--
ALTER TABLE `user_qualification`
  MODIFY `qualification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watchlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocked_user`
--
ALTER TABLE `blocked_user`
  ADD CONSTRAINT `blocked_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `blocked_user_ibfk_2` FOREIGN KEY (`blocked_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_comment_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`reply_comment_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `email_token`
--
ALTER TABLE `email_token`
  ADD CONSTRAINT `email_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `mobile_token`
--
ALTER TABLE `mobile_token`
  ADD CONSTRAINT `mobile_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `place_bids`
--
ALTER TABLE `place_bids`
  ADD CONSTRAINT `place_bids_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service_request` (`service_request_id`),
  ADD CONSTRAINT `place_bids_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `service_attachment`
--
ALTER TABLE `service_attachment`
  ADD CONSTRAINT `service_attachment_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service_request` (`service_request_id`);

--
-- Constraints for table `service_notification`
--
ALTER TABLE `service_notification`
  ADD CONSTRAINT `service_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `service_request`
--
ALTER TABLE `service_request`
  ADD CONSTRAINT `service_request_ibfk_1` FOREIGN KEY (`service_types`) REFERENCES `service_types` (`type_id`),
  ADD CONSTRAINT `service_request_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `spam_comment`
--
ALTER TABLE `spam_comment`
  ADD CONSTRAINT `spam_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`city`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`country`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `user_certification`
--
ALTER TABLE `user_certification`
  ADD CONSTRAINT `user_certification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_qualification`
--
ALTER TABLE `user_qualification`
  ADD CONSTRAINT `user_qualification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
