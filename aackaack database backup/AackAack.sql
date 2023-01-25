-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2016 at 12:29 PM
-- Server version: 5.5.46-0ubuntu0.12.04.2
-- PHP Version: 5.3.10-1ubuntu3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `AackAack`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aacks`
--

CREATE TABLE IF NOT EXISTS `tbl_aacks` (
  `aack_id` int(200) NOT NULL AUTO_INCREMENT,
  `userid` int(200) NOT NULL,
  `conversation_with` varchar(11) CHARACTER SET latin1 NOT NULL,
  `lastmessage` varchar(1000) NOT NULL,
  `aack_content` varchar(200) CHARACTER SET latin1 NOT NULL,
  `thumbnail` varchar(100) CHARACTER SET latin1 NOT NULL,
  `aack_caption` varchar(1000) NOT NULL,
  `conversation_from` varchar(200) NOT NULL,
  `screen_look` int(2) NOT NULL,
  `sharedto` int(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'if 0 not shared, if 1 shared',
  `devicedatetime` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aack_id`),
  KEY `aack_id` (`aack_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=181 ;

--
-- Dumping data for table `tbl_aacks`
--

INSERT INTO `tbl_aacks` (`aack_id`, `userid`, `conversation_with`, `lastmessage`, `aack_content`, `thumbnail`, `aack_caption`, `conversation_from`, `screen_look`, `sharedto`, `status`, `devicedatetime`, `created_date`) VALUES
(1, 2, '9496409353', '895', '20160626045006.png', '20160626045007.png', 'First aack from my LG', 'The 🎃 Head', 3, 1, 1, '2016-06-25 21:50:03', '2016-06-26 04:50:09'),
(2, 2, '9493752663', 'https://aackaack.s3.amazonaws.com/2/c2a06e88-9399-4ddf-8fb4-058fd1ed7aa8_20160515122412_6_9493752663.png', '20160626045958.png', '20160626045958.png', 'What can happen now with this ?🌺', 'MyClosest 🐤', 2, 2, 1, '2016-06-25 21:59:26', '2016-06-26 05:00:40'),
(3, 2, '7609547455', 'Just some long text with some emoji guys. =<d<D And then there was even more than the community and we can go back to the town. =', '20160626050435.png', '20160626050435.png', '', '', 0, 0, 0, '2016-06-25 22:04:17', '2016-06-26 05:04:35'),
(4, 2, '9493947538', 'https://aackaack.s3.amazonaws.com/2/3e606664-a67f-49fc-b2fd-da67eadcc221_20160625093204_4_9493947538.png', '20160626051002.png', '20160626051002.png', 'This is really a FAV', 'My FAV 🐙', 3, 6, 1, '2016-06-25 22:09:53', '2016-06-26 05:10:11'),
(5, 4, '9496409353', '2489', '20160626060209.png', '20160626060209.png', 'My first S4 aack ', 'My Bestie', 2, 1, 1, '2016-06-25 23:02:07', '2016-06-26 06:02:17'),
(6, 5, '9493947538', '8952', '20160626060449.png', '20160626060449.png', 'First as K from my HTC M9', 'MyOnly🎅', 3, 1, 1, '2016-06-25 23:04:47', '2016-06-26 06:04:52'),
(7, 4, '9496409353', 'Ok then', '20160626061444.png', '20160626061444.png', 'This is a tener for sure yo', 'Big10Time', 2, 1, 1, '2016-06-25 23:14:40', '2016-06-26 06:15:22'),
(8, 5, '9493947538', 'So it goes =	', '20160626062209.png', '20160626062209.png', 'This is working with full be up!!!', 'Woo-hoo 11', 3, 1, 1, '2016-06-25 23:22:05', '2016-06-26 06:22:19'),
(9, 4, '7142669297', 'https://aackaack.s3.amazonaws.com/4/b276c1d1-2108-4227-8b73-fa1e8d1b23d8_20150124061221_7_7142669297.png', '20160626071005.png', '20160626071005.png', 'Twelve screens for the time is the best future of everything', 'InThe12Pines', 2, 2, 1, '2016-06-26 00:10:01', '2016-06-26 07:11:06'),
(10, 4, '9493752663', 'Text me pic with descriptive caption ', '20160627044234.png', '20160627044234.png', 'Aack for Facebook and twitter', 'FacebookTwitt', 2, 1, 1, '2016-06-26 21:42:30', '2016-06-27 04:50:13'),
(11, 2, '9496409353', 'Ok then', '20160627050005.png', '20160627050005.png', 'TextOnly12 Facebook Twitter aackly', 'fBTWall12Text', 3, 1, 1, '2016-06-26 22:00:01', '2016-06-27 05:00:26'),
(12, 7, '9169561550', '= ', '20160627052605.png', '20160627052605.png', 'Crazy', 'Friend', 3, 2, 1, '2016-06-26 22:26:00', '2016-06-27 05:26:26'),
(13, 4, '7146538819', 'That''s crazy cool', '20160627191242.png', '20160627191242.png', 'Just another for FB TW IMG', 'IMG FB TW', 2, 1, 1, '2016-06-27 12:12:39', '2016-06-27 19:12:55'),
(14, 8, '7609547455', 'https://aackaack.s3.amazonaws.com/8/6ec3d3b7-1437-4adf-ba88-fb1a2e77e94a_20160624020918_74_7609547455.png', '20160627195710.png', '20160627195710.png', 'Only pics', 'Everyone', 3, 2, 1, '2016-06-27 12:57:06', '2016-06-27 19:57:12'),
(15, 5, '9493947538', 'So it is a ={', '20160628022239.png', '20160628022239.png', 'This is for facebook aack', 'FBaack💣', 3, 1, 1, '2016-06-27 19:22:35', '2016-06-28 02:23:43'),
(16, 2, '9496409353', 'Ok then', '20160628031616.png', '20160628031616.png', 'Facebook and atwitter try', 'TwitFacebk⛄', 3, 1, 1, '2016-06-27 20:16:13', '2016-06-28 03:16:22'),
(17, 2, '9496409353', 'https://aackaack.s3.amazonaws.com/2/3ae98fa3-4615-4952-9001-1368a27a7801_20160514091348_3_9496409353.png', '20160628032235.png', '20160628032235.png', 'Facebook video test', 'FacebookTest', 3, 1, 1, '2016-06-27 20:22:32', '2016-06-28 03:22:38'),
(18, 4, '9496409353', 'https://aackaack.s3.amazonaws.com/4/0a906d14-9165-4e7a-8f12-e5df33a0954b_20150921101230_5_9496409353.png', '20160629042829.png', '20160629042829.png', 'The big picture of the best Tumble and also Imgur', 'Tumble Imgur', 2, 1, 1, '2016-06-28 21:28:26', '2016-06-29 04:29:06'),
(19, 10, '9496409353', 'Hi Zeke\nI sent Valerie a text\nMy car has a hybrid failure and a special part is coming tomorrow it will be fixed and all under warranty including the rental car!\nI pay for the gas only!\nThank you for the wonderful deal you got for me when I got the car!!', '20160629093913.png', '20160629093913.png', '', '', 0, 0, 0, '2016-06-29 15:09:05', '2016-06-29 09:39:13'),
(32, 9, 'VA611117', 'FREE FREE FREE. You have 25 FREE local minutes in your vodafone account! Dial *121*0025# to use it now! No hidden charges! ', '20160629155102.png', '20160629155102.png', 'Test', 'Good', 3, 1, 1, '2016-06-29 21:20:34', '2016-06-29 15:51:57'),
(21, 10, '9496409353', 'Hi there', '20160629095532.png', '20160629095532.png', '', '', 0, 0, 0, '2016-06-29 15:25:30', '2016-06-29 09:55:32'),
(22, 10, '9493947538', '1', '20160629100049.png', '20160629100049.png', '', '', 0, 0, 0, '2016-06-29 15:30:43', '2016-06-29 10:00:49'),
(23, 10, '9496409353', 'Hi there', '20160629100126.png', '20160629100126.png', '', '', 0, 0, 0, '2016-06-29 15:31:23', '2016-06-29 10:01:26'),
(24, 10, '9496409353', 'Hi there', '20160629101237.png', '20160629101237.png', '', '', 0, 0, 0, '2016-06-29 15:42:32', '2016-06-29 10:12:37'),
(33, 11, 'RMSHIVST', 'SHRIVASTAVA GOLD CALLS ::\nLast 2 Call Our Traders Made\n1850pts Profit In GOLD ,\nTo Join Our Next 800pts\nGOLD sms or call :09900866708', '20160629180623.png', '20160629180623.png', 'Funny', 'Cool', 2, 1, 1, '2016-06-29 23:36:18', '2016-06-29 18:06:31'),
(28, 10, '9496409353', 'That''s great', '20160629110819.png', '20160629110819.png', '', '', 0, 0, 0, '2016-06-29 16:38:16', '2016-06-29 11:08:19'),
(52, 17, '9492758987', 'Huh', '20160702091801.png', '20160702091801.png', 'One side', 'Facebook', 3, 1, 1, '2016-07-02 14:48:01', '2016-07-02 09:18:06'),
(53, 17, '9496409353', 'Hi there', '20160704045621.png', '20160704045621.png', 'Final', 'Test', 3, 1, 1, '2016-07-04 10:26:15', '2016-07-04 04:56:30'),
(54, 17, '9496409353', 'Hi Zeke\nI sent Valerie a text\nMy car has a hybrid failure and a special part is coming tomorrow it will be fixed and all under warranty including the rental car!\nI pay for the gas only!\nThank you for the wonderful deal you got for me when I got the car!!', '20160704050010.png', '20160704050010.png', 'Final1', 'Test2', 2, 1, 1, '2016-07-04 10:30:07', '2016-07-04 05:00:14'),
(47, 17, '9496409353', 'I was texting you wondering how you were doing\nI made steak and chicken stir fry and there is one steak left from last night', '20160702083034.png', '20160702083034.png', '', '', 0, 0, 0, '2016-07-02 14:00:37', '2016-07-02 08:30:34'),
(48, 17, '9496409353', 'I texted Valerie\nIt''s spray time\n(In case she didn''t get the message)\n ', '20160702083547.png', '20160702083547.png', 'Cool', 'Nice', 2, 1, 1, '2016-07-02 14:05:50', '2016-07-02 08:35:52'),
(49, 17, '9493947538', 'Hey there', '20160702085850.png', '20160702085850.png', 'Good', 'Share', 3, 1, 1, '2016-07-02 14:28:50', '2016-07-02 08:58:56'),
(50, 17, '9493947538', 'Hey how you', '20160702090651.png', '20160702090651.png', 'Hch', 'Touch', 3, 1, 1, '2016-07-02 14:36:52', '2016-07-02 09:07:00'),
(51, 17, '9493947538', 'Hey ho', '20160702091349.png', '20160702091349.png', 'Facebook', 'Test', 2, 1, 1, '2016-07-02 14:43:53', '2016-07-02 09:13:57'),
(55, 17, '9493947538', 'Hey there', '20160704051326.png', '20160704051326.png', 'Final2', 'Test2', 2, 1, 1, '2016-07-04 10:43:24', '2016-07-04 05:13:37'),
(56, 17, '9496409353', 'Hi there', '20160704055944.png', '20160704055944.png', 'Paramesh', 'Rap', 2, 1, 1, '2016-07-04 11:29:42', '2016-07-04 05:59:54'),
(57, 17, '9492758987', 'Huh', '20160704071100.png', '20160704071100.png', 'Test final', 'Test final', 3, 1, 1, '2016-07-04 12:40:56', '2016-07-04 07:11:05'),
(58, 17, '9496409353', 'Yeabad', '20160704072135.png', '20160704072135.png', 'Calling', 'My friend', 2, 1, 1, '2016-07-04 12:51:31', '2016-07-04 07:21:42'),
(59, 17, '9496409353', 'That''s great', '20160704074736.png', '20160704074736.png', 'Hxx', 'Hello', 3, 1, 1, '2016-07-04 13:17:31', '2016-07-04 07:47:40'),
(60, 17, '9492758987', 'Catalyst', '20160704074953.png', '20160704074953.png', 'Cyvu', 'Got it', 2, 1, 1, '2016-07-04 13:19:51', '2016-07-04 07:49:58'),
(61, 17, '9493752663', 'I won''t \nI''ll text you and Zeke first  before anything repairs wise happens', '20160704075913.png', '20160704075913.png', 'Tctc', 'Look', 3, 1, 1, '2016-07-04 13:29:06', '2016-07-04 07:59:20'),
(62, 17, '7142678130', 'Awesome. Thanks :-)', '20160704080424.png', '20160704080424.png', 'Final', 'Facebook test', 2, 1, 1, '2016-07-04 13:34:21', '2016-07-04 08:04:28'),
(63, 17, '9493947538', 'What is up', '20160704080841.png', '20160704080841.png', 'Without app', 'Without app', 3, 1, 1, '2016-07-04 13:38:35', '2016-07-04 08:08:57'),
(64, 17, '9496409353', 'Hi there', '20160704081211.png', '20160704081211.png', '', '', 0, 0, 0, '2016-07-04 13:42:05', '2016-07-04 08:12:11'),
(65, 17, '9496409353', 'Hi there', '20160704093426.png', '20160704093426.png', 'Nice', 'Cool', 2, 1, 1, '2016-07-04 15:04:23', '2016-07-04 09:35:13'),
(99, 17, 'VKSBICRD', '349971 is the OTP for trxn of INR 1399.25 at GVMC Visakhapatnam with your SBI Card ending 3537. OTP is valid for 10 mins only. Pls do not share with anyone.', '20160707070833.png', '20160707070833.png', 'Hi', 'Boys', 2, 1, 1, '2016-07-07 12:38:42', '2016-07-07 07:09:23'),
(67, 4, '9496409353', 'Hey this is s5samsung', '20160705214523.png', '20160705214523.png', 'DoubleTest', 'Test2Signs', 3, 1, 1, '2016-07-05 14:45:20', '2016-07-05 21:45:27'),
(68, 4, '9493752663', 'Just Test. Please ignor', '20160705220125.png', '20160705220125.png', 'FavOnLG', 'LG FAV 🐻', 3, 6, 1, '2016-07-05 15:01:23', '2016-07-05 22:05:42'),
(69, 4, '9496409353', 'So yeah', '20160706000037.png', '20160706000037.png', 'This is my favorite thing ever', 'FAVPERSON', 2, 6, 1, '2016-07-05 17:00:34', '2016-07-06 00:01:18'),
(70, 4, '9496409353', '', '20160706000743.png', '20160706000743.png', '', '', 0, 0, 0, '2016-07-05 17:07:40', '2016-07-06 00:07:43'),
(71, 4, '9496409353', '', '20160706000824.png', '20160706000824.png', '', '', 0, 0, 0, '2016-07-05 17:08:23', '2016-07-06 00:08:24'),
(72, 4, '9496409353', '', '20160706000855.png', '20160706000855.png', 'FavOnLG', 'LG FAV 🐻', 3, 1, 1, '2016-07-05 17:08:53', '2016-07-06 00:09:51'),
(73, 4, '9496409353', 'https://aackaack.s3.amazonaws.com/4/63d4b4ec-dbe6-4a81-9af4-517df691d8b4_20150525012003_5_9496409353.png', '20160706004000.png', '20160706004000.png', '', '', 0, 0, 0, '2016-07-05 17:39:57', '2016-07-06 00:40:00'),
(74, 4, '9496409353', 'Some off all', '20160706004913.png', '20160706004913.png', 'Sorter for favorite ', 'Short1FAV', 3, 6, 1, '2016-07-05 17:49:09', '2016-07-06 00:49:17'),
(75, 27, '7142669297', 'https://aackaack.s3.amazonaws.com/27/9223c1e8-3e1a-4edf-9a32-833e54c6f0e4_20160625113924_9_7142669297.png', '20160706005455.png', '20160706005455.png', 'Հռւիբըի բհջի յկլօւ', 'Ըգռ 😗', 3, 2, 1, '2016-07-05 17:54:53', '2016-07-06 00:54:58'),
(76, 27, '9493947538', 'https://aackaack.s3.amazonaws.com/27/bc37fad4-5575-4af3-8fdf-d88984d8d673_20160625093204_4_9493947538.png', '20160706011356.png', '20160706011356.png', 'ㅠㅇㅎ ㅜ혀ㅏ. ㅗㅓㅓㅍ', 'ㅛㅓㅠㅍㅉ뮤ㅓ', 2, 1, 1, '2016-07-05 18:13:54', '2016-07-06 01:14:00'),
(97, 17, '9493947538', 'Hey there', '20160707061907.png', '20160707061907.png', '', '', 0, 0, 0, '2016-07-07 11:49:13', '2016-07-07 06:19:07'),
(98, 17, 'MDCAPRES', 'MULTIBAGGER BUY "JRIIIL" (BSE CODE :- 506016) AT 8  THIS WEEK TGT 15 FINAL TGT 50 IN 2 MONTHS.( 5000 SHARES SURE PROFIT 35000 Rs. IN 1 WEEK ) NIRMAL BANG.', '20160707064437.png', '20160707064437.png', 'Hi', 'Friends', 2, 1, 1, '2016-07-07 12:14:45', '2016-07-07 06:44:40'),
(96, 22, '8341139530', 'https://aackaack.s3.amazonaws.com/000000-1212-1212-1212-121212121212.png', '20160707061226.png', '20160707061226.png', 'Welcome', 'Boyfriend', 2, 1, 1, '2016-07-07 11:42:34', '2016-07-07 06:12:33'),
(119, 22, '8341139530', 'https://aackaack.s3.amazonaws.com/000000-1212-1212-1212-121212121212.png', '20160708043559.png', '20160708043559.png', 'Hi', 'All friends', 2, 1, 1, '2016-07-08 10:06:13', '2016-07-08 04:36:02'),
(91, 31, '9248674523', '6823', '20160706113845.png', '20160706113845.png', '', '', 0, 0, 0, '2016-07-06 17:08:47', '2016-07-06 11:38:45'),
(118, 22, '9247375047', 'https://aackaack.s3.amazonaws.com/000000-1212-1212-1212-121212121212.png', '20160708042949.png', '20160708042949.png', 'Hi', 'Welcome', 2, 1, 1, '2016-07-08 10:00:03', '2016-07-08 04:29:52'),
(92, 17, '7142678130', 'Awesome. Thanks :-)', '20160706172015.png', '20160706172015.png', '', '', 0, 0, 0, '2016-07-06 22:50:09', '2016-07-06 17:20:15'),
(93, 22, '9849963950', 'Syam', '20160707050248.png', '20160707050248.png', '', '', 0, 0, 0, '2016-07-07 10:32:47', '2016-07-07 05:02:48'),
(100, 17, 'VKAxisBk', 'Balance in savings a/c 173222 as of 30-JUN-2016 EOD is INR 5391.76. Credits in a/c are subject to clearing. To know more use Axis Mobile: m.axisbank.com/bal\r', '20160707071600.png', '20160707071600.png', 'Hi', 'Best friend', 2, 1, 1, '2016-07-07 12:46:08', '2016-07-07 07:16:04'),
(101, 17, 'VKAxisBk', 'Balance in savings a/c 173222 as of 30-JUN-2016 EOD is INR 5391.76. Credits in a/c are subject to clearing. To know more use Axis Mobile: m.axisbank.com/bal\r', '20160707073201.png', '20160707073201.png', 'Hi', 'Boys', 2, 1, 1, '2016-07-07 13:02:09', '2016-07-07 07:32:03'),
(102, 17, 'DM366000', 'Get 10% Cashback @ Myntra with your State Bank Debit Card. Min trxn: Rs. 2000; Max Cashback: Rs. 1000 per Card. Visit: goo.gl/3Vfv1D. Validity: 2-3 Jul 16.TnC', '20160707073743.png', '20160707073743.png', 'Welcome', 'All friends', 2, 1, 1, '2016-07-07 13:07:51', '2016-07-07 07:37:46'),
(103, 17, 'VKAxisBk', 'Balance in savings a/c 173222 as of 30-JUN-2016 EOD is INR 5391.76. Credits in a/c are subject to clearing. To know more use Axis Mobile: m.axisbank.com/bal\r', '20160707074414.png', '20160707074414.png', 'Hi', 'Pop', 2, 1, 1, '2016-07-07 13:14:23', '2016-07-07 07:44:17'),
(104, 17, 'IMAxisBk', '23005633 is your OTP for adding M D A G CHANDRASEKHAR as your beneficiary for fund transfer on Axis Mobile. Do not share it with anyone.', '20160707091336.png', '20160707091336.png', 'Hi', 'Pop', 2, 1, 1, '2016-07-07 14:43:45', '2016-07-07 09:13:39'),
(105, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160707091433.png', '20160707091433.png', 'Hi', 'Pop', 2, 1, 1, '2016-07-07 14:44:42', '2016-07-07 09:14:36'),
(106, 17, 'IXINTGRD', 'Invest in NPS. Lead a relaxed retired life. Visit our branches during NPS Campaign from 27th June to 9th July 2016. Call Integrated 9849912532', '20160707092335.png', '20160707092335.png', 'Welcome', 'Fend', 2, 1, 1, '2016-07-07 14:53:44', '2016-07-07 09:23:38'),
(107, 17, 'VKAxisBk', 'Balance in savings a/c 173222 as of 30-JUN-2016 EOD is INR 5391.76. Credits in a/c are subject to clearing. To know more use Axis Mobile: m.axisbank.com/bal\r', '20160707092523.png', '20160707092523.png', 'Best', 'Welcome', 2, 1, 1, '2016-07-07 14:55:32', '2016-07-07 09:25:27'),
(108, 17, 'IMAxisBk', '45196403 is your OTP for adding TANGIRALA ADISESHU as your beneficiary for fund transfer on Axis Mobile. Do not share it with anyone.', '20160707094902.png', '20160707094902.png', 'Hi', 'Cool', 2, 1, 1, '2016-07-07 15:19:10', '2016-07-07 09:49:04'),
(109, 17, 'DM366000', 'Get 10% Cashback @ Myntra with your State Bank Debit Card. Min trxn: Rs. 2000; Max Cashback: Rs. 1000 per Card. Visit: goo.gl/3Vfv1D. Validity: 2-3 Jul 16.TnC', '20160707095223.png', '20160707095223.png', 'Getten', 'All friends', 2, 1, 1, '2016-07-07 15:22:30', '2016-07-07 09:52:25'),
(110, 17, 'VKAxisBk', 'Dear customer, kindly ignore our previous SMS update regarding your a/c balance that was sent on 1st July 2016. We apologise for any inconvenience caused.\n', '20160707101430.png', '20160707101430.png', 'Axis', 'Friend', 2, 1, 1, '2016-07-07 15:44:38', '2016-07-07 10:14:35'),
(111, 17, 'VKAxisBk', 'Balance in savings a/c 173222 as of 30-JUN-2016 EOD is INR 5391.76. Credits in a/c are subject to clearing. To know more use Axis Mobile: m.axisbank.com/bal\r', '20160707102735.png', '20160707102735.png', 'Hi', 'Pop', 2, 1, 1, '2016-07-07 15:57:44', '2016-07-07 10:27:38'),
(112, 17, 'VKAxisBk', 'Dear customer, kindly ignore our previous SMS update regarding your a/c balance that was sent on 1st July 2016. We apologise for any inconvenience caused.\n', '20160707104208.png', '20160707104208.png', 'Info', 'Heartened', 2, 1, 1, '2016-07-07 16:12:18', '2016-07-07 10:42:13'),
(113, 17, 'IMAxisBk', '45196403 is your OTP for adding TANGIRALA ADISESHU as your beneficiary for fund transfer on Axis Mobile. Do not share it with anyone.', '20160707104436.png', '20160707104436.png', 'Hi', 'Pop', 3, 1, 1, '2016-07-07 16:14:45', '2016-07-07 10:44:57'),
(114, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160707105711.png', '20160707105711.png', 'Hi', 'Polo', 2, 1, 1, '2016-07-07 16:27:21', '2016-07-07 10:57:14'),
(115, 17, 'VKAxisBk', 'Balance in savings a/c 173222 as of 30-JUN-2016 EOD is INR 5391.76. Credits in a/c are subject to clearing. To know more use Axis Mobile: m.axisbank.com/bal\r', '20160707131914.png', '20160707131914.png', 'Hi', 'Welcome', 2, 1, 1, '2016-07-07 18:49:24', '2016-07-07 13:19:18'),
(116, 17, 'VM640400', 'MULTIPLY UR MONEY MIN 5/10 TIMES \n\nSIGNATURE CALL\n\nDUNE(539786)\nFor tgt 50 in few weeks\n\nWww.smctradeline.com\n\nFOR 1 MONTH FREE TRIAL MISSCALL  \n+912261934646', '20160707132401.png', '20160707132401.png', 'Hi welcome', 'All my friend', 2, 1, 1, '2016-07-07 18:54:11', '2016-07-07 13:24:06'),
(117, 17, 'UATelnor', 'Dear Customer, in order keep yourself updated with the latest Telenor offers  and  schemes, kindly send SMS START 6 to 1909.', '20160707132705.png', '20160707132705.png', 'Hi', 'Welcome', 2, 1, 1, '2016-07-07 18:57:15', '2016-07-07 13:27:08'),
(120, 22, '8341139530', 'https://aackaack.s3.amazonaws.com/000000-1212-1212-1212-121212121212.png', '20160708043746.png', '20160708043746.png', 'Hi', 'All friends', 2, 1, 1, '2016-07-08 10:08:00', '2016-07-08 04:37:51'),
(121, 22, '9849963950', 'Syam', '20160708044418.png', '20160708044418.png', 'Hi', 'All friends', 2, 1, 1, '2016-07-08 10:14:32', '2016-07-08 04:45:17'),
(122, 22, '9849963950', 'Syam', '20160708044553.png', '20160708044553.png', 'Hi', 'All friends', 2, 1, 1, '2016-07-08 10:16:07', '2016-07-08 04:46:09'),
(123, 22, '9849963950', 'Syam', '20160708053633.png', '20160708053633.png', 'Hi welcome', 'Fend', 2, 1, 1, '2016-07-08 11:06:47', '2016-07-08 05:36:37'),
(124, 22, '9849963950', 'Syam', '20160708054419.png', '20160708054419.png', 'Xxcc', 'Fry', 2, 1, 1, '2016-07-08 11:14:34', '2016-07-08 05:44:24'),
(125, 39, '456', 'T-Mobile Free Msg: Your bill is coming due. Pay online at t-mo.co/pay, on device via the My Account app or on your cell by dialing *PAY (*729).', '20160708054904.png', '20160708054904.png', '', '', 0, 0, 0, '2016-07-08 11:19:01', '2016-07-08 05:49:04'),
(126, 22, '9849963950', 'Syam', '20160708055341.png', '20160708055341.png', 'Hi welcome', 'All best frie', 2, 1, 1, '2016-07-08 11:23:56', '2016-07-08 05:53:45'),
(127, 22, '9849963950', 'Syam', '20160708055441.png', '20160708055441.png', 'Hi', 'All friends', 2, 1, 1, '2016-07-08 11:24:55', '2016-07-08 05:54:44'),
(128, 17, '9493752663', 'Just get the info  and  call Zeke - if it''s no cost to you it''s ok to approve', '20160708060202.png', '20160708060202.png', 'Funny', 'Cool', 2, 1, 1, '2016-07-08 11:32:16', '2016-07-08 06:02:26'),
(129, 17, '9493752663', 'I won''t \nI''ll text you and Zeke first  before anything repairs wise happens', '20160708062208.png', '20160708062208.png', 'Hi', 'Pickup', 2, 1, 1, '2016-07-08 11:52:22', '2016-07-08 06:33:39'),
(130, 17, 'IMAxisBk', '23005633 is your OTP for adding M D A G CHANDRASEKHAR as your beneficiary for fund transfer on Axis Mobile. Do not share it with anyone.', '20160708063837.png', '20160708063837.png', 'Hi', 'Drug', 2, 1, 1, '2016-07-08 12:08:52', '2016-07-08 06:38:41'),
(131, 17, 'IMAxisBk', '23005633 is your OTP for adding M D A G CHANDRASEKHAR as your beneficiary for fund transfer on Axis Mobile. Do not share it with anyone.', '20160708065750.png', '20160708065750.png', 'Uffuuf', 'Dud', 2, 1, 1, '2016-07-08 12:28:04', '2016-07-08 06:57:52'),
(132, 17, 'IMAxisBk', '23005633 is your OTP for adding M D A G CHANDRASEKHAR as your beneficiary for fund transfer on Axis Mobile. Do not share it with anyone.', '20160708070251.png', '20160708070251.png', 'Fudy', 'Surgery', 2, 1, 1, '2016-07-08 12:33:05', '2016-07-08 07:02:53'),
(133, 17, 'IMAxisBk', '23005633 is your OTP for adding M D A G CHANDRASEKHAR as your beneficiary for fund transfer on Axis Mobile. Do not share it with anyone.', '20160708070841.png', '20160708070841.png', 'Hbbn', 'Chin', 2, 1, 1, '2016-07-08 12:38:56', '2016-07-08 07:08:43'),
(134, 17, 'VKAxisBk', 'Dear customer, kindly ignore our previous SMS update regarding your a/c balance that was sent on 1st July 2016. We apologise for any inconvenience caused.\n', '20160708071007.png', '20160708071007.png', 'Hi welcome', 'Hi fronds', 2, 1, 1, '2016-07-08 12:40:21', '2016-07-08 07:10:14'),
(135, 17, 'VKAxisBk', 'Dear customer, kindly ignore our previous SMS update regarding your a/c balance that was sent on 1st July 2016. We apologise for any inconvenience caused.\n', '20160708072014.png', '20160708072014.png', 'Fuff', 'Fudge', 2, 1, 1, '2016-07-08 12:50:27', '2016-07-08 07:20:18'),
(136, 17, 'VKAxisBk', 'Dear customer, kindly ignore our previous SMS update regarding your a/c balance that was sent on 1st July 2016. We apologise for any inconvenience caused.\n', '20160708073113.png', '20160708073113.png', 'Hi', 'Thug', 2, 1, 1, '2016-07-08 13:01:28', '2016-07-08 07:31:20'),
(137, 17, 'IMAxisBk', '23005633 is your OTP for adding M D A G CHANDRASEKHAR as your beneficiary for fund transfer on Axis Mobile. Do not share it with anyone.', '20160708073234.png', '20160708073234.png', 'Floor', 'Pop', 2, 1, 1, '2016-07-08 13:02:48', '2016-07-08 07:32:37'),
(138, 17, 'AMCBSSBI', 'Available Balance in your Account XXXXX550418 as on 01/07/16 is INR 18,958.59. Download Buddy@ http://goo.gl/qUlXqL', '20160708073802.png', '20160708073802.png', 'Hi welcome', 'Hi all friend', 2, 1, 1, '2016-07-08 13:08:16', '2016-07-08 07:38:07'),
(139, 17, 'AMCBSSBI', 'Available Balance in your Account XXXXX550418 as on 05/07/16 is INR 13,285.59. Download Buddy@ http://goo.gl/qUlXqL', '20160708084118.png', '20160708084118.png', 'Hi welcome', 'All friends', 2, 1, 1, '2016-07-08 14:11:32', '2016-07-08 08:41:24'),
(140, 17, 'VKAxisBk', 'Your a/c 33173222 is debited Rs 4000 on 2016-07-06 A/c balance is Rs 21391.76 Info: MOB/TPFT/M D A G CHANDRA/557010100026895', '20160708084216.png', '20160708084216.png', 'Hello', 'Good', 3, 1, 1, '2016-07-08 14:12:29', '2016-07-08 08:44:55'),
(141, 17, 'DM366000', 'MakeMyTrip: Great Monsoon Getaway Sale! 60% Inst. Discount* On Dom Hotels. Plus 30% Cashback* On Balance Amount To HDFC Bank Credit Cards. http://bit.ly/29tRx4S', '20160708084834.png', '20160708084834.png', 'Trip', 'My trip', 2, 1, 1, '2016-07-08 14:18:49', '2016-07-08 08:48:38'),
(142, 17, 'AMCBSSBI', 'Available Balance in your Account XXXXX550418 as on 05/07/16 is INR 13,285.59. Download Buddy@ http://goo.gl/qUlXqL', '20160708085334.png', '20160708085334.png', 'Trip', 'Welcome', 2, 1, 1, '2016-07-08 14:23:49', '2016-07-08 08:53:40'),
(143, 17, 'AMCBSSBI', 'Available Balance in your Account XXXXX550418 as on 05/07/16 is INR 13,285.59. Download Buddy@ http://goo.gl/qUlXqL', '20160708090242.png', '20160708090242.png', 'Hi welcome', 'Hi fend', 2, 1, 1, '2016-07-08 14:32:57', '2016-07-08 09:02:49'),
(144, 17, 'VM640400', 'Watch SULTAN* for FREE at PVR. 15-hr MARATHON GIVEAWAY of movie tickets on JioChat. Every hour from 4pm Jul 6 onwards. http://goo.gl/Dw52Pv', '20160708090612.png', '20160708090612.png', 'Hi', 'Multiple', 2, 1, 1, '2016-07-08 14:36:26', '2016-07-08 09:09:19'),
(145, 17, '8341169231', 'You have only 42.00 All india SMS left in your account;Dial *222*7*46# for 85 Loc  and  15 Nat SMS/day,4 week. Telenor', '20160708091205.png', '20160708091205.png', 'Pop', 'Popfrnd', 2, 1, 1, '2016-07-08 14:42:20', '2016-07-08 09:12:09'),
(146, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708091346.png', '20160708091346.png', 'Telenor', 'Telenor', 2, 1, 1, '2016-07-08 14:44:01', '2016-07-08 09:13:50'),
(147, 17, '9493752663', 'Thanks for great day \nLove: Sutter', '20160708091934.png', '20160708091934.png', 'Thumb', 'Thumblink', 2, 1, 1, '2016-07-08 14:49:49', '2016-07-08 09:19:38'),
(148, 17, 'VKAxisBk', 'Your a/c 33173222 is debited Rs 4000 on 2016-07-06 A/c balance is Rs 21391.76 Info: MOB/TPFT/M D A G CHANDRA/557010100026895', '20160708092049.png', '20160708092049.png', 'Fufufuf', 'Hars', 2, 2, 1, '2016-07-08 14:51:03', '2016-07-08 09:21:11'),
(149, 17, '9493752663', 'Hi I just heard from the dealer \nIt''s a problem with my hybrid system and they are ordering the part and it should be there by tomorrow and it''s all under warranty including the rental car!I only have to pay for the gas I use!\nTHANK YOU JESUS!', '20160708092556.png', '20160708092556.png', 'Capton', 'Captonfrnd', 2, 1, 1, '2016-07-08 14:56:11', '2016-07-08 09:26:00'),
(150, 17, '9492302730', 'No prob', '20160708092915.png', '20160708092915.png', 'Noproblem', 'Welcomeboys', 3, 1, 1, '2016-07-08 14:59:29', '2016-07-08 09:29:21'),
(151, 17, '9493752663', '<<<<;<;<;=', '20160708093729.png', '20160708093729.png', 'Hi', 'Welcome', 3, 1, 1, '2016-07-08 15:07:42', '2016-07-08 09:37:34'),
(152, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708093857.png', '20160708093857.png', 'Hi', 'Pop', 3, 1, 1, '2016-07-08 15:09:10', '2016-07-08 09:39:01'),
(153, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708094142.png', '20160708094142.png', 'Telenor', 'Telenor', 2, 2, 1, '2016-07-08 15:11:58', '2016-07-08 09:42:36'),
(154, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708094400.png', '20160708094400.png', 'Hi', 'Friends', 2, 1, 1, '2016-07-08 15:14:15', '2016-07-08 09:48:30'),
(155, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708101214.png', '20160708101214.png', 'Hi', 'Welcome', 2, 1, 1, '2016-07-08 15:42:29', '2016-07-08 10:12:18'),
(156, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708101825.png', '20160708101825.png', 'Telnor', 'Telnorfrnd', 2, 2, 1, '2016-07-08 15:48:40', '2016-07-08 10:21:55'),
(157, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708102734.png', '20160708102734.png', 'Hi ', 'Captain', 2, 1, 1, '2016-07-08 15:57:49', '2016-07-08 10:27:39'),
(158, 40, '9493947538', '1', '20160708103928.png', '20160708103928.png', 'Ok', 'Cool', 2, 1, 1, '2016-07-08 16:09:23', '2016-07-08 10:41:28'),
(159, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708104933.png', '20160708104933.png', 'Hi', 'Well', 2, 1, 1, '2016-07-08 16:19:31', '2016-07-08 10:52:35'),
(160, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708105435.png', '20160708105435.png', 'Cool', 'Funny', 2, 1, 1, '2016-07-08 16:24:32', '2016-07-08 10:54:43'),
(161, 17, 'DM020001', 'End of Season Sale! Use your Axis Bank Card at Max outlets from 24 Jun-20 Jul  and  get 5% cashback on min spends of Rs.2500, max cashback of Rs.1000! T and C apply.', '20160708105916.png', '20160708105916.png', '', '', 0, 0, 0, '2016-07-08 16:29:11', '2016-07-08 10:59:16'),
(162, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708110041.png', '20160708110041.png', '', '', 0, 0, 0, '2016-07-08 16:30:54', '2016-07-08 11:00:41'),
(163, 17, 'DM020001', 'End of Season Sale! Use your Axis Bank Card at Max outlets from 24 Jun-20 Jul  and  get 5% cashback on min spends of Rs.2500, max cashback of Rs.1000! T and C apply.', '20160708110106.png', '20160708110106.png', 'Cool', 'Funny', 3, 1, 1, '2016-07-08 16:31:03', '2016-07-08 11:01:11'),
(164, 17, 'UATelnor', 'Service Message: Dial *121*7*1# (toll free) and get upto Rs.50000 Insurance FREE! Dial *121*7*1# (Toll FREE)', '20160708110855.png', '20160708110855.png', 'Hi how r u', 'Popfriends', 2, 1, 1, '2016-07-08 16:38:52', '2016-07-08 11:09:06'),
(165, 17, 'UATelnor', 'Check your best plans,?? services, get 10% extra recharge  and  more only at www.telenor.in', '20160708111309.png', '20160708111309.png', 'Hi welcome', 'Pop fend', 2, 1, 1, '2016-07-08 16:43:24', '2016-07-08 11:16:56'),
(166, 8, '7025809451', ' Hi Mrs, could you open the gate for us please, we here at your house. ', '20160710031829.png', '20160710031829.png', 'Landscape', 'Joel', 3, 2, 1, '2016-07-09 20:18:24', '2016-07-10 03:18:32'),
(167, 8, '8479896094', 'So glad your weather is warming up', '20160710032744.png', '20160710032744.png', 'Weather', 'Chi town I''m', 3, 2, 1, '2016-07-09 20:27:38', '2016-07-10 03:27:47'),
(168, 4, '7146538819', 'Yeah OK for you to know =0', '20160710203847.png', '20160710203847.png', 'Just another aack for the whole world ', 'BestGuyGoing ', 2, 1, 1, '2016-07-10 13:38:45', '2016-07-10 20:39:17'),
(169, 47, '9512025923', 'They took me', '20160715050204.png', '20160715050204.png', 'Soon', 'Us', 3, 2, 1, '2016-07-14 22:01:58', '2016-07-15 05:02:09'),
(170, 63, '9493947538', 'Hey there', '20160722071849.png', '20160722071849.png', 'Hello', 'Roohi', 3, 1, 1, '2016-07-22 12:48:48', '2016-07-22 07:20:09'),
(171, 63, '9496409353', 'That''s great', '20160722093654.png', '20160722093654.png', 'Sharing the text', 'Roohi', 3, 1, 1, '2016-07-22 15:06:51', '2016-07-22 09:37:11'),
(172, 63, '5627541203', 'Oh my gosh sooooo adorable!  Thank you =', '20160722105721.png', '20160722105721.png', '', '', 0, 0, 0, '2016-07-22 16:27:16', '2016-07-22 10:57:21'),
(173, 63, '9494363084', 'Just keep taking it easy we all got your back', '20160722105856.png', '20160722105856.png', 'Good work', 'Roohi', 3, 1, 1, '2016-07-22 16:28:53', '2016-07-22 11:03:57'),
(174, 68, '9496409353', '2556', '20160724234839.png', '20160724234839.png', 'Quick aack from first5', 'First5aack', 3, 1, 1, '2016-07-24 16:48:35', '2016-07-24 23:48:59'),
(175, 89, '7146538819', '9874', '20160807030407.png', '20160807030407.png', 'This is the first time🚈', 'TheBig 💎', 3, 1, 1, '2016-08-06 20:04:03', '2016-08-07 03:04:14'),
(176, 87, '9496409353', 'Yeah that is for the =', '20160807031045.png', '20160807031045.png', 'This is missing messages ', 'Missing SMS', 2, 1, 1, '2016-08-06 20:10:43', '2016-08-07 03:11:38'),
(177, 88, '7146538819', 'https://aackaack.s3.amazonaws.com/88/576ba66d-735f-44ed-96e9-ab563973739a_20160806045409_19_7146538819.png', '20160807034453.png', '20160807034453.png', 'Short missing', 'Missing month', 3, 1, 1, '2016-08-06 20:44:25', '2016-08-07 03:45:19'),
(178, 88, '7146538819', 'Hey to fellow aacker =', '20160903204350.png', '20160903204350.png', 'This is for the whole world', 'My best buddy', 3, 1, 1, '2016-09-03 13:43:45', '2016-09-03 20:44:46'),
(179, 88, '9493752663', 'https://aackaack.s3.amazonaws.com/88/2daec779-ca48-449f-b56d-9724fd6ead16_20160515115039_9_9493752663.png', '20160903204849.png', '20160903204849.png', 'From Fav Gal', 'FAVgal', 2, 6, 1, '2016-09-03 13:48:46', '2016-09-03 20:48:52'),
(180, 88, '9493752663', '', '20160903204927.png', '20160903204927.png', '', '', 0, 0, 0, '2016-09-03 13:49:25', '2016-09-03 20:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_backupmessages`
--

CREATE TABLE IF NOT EXISTS `tbl_backupmessages` (
  `backup_id` int(200) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `number` varchar(20) NOT NULL,
  `messages` longtext CHARACTER SET utf8mb4 NOT NULL,
  `type` int(11) NOT NULL COMMENT 'if type is 1 it is inbox if type 2 it is sent message',
  `media` varchar(300) NOT NULL COMMENT 'Save SMS that belongs to MMS',
  `message_datetime` datetime NOT NULL,
  `lastbackup` varchar(20) NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `messagetype` varchar(200) NOT NULL,
  `sms` longtext CHARACTER SET utf8mb4 NOT NULL,
  `thread_id` varchar(300) NOT NULL,
  `original_message_date` varchar(30) NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=250864 ;

--
-- Dumping data for table `tbl_backupmessages`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `comment_id` int(255) NOT NULL AUTO_INCREMENT,
  `aack_id` varchar(300) CHARACTER SET latin1 NOT NULL,
  `userid` varchar(300) CHARACTER SET latin1 NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `devicedatetime` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`comment_id`, `aack_id`, `userid`, `comment`, `devicedatetime`, `created_date`) VALUES
(1, '1', '2', 'Hey there my pretty', '2016-06-25 21:51:53', '2016-06-26 04:51:53'),
(2, '2', '5', 'So it is', '2016-06-25 23:00:53', '2016-06-26 06:00:53'),
(3, '7', '2', 'Oh yeah', '2016-06-25 23:25:12', '2016-06-26 06:25:12'),
(4, '10', '2', 'ReAack 4Real', '2016-06-26 21:56:53', '2016-06-27 04:56:54'),
(5, '10', '7', 'This looks fabulous', '2016-06-26 22:27:59', '2016-06-27 05:28:00'),
(6, '8', '7', 'I love his drawing the most', '2016-06-26 22:28:58', '2016-06-27 05:28:59'),
(7, '11', '8', 'Amazing', '2016-06-27 12:02:37', '2016-06-27 19:02:38'),
(8, '1', '4', 'ReAACK time', '2016-06-28 21:08:36', '2016-06-29 04:08:37'),
(9, '16', '8', 'Wow', '2016-06-29 16:23:14', '2016-06-29 23:23:15'),
(10, '68', '4', 'Yes from LG', '2016-07-05 15:04:01', '2016-07-05 22:04:02'),
(11, '12', '4', 'Oh yeah', '2016-07-05 15:47:14', '2016-07-05 22:47:15'),
(12, '12', '4', 'Go back', '2016-07-05 15:48:28', '2016-07-05 22:48:29'),
(13, '1', '27', 'This is a long wonderful comment about the world of pure imagination?', '2016-07-05 16:52:58', '2016-07-05 23:52:59'),
(14, '75', '27', 'Language keboard test', '2016-07-05 18:00:31', '2016-07-06 01:00:32'),
(15, '166', '8', 'No pics on this.   There are pics of plants not showing up🤔', '2016-07-09 20:19:12', '2016-07-10 03:19:13'),
(16, '165', '8', 'What???', '2016-07-09 20:19:54', '2016-07-10 03:19:55'),
(17, '158', '8', 'Love it😚😚😚😚😚', '2016-07-09 20:20:18', '2016-07-10 03:20:20'),
(18, '76', '8', 'Jason...I  no understand....', '2016-07-09 20:21:56', '2016-07-10 03:21:57'),
(19, '15', '8', 'That''s great.', '2016-07-09 20:22:37', '2016-07-10 03:22:38'),
(20, '17', '8', '😎😎😎😎', '2016-07-09 20:23:37', '2016-07-10 03:23:38'),
(21, '167', '8', 'Seems like old pics are all there but recent ones are still separated', '2016-07-09 20:28:27', '2016-07-10 03:28:28'),
(22, '76', '4', 'I did foreign language keyboard. To see what happens', '2016-07-10 13:36:17', '2016-07-10 20:36:17'),
(23, '168', '43', 'Cool', '2016-07-12 18:15:07', '2016-07-13 01:15:07'),
(24, '12', '43', 'Oh yeah here we go', '2016-07-12 18:16:31', '2016-07-13 01:16:32'),
(25, '15', '43', 'Hey all', '2016-07-12 18:16:48', '2016-07-13 01:16:49'),
(26, '176', '89', 'Thanks for following', '2016-08-06 20:21:04', '2016-08-07 03:21:04'),
(27, '7', '88', 'ReAACK old', '2016-08-06 20:45:44', '2016-08-07 03:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facebook`
--

CREATE TABLE IF NOT EXISTS `tbl_facebook` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `social_feed_id` int(200) NOT NULL COMMENT 'primary key of social table',
  `facebook_id` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_facebook`
--

INSERT INTO `tbl_facebook` (`id`, `social_feed_id`, `facebook_id`) VALUES
(1, 1, '127651804255687'),
(2, 2, '1511075589145043'),
(3, 3, '699460700153105'),
(4, 4, '275266922682431'),
(5, 7, '789284617827100');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorites`
--

CREATE TABLE IF NOT EXISTS `tbl_favorites` (
  `favorite_id` int(200) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `aack_id` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`favorite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow`
--

CREATE TABLE IF NOT EXISTS `tbl_follow` (
  `follow_id` int(200) NOT NULL AUTO_INCREMENT,
  `follower` varchar(200) NOT NULL COMMENT 'logged in user',
  `followee` varchar(200) NOT NULL COMMENT 'other user',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`follow_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `tbl_follow`
--

INSERT INTO `tbl_follow` (`follow_id`, `follower`, `followee`, `created_date`) VALUES
(1, '5', '2', '2016-06-26 06:00:37'),
(2, '4', '2', '2016-06-26 06:15:36'),
(3, '4', '5', '2016-06-26 06:15:41'),
(4, '2', '5', '2016-06-26 06:24:49'),
(5, '7', '2', '2016-06-27 05:20:47'),
(6, '7', '4', '2016-06-27 05:20:54'),
(7, '7', '5', '2016-06-27 05:20:58'),
(8, '8', '7', '2016-06-27 19:02:18'),
(9, '8', '2', '2016-06-27 19:02:23'),
(10, '4', '7', '2016-06-27 19:09:31'),
(11, '2', '4', '2016-06-29 04:10:33'),
(16, '4', '27', '2016-07-06 01:07:39'),
(17, '8', '40', '2016-07-10 03:20:10'),
(19, '8', '22', '2016-07-10 03:20:34'),
(20, '8', '27', '2016-07-10 03:21:20'),
(21, '8', '5', '2016-07-10 03:22:31'),
(22, '4', '8', '2016-07-10 20:35:10'),
(23, '43', '4', '2016-07-13 01:15:01'),
(24, '43', '8', '2016-07-13 01:15:45'),
(25, '43', '5', '2016-07-13 01:16:39'),
(26, '85', '68', '2016-07-29 03:13:49'),
(27, '89', '68', '2016-08-07 03:05:30'),
(28, '87', '89', '2016-08-07 03:08:21'),
(29, '88', '4', '2016-08-07 03:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instagram`
--

CREATE TABLE IF NOT EXISTS `tbl_instagram` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `social_feed_id` int(200) NOT NULL COMMENT 'primary key of social table',
  `instagram_id` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_instagram`
--

INSERT INTO `tbl_instagram` (`id`, `social_feed_id`, `instagram_id`) VALUES
(1, 5, '1502688166');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_likes`
--

CREATE TABLE IF NOT EXISTS `tbl_likes` (
  `like_id` int(255) NOT NULL AUTO_INCREMENT,
  `aack_id` varchar(300) NOT NULL,
  `userid` varchar(300) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`like_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tbl_likes`
--

INSERT INTO `tbl_likes` (`like_id`, `aack_id`, `userid`, `created_date`) VALUES
(1, '1', '2', '2016-06-26 04:51:42'),
(2, '2', '2', '2016-06-26 05:11:41'),
(3, '2', '5', '2016-06-26 06:00:43'),
(4, '6', '4', '2016-06-26 06:15:44'),
(5, '8', '2', '2016-06-26 06:24:42'),
(6, '7', '2', '2016-06-26 06:25:04'),
(7, '10', '2', '2016-06-27 04:56:42'),
(8, '10', '7', '2016-06-27 05:27:48'),
(9, '8', '7', '2016-06-27 05:28:37'),
(10, '11', '7', '2016-06-27 05:29:16'),
(11, '11', '8', '2016-06-27 19:02:32'),
(12, '14', '2', '2016-06-27 23:07:37'),
(13, '13', '2', '2016-06-27 23:08:10'),
(14, '15', '2', '2016-06-28 02:29:36'),
(15, '1', '4', '2016-06-29 04:08:22'),
(16, '16', '8', '2016-06-29 23:23:08'),
(18, '68', '4', '2016-07-05 22:03:52'),
(19, '12', '4', '2016-07-05 22:47:06'),
(20, '15', '4', '2016-07-05 22:49:21'),
(21, '13', '4', '2016-07-06 00:05:59'),
(22, '75', '27', '2016-07-06 01:00:20'),
(23, '166', '8', '2016-07-10 03:18:42'),
(24, '165', '8', '2016-07-10 03:19:48'),
(25, '158', '8', '2016-07-10 03:20:12'),
(26, '127', '8', '2016-07-10 03:20:38'),
(27, '76', '8', '2016-07-10 03:21:21'),
(28, '15', '8', '2016-07-10 03:22:30'),
(29, '17', '8', '2016-07-10 03:23:29'),
(30, '167', '8', '2016-07-10 03:28:05'),
(31, '75', '4', '2016-07-10 20:36:51'),
(32, '168', '43', '2016-07-13 01:15:04'),
(33, '167', '43', '2016-07-13 01:15:30'),
(34, '12', '43', '2016-07-13 01:16:01'),
(35, '15', '43', '2016-07-13 01:16:42'),
(36, '169', '87', '2016-08-07 00:44:41'),
(37, '173', '88', '2016-08-07 00:44:49'),
(38, '175', '87', '2016-08-07 03:08:13'),
(39, '176', '89', '2016-08-07 03:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reshares`
--

CREATE TABLE IF NOT EXISTS `tbl_reshares` (
  `ReshareId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `AackId` int(11) NOT NULL,
  `SharedTo` int(11) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DeviceDateTime` datetime NOT NULL,
  PRIMARY KEY (`ReshareId`),
  KEY `AackId` (`AackId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_reshares`
--

INSERT INTO `tbl_reshares` (`ReshareId`, `UserId`, `AackId`, `SharedTo`, `CreatedDate`, `DeviceDateTime`) VALUES
(1, 2, 10, 1, '2016-06-27 04:57:11', '2016-06-26 21:57:11'),
(2, 4, 1, 1, '2016-06-29 04:08:55', '2016-06-28 21:08:54'),
(4, 22, 65, 1, '2016-07-05 12:39:47', '2016-07-05 18:09:47'),
(5, 22, 1, 1, '2016-07-05 12:41:02', '2016-07-05 18:11:01'),
(6, 22, 15, 1, '2016-07-05 12:48:56', '2016-07-05 18:18:55'),
(7, 22, 14, 1, '2016-07-05 14:23:15', '2016-07-05 19:53:13'),
(8, 4, 65, 1, '2016-07-05 23:28:11', '2016-07-05 16:28:10'),
(9, 22, 76, 1, '2016-07-06 04:39:35', '2016-07-06 10:09:33'),
(10, 22, 72, 1, '2016-07-06 04:52:52', '2016-07-06 10:22:50'),
(11, 22, 12, 1, '2016-07-06 05:14:33', '2016-07-06 10:44:32'),
(12, 17, 96, 1, '2016-07-07 07:54:54', '2016-07-07 13:25:03'),
(13, 17, 76, 1, '2016-07-07 08:27:48', '2016-07-07 13:57:57'),
(14, 17, 76, 1, '2016-07-07 08:28:28', '2016-07-07 13:58:37'),
(15, 17, 72, 1, '2016-07-07 08:47:45', '2016-07-07 14:17:54'),
(16, 17, 1, 1, '2016-07-07 09:06:10', '2016-07-07 14:36:20'),
(17, 17, 15, 1, '2016-07-07 09:06:54', '2016-07-07 14:37:03'),
(18, 17, 15, 1, '2016-07-07 09:07:34', '2016-07-07 14:37:43'),
(19, 17, 12, 1, '2016-07-07 09:11:34', '2016-07-07 14:41:44'),
(20, 17, 14, 2, '2016-07-07 09:47:48', '2016-07-07 15:17:57'),
(21, 22, 117, 1, '2016-07-07 13:31:15', '2016-07-07 19:01:25'),
(22, 8, 15, 2, '2016-07-10 03:22:49', '2016-07-09 20:22:47'),
(23, 88, 7, 1, '2016-08-07 03:46:26', '2016-08-06 20:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms`
--

CREATE TABLE IF NOT EXISTS `tbl_sms` (
  `sms_id` int(200) NOT NULL AUTO_INCREMENT,
  `_id` int(200) NOT NULL,
  `thread_id` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `person` varchar(300) NOT NULL,
  `date` varchar(300) NOT NULL,
  `date_sent` varchar(300) NOT NULL,
  `protocol` varchar(300) NOT NULL,
  `read` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL,
  `type` varchar(300) NOT NULL,
  `reply_path_present` varchar(300) NOT NULL,
  `body` varchar(300) NOT NULL,
  `service_center` varchar(300) NOT NULL,
  `locked` varchar(300) NOT NULL,
  `error_code` varchar(300) NOT NULL,
  `seen` varchar(300) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social`
--

CREATE TABLE IF NOT EXISTS `tbl_social` (
  `social_id` int(200) NOT NULL AUTO_INCREMENT,
  `social_Network_id` varchar(200) NOT NULL,
  `userid` varchar(200) NOT NULL,
  `socialtype` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`social_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_social`
--

INSERT INTO `tbl_social` (`social_id`, `social_Network_id`, `userid`, `socialtype`, `created_date`) VALUES
(1, '127651804255687', '1', '2', '2016-06-26 04:45:43'),
(2, '1511075589145043', '3', '2', '2016-06-26 05:50:51'),
(3, '699460700153105', '6', '2', '2016-06-26 17:15:04'),
(4, '275266922682431', '15', '2', '2016-06-30 05:27:52'),
(5, '1502688166', '15', '5', '2016-06-30 08:38:11'),
(6, '4858938795', '18', '4', '2016-06-30 09:20:38'),
(7, '789284617827100', '22', '2', '2016-07-05 11:55:44'),
(8, '142934351', '27', '4', '2016-07-10 20:13:59'),
(9, '4220451253', '63', '4', '2016-07-23 13:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_twitter`
--

CREATE TABLE IF NOT EXISTS `tbl_twitter` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `social_feed_id` int(200) NOT NULL COMMENT 'primary key of social table',
  `twitter_id` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_twitter`
--

INSERT INTO `tbl_twitter` (`id`, `social_feed_id`, `twitter_id`) VALUES
(1, 6, '4858938795'),
(2, 8, '142934351'),
(3, 9, '4220451253');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `userid` int(200) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `profile_pic` varchar(500) DEFAULT NULL,
  `number` varchar(200) DEFAULT NULL,
  `socialid` varchar(200) DEFAULT NULL,
  `social_type` int(1) NOT NULL DEFAULT '1' COMMENT '3 is for general login,2 is facebook,4 is twitter,5 is instagram ',
  `online_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 is for online,0 is for offline',
  `devicetoken` varchar(200) DEFAULT NULL,
  `device_type` int(1) NOT NULL COMMENT '1 is for iphone,2 is for android',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL,
  `profile_status` tinyint(1) NOT NULL COMMENT 'if 0 updated else if 1 not updated',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userid`, `firstname`, `lastname`, `username`, `password`, `email`, `profile_pic`, `number`, `socialid`, `social_type`, `online_status`, `devicetoken`, `device_type`, `created_date`, `updated_date`, `profile_status`) VALUES
(1, NULL, NULL, '', '', '', 'https://graph.facebook.com/127651804255687/picture?type=large', NULL, '127651804255687', 2, 1, ' ', 0, '2016-06-26 04:45:43', '0000-00-00 00:00:00', 1),
(2, 'Sasha LGG4', '', 'LGG4baby', 'lgg4baby1', 'alexlaluna199@gmail.com', '20160626044838.jpeg', '7145555555', NULL, 3, 0, ' ', 0, '2016-06-26 04:48:38', '0000-00-00 00:00:00', 0),
(3, NULL, NULL, '', '', '', 'https://graph.facebook.com/1511075589145043/picture?type=large', NULL, '1511075589145043', 2, 1, ' ', 0, '2016-06-26 05:50:51', '0000-00-00 00:00:00', 1),
(4, 'Zeke', 'S5fb', 'AackGuyS5', 's4samsung1', 'sutter@zekedesign.com', '20160626055427.jpeg', '9591234567', NULL, 3, 0, ' ', 0, '2016-06-26 05:54:27', '0000-00-00 00:00:00', 0),
(5, 'Denise Htcphone', '', 'HTCmaster', 'htcmaster1', 'denisemartinezkelly@gmail.com', '20160628022755.jpeg', '9495552356', NULL, 3, 1, ' ', 0, '2016-06-26 05:54:29', '0000-00-00 00:00:00', 0),
(25, 'Kgkfc', '', 'hchdhdhd', 'ncjcjfihc', 'mvncjc@xjxjc.com', '20160705111833.jpeg', '6865659764', NULL, 3, 1, ' ', 0, '2016-07-05 11:18:33', '0000-00-00 00:00:00', 0),
(7, 'Valerie B', '', 'valerieb', '1benjake', 'valzi@aol.com', '20160627052011.jpeg', '7609547455', NULL, 3, 0, ' ', 0, '2016-06-27 05:20:11', '0000-00-00 00:00:00', 0),
(8, 'Val Gal', '', 'valgal', '1benjake', 'Valerieca@aol.com', '20160627190209.jpeg', '7609547455', NULL, 3, 1, ' ', 0, '2016-06-27 19:02:09', '0000-00-00 00:00:00', 0),
(24, 'Xhcjc', '', 'fjcickvvok', 'cjcicici', 'ckvov@bigiif.com', '20160705105802.jpeg', ',868383868', NULL, 3, 1, ' ', 0, '2016-07-05 10:58:02', '0000-00-00 00:00:00', 0),
(23, 'Xjcj', '', 'fjfjcicjc', 'fificicic', 'jcjcj@ucjc.com', '20160704105605.jpeg', '6865643767', NULL, 3, 1, ' ', 0, '2016-07-04 10:56:05', '0000-00-00 00:00:00', 0),
(22, 'ifufbx', '', 'udduddd', 'jcjjcjccjccj', 'udjdj@ufud.cucu', '20160701133437.jpeg', '5886467676', NULL, 3, 0, '60ce371849bd9ae5', 0, '2016-07-01 13:34:37', '0000-00-00 00:00:00', 0),
(21, 'Heheheh', '', 'hehehsdebdbd', '262773373737', 'djdjfj@krjfj.com', '20160701094611.jpeg', '4948464646', NULL, 3, 1, ' ', 0, '2016-07-01 09:46:11', '0000-00-00 00:00:00', 0),
(20, 'Vvghvg', '', 'vggfibbjjj', 'gguhhkjj', 'vghh@gfhbn.com', '20160701082453.jpeg', '5588698888', NULL, 3, 0, ' ', 0, '2016-07-01 08:24:53', '0000-00-00 00:00:00', 0),
(19, 'Thats', '', 'thatsfine', '1234567', 'illindavenu@gmail.com', '20160701052712.jpeg', '9849963950', NULL, 3, 1, ' ', 0, '2016-07-01 05:27:12', '0000-00-00 00:00:00', 0),
(18, 'syam', 'Vakkalanka', 'syam76488725', '', 'syam@troomobile.com', 'http://abs.twimg.com/sticky/default_profile_images/default_profile_4_bigger.png', '9798985654', '4858938795', 4, 1, '5635be1133e327c4', 0, '2016-06-30 09:20:38', '0000-00-00 00:00:00', 0),
(17, 'Message', '', 'message', '1234567', 'message@gmail.com', '20160630061542.jpeg', '1946464644', NULL, 3, 1, ' ', 0, '2016-06-30 06:15:42', '0000-00-00 00:00:00', 0),
(26, 'Jcjccj', '', 'hfucjcjcjcj', 'ificjcjcjc', 'fufjcic@xjcjc.com', '20160705131433.jpeg', '5353867376', NULL, 3, 1, ' ', 0, '2016-07-05 13:14:33', '0000-00-00 00:00:00', 0),
(27, 'New zekeLG', '', 'NEWLGG4', 'newlgg41', 'zeke@zekedesign.com', '20160705222428.jpeg', '8882525252', NULL, 3, 1, ' ', 0, '2016-07-05 22:24:28', '0000-00-00 00:00:00', 0),
(28, 'Xbjdhd', '', 'nxdjdjdj', 'hzhzhshsh', 'hdhdhdj@jdjdj.com', '20160706071314.jpeg', '9494643439', NULL, 3, 1, ' ', 0, '2016-07-06 07:13:14', '0000-00-00 00:00:00', 0),
(29, 'Hdhdjdj', '', 'ndjdjdjdj', 'ndhdhdhdhdhs', 'bsbdhs@jsjdj.com', '20160706081626.jpeg', '9864646464', NULL, 3, 1, ' ', 0, '2016-07-06 08:16:26', '0000-00-00 00:00:00', 0),
(30, 'Xixic', '', 'icicicjcjckkckjcchc', 'jcjccjcjcjcjcjc', 'bsbdhsfghvf@jsjdj.com', '20160706102033.jpeg', '2606868686', NULL, 3, 1, ' ', 0, '2016-07-06 10:20:33', '0000-00-00 00:00:00', 0),
(31, 'Kanth', '', 'kantharao', 'kanthrao', 'kanth@gmail.com', '20160706113655.jpeg', '5809658888', NULL, 3, 1, ' ', 0, '2016-07-06 11:36:55', '0000-00-00 00:00:00', 0),
(32, 'Jack', '', 'jack111', 'jack111', 'jack@gmail.com', '20160706130012.jpeg', '4567891234', NULL, 3, 0, ' ', 0, '2016-07-06 13:00:12', '0000-00-00 00:00:00', 0),
(33, 'Teteysgshd', '', 'dhdejdhdh', 'xhhdhdhddjr', 'bsbdhgsgsvzvs@jsjdj.com', '20160706173715.jpeg', '5415458465', NULL, 3, 1, ' ', 0, '2016-07-06 17:37:15', '0000-00-00 00:00:00', 0),
(34, '6dyxyx', '', 'gyxycyci', 'xtxycucyfxd', 'bsbfhuhhdhs@jsjdj.com', '20160707053905.jpeg', '7253868243', NULL, 3, 1, ' ', 0, '2016-07-07 05:39:05', '0000-00-00 00:00:00', 0),
(35, 'Kvkcjcj Ic', '', 'xhdufjcjckcc', 'hxyxuxuxx', 'cucfucifff@cuciff.com', '20160707054630.jpeg', '8383838838', NULL, 3, 1, ' ', 0, '2016-07-07 05:46:30', '0000-00-00 00:00:00', 0),
(36, 'Allamrajukrish', '', 'allamrajukrish', 'password', 'srikrishna@stellentsoft.com', '20160707071733.jpeg', '9441239901', NULL, 3, 1, ' ', 0, '2016-07-07 07:17:33', '0000-00-00 00:00:00', 0),
(37, 'Sherlin', '', 'Sherlin', '1234567', 'divya.d@stellentsoft.com', '20160707080209.jpeg', '8000548645', NULL, 3, 0, ' ', 0, '2016-07-07 08:02:09', '0000-00-00 00:00:00', 0),
(38, 'Ckcicucici', '', 'jxfjfjxudixuxjxxjxx', 'kvicjcjcjcjxjc', 'cjchchxxh@igigigckj.com', '20160707102938.jpeg', '6868373767', NULL, 3, 1, ' ', 0, '2016-07-07 10:29:38', '0000-00-00 00:00:00', 0),
(39, 'Syam11', '', 'syam111', '1234567', 'syam111@gmail.com', '20160708044140.jpeg', '9849963950', NULL, 3, 1, ' ', 0, '2016-07-08 04:41:40', '0000-00-00 00:00:00', 0),
(40, 'Kfififididj', '', 'jvjcificncjfuf', 'cjjfjxjxufhxjxjx', 'kcovocjdjdjfj@ufifjdjxxuc.com', '20160708090328.jpeg', '6834379783', NULL, 3, 1, ' ', 0, '2016-07-08 09:03:28', '0000-00-00 00:00:00', 0),
(41, 'S5 Zeke', '', 'GalaxyS5', 'galaxys5', 'zekedesign1@gmail.com', '20160711041123.jpeg', '9492362586', NULL, 3, 0, ' ', 0, '2016-07-11 04:11:23', '0000-00-00 00:00:00', 0),
(42, 'LG Guy', '', 'LGG4', 'lgg4211', 'timmath1963@gmail.com', '20160711041130.jpeg', '7141234567', NULL, 3, 0, ' ', 0, '2016-07-11 04:11:30', '0000-00-00 00:00:00', 0),
(43, 'Valzi B', '', 'valzibee', '1benjake', 'Jerry2xeagle@aol.com', '20160712134129.jpeg', '7609547455', NULL, 3, 0, ' ', 0, '2016-07-12 13:41:29', '0000-00-00 00:00:00', 0),
(44, 'Jdjdjdjd', '', 'hdhdbdndnxxbx', 'dhhdhdhdndn', 'hsjsjsbdns@jsjsjs.com', '20160714055516.jpeg', '9797656564', NULL, 3, 0, ' ', 0, '2016-07-14 05:55:16', '0000-00-00 00:00:00', 0),
(45, 'Jdjdjdj', '', 'dbdhurhrisndndj', 'rhhehdhxhhx', 'hdhddhd@jsjssjsj.com', '20160714102649.jpeg', '6565656534', NULL, 3, 1, ' ', 0, '2016-07-14 10:26:49', '0000-00-00 00:00:00', 0),
(46, 'Funny2', '', 'syam8289', '12345678', 'mall123i@gmail.com', '20160714171850.jpeg', '9849963950', NULL, 3, 1, ' ', 0, '2016-07-14 17:18:50', '0000-00-00 00:00:00', 0),
(47, 'Vegas Val', '', 'Vegasval', '1benjake', 'jbutcher2018@aol.com', '20160715001400.jpeg', '7609547455', NULL, 3, 0, '7bf0cad43b2e3061', 0, '2016-07-15 00:14:00', '0000-00-00 00:00:00', 0),
(48, 'Hxhxjxncjcjf', '', 'cjfjcncifjcjfucngig', 'jcufjcjcf', 'cuucjcjcjc@hcjcjjcjc.com', '20160715042050.jpeg', '8656506686', NULL, 3, 1, ' ', 0, '2016-07-15 04:20:50', '0000-00-00 00:00:00', 0),
(49, 'Xnxnxnxj', '', 'djjdxjdjdjdy', 'bdhduddbdhdi', 'sbhxhdhd@jsjsjs.com', '20160718073902.jpeg', '9464346448', NULL, 3, 1, ' ', 0, '2016-07-18 07:39:02', '0000-00-00 00:00:00', 0),
(50, 'Cjcjvjf', '', 'fhffjfuf', 'bxhchfuf', 'bxgzd@xyxhudu.com', '20160718080545.jpeg', '6867679*97', NULL, 3, 0, ' ', 0, '2016-07-18 08:05:45', '0000-00-00 00:00:00', 0),
(51, 'Fghxcgcg', '', 'nxnxnddjnc', 'bxbxbbxxb', 'ckcjxjxj@hcchh.com', '20160720054034.jpeg', '9553885555', NULL, 3, 1, ' ', 0, '2016-07-20 05:40:34', '0000-00-00 00:00:00', 0),
(52, 'Yxuxuxucu', '', 'hcucjcjcjcj', 'uvjvjcjvjvi', 'ucucv@ucjvvjvj.com', '20160720060126.jpeg', '6868283868', NULL, 3, 1, ' ', 0, '2016-07-20 06:01:26', '0000-00-00 00:00:00', 0),
(53, 'Xbhdhdhs', '', 'bxndnddn', 'xnhxxhxnnx', 'nxbdjssjsj@jxjdndjd.com', '20160720062730.jpeg', '9868359449', NULL, 3, 1, ' ', 0, '2016-07-20 06:27:30', '0000-00-00 00:00:00', 0),
(54, 'Fufuffhfh jcbc', '', 'hxchcbcchchbchcj', 'hchffhcjccnc', 'hxchchchc@hfufh.com', '20160720070221.jpeg', '7627676737', NULL, 3, 0, ' ', 0, '2016-07-20 07:02:21', '0000-00-00 00:00:00', 0),
(55, ' Jckhxchc', '', 'ufufufcjccjc', 'xufufucuccu', 'jchvjvu@hcchccj.com', '20160720072305.jpeg', '7383838383', NULL, 3, 1, ' ', 0, '2016-07-20 07:23:05', '0000-00-00 00:00:00', 0),
(56, 'Vamdi', '', 'vamsi', '1234567', 'vamsi@gmail.com', '20160720084529.jpeg', '9849963950', NULL, 3, 1, ' ', 0, '2016-07-20 08:45:29', '0000-00-00 00:00:00', 0),
(57, 'Roohi ', '', 'roohi', '1234567', 'mafffclli@gmail.com', '20160720090321.jpeg', '5858686868', NULL, 3, 0, ' ', 0, '2016-07-20 09:03:21', '0000-00-00 00:00:00', 0),
(58, 'Allamrajukrish', '', 'allamrajukrish123', 'password', 'srikrishna1@stellentsoft.com', '20160720091654.jpeg', '9441239901', NULL, 3, 1, '9eca6f939a44a648', 0, '2016-07-20 09:16:54', '0000-00-00 00:00:00', 0),
(59, 'Merlin', '', 'Merlin', '12345678', 'merlin@gmail.com', '20160720094436.jpeg', '8846595659', NULL, 3, 1, '19f151b98aa8bb9f', 0, '2016-07-20 09:44:36', '0000-00-00 00:00:00', 0),
(60, 'Syam', '', 'rteste', '1234567', 'test1@gmailll.com', '20160720132017.jpeg', '9849963950', NULL, 3, 1, ' ', 0, '2016-07-20 13:20:17', '0000-00-00 00:00:00', 0),
(61, 'Reena', '', 'reena', '1234567', 'reena@gmail.com', '20160721110113.jpeg', '8549469586', NULL, 3, 1, ' ', 0, '2016-07-21 11:01:13', '0000-00-00 00:00:00', 0),
(62, '7gifj 7gifj ', '', 'hchcjfjcc', 'ufucjcfjckfj', 'xhxjxjxj@ivigog.com', '20160722061010.jpeg', '3537375457', NULL, 3, 1, ' ', 0, '2016-07-22 06:10:10', '0000-00-00 00:00:00', 0),
(63, 'Joyana', '', 'joyana', '1234567', 'joyana@gmail.com', '20160722071721.jpeg', '5463484554', NULL, 3, 0, ' ', 0, '2016-07-22 07:17:21', '0000-00-00 00:00:00', 0),
(64, 'Clara', '', 'clara', '1234567', 'clara@gmail.com', '20160722110416.jpeg', '1234567899', NULL, 3, 0, ' ', 0, '2016-07-22 11:04:16', '0000-00-00 00:00:00', 0),
(65, 'Bxbxnxbx', '', 'nfjfndbdnb', 'bdbddboshdhf', 'bdndbdhd@dudjd.com', '20160723072617.jpeg', '4949494949', NULL, 3, 0, ' ', 0, '2016-07-23 07:26:17', '0000-00-00 00:00:00', 0),
(66, 'Jcjh', '', 'bdbdhdhd', 'bxbxhxh', 'dbbdhdbddb@hshshs.nxnx', '20160723095949.jpeg', '9898686867', NULL, 3, 1, 'ce44574c1ff9100b', 0, '2016-07-23 09:59:49', '0000-00-00 00:00:00', 0),
(67, 'LG guy', '', 'LGG4man', 'lgg4man1', 'carson@zekedesign.com', '20160724234620.jpeg', '9491234567', NULL, 3, 0, ' ', 0, '2016-07-24 23:46:20', '0000-00-00 00:00:00', 0),
(68, 'Sam Sung', '', 'galaxyS5guy', 'galaxys51', 'sutterc@zekedesign.com', '20160724234643.jpeg', '7141236547', NULL, 3, 0, ' ', 0, '2016-07-24 23:46:43', '0000-00-00 00:00:00', 0),
(69, 'Cgxydhfufjg', '', 'fufufufhxh', 'cugicucu', 'dycudhdy@ugfyfdu.com', '20160725084008.jpeg', '3435383883', NULL, 3, 1, ' ', 0, '2016-07-25 08:40:08', '0000-00-00 00:00:00', 0),
(70, '  N Nn', '', 'bxjxjdjddjdj', 'hxhxjdnfncj', 'xbbxjdj@gxhdhh.com', '20160725104749.jpeg', '9898796060', NULL, 3, 1, ' ', 0, '2016-07-25 10:47:49', '0000-00-00 00:00:00', 0),
(71, 'Cucu G Gxy', '', 'ucuvuvuvuvu', 'jcucucucucuvu', 'hchchccy@ufucyccyc.com', '20160725110606.jpeg', '8622058585', NULL, 3, 1, ' ', 0, '2016-07-25 11:06:06', '0000-00-00 00:00:00', 0),
(72, 'Hxjcuccu', '', 'jjcucucucu', 'chhcjchjcu', 'jcjciciv@ucucu.com', '20160726073611.jpeg', '0986533838', NULL, 3, 1, ' ', 0, '2016-07-26 07:36:11', '0000-00-00 00:00:00', 0),
(73, 'Hxjcjcjff', '', 'kcjcjcjcjcjcf', '5jchgxyshxhx', 'jfjcickcfi@hdufififc.com', '20160726082243.jpeg', '6890968686', NULL, 3, 1, ' ', 0, '2016-07-26 08:22:44', '0000-00-00 00:00:00', 0),
(74, 'Zhsysueue', '', 'jfjcjckckckck', 'ififkffjcjc', 'bzhdhddi@jfuddu.com', '20160726090429.jpeg', '6868656435', NULL, 3, 1, ' ', 0, '2016-07-26 09:04:29', '0000-00-00 00:00:00', 0),
(75, 'Vkcjcicic', '', 'hzyxucucucikf', 'yxyxhxuxuxjcm', 'uxuxucu@uxucucucuc.com', '20160726094516.jpeg', '5857686867', NULL, 3, 1, ' ', 0, '2016-07-26 09:45:16', '0000-00-00 00:00:00', 0),
(76, 'Sharoon', '', 'sharoon', '1234567', 'sharoon@gmail.com', '20160726105120.jpeg', '12345678))', NULL, 3, 1, ' ', 0, '2016-07-26 10:51:20', '0000-00-00 00:00:00', 0),
(77, 'Ferry', '', 'ferry', '1234567', 'ferry@gmail.com', '20160726111039.jpeg', '1234567890', NULL, 3, 1, ' ', 0, '2016-07-26 11:10:39', '0000-00-00 00:00:00', 0),
(78, 'Hxjcucjc', '', 'hchcjcjcc', 'bcjchccnj', 'ucuciv@ifififjc.com', '20160726123850.jpeg', '6867757376', NULL, 3, 1, ' ', 0, '2016-07-26 12:38:50', '0000-00-00 00:00:00', 0),
(79, 'Jcjcjcjcuf', '', 'jchchcjcc', 'jcjcccjcncjc', 'hdjcjccif@ufudufj.com', '20160726142218.jpeg', '6757643467', NULL, 3, 1, ' ', 0, '2016-07-26 14:22:18', '0000-00-00 00:00:00', 0),
(80, 'Fjxjzjzj', '', 'funny123', '123456789', 'xhdgbdhd@djhdjd.com', '20160727072449.jpeg', '6467494959', NULL, 3, 1, ' ', 0, '2016-07-27 07:24:49', '0000-00-00 00:00:00', 0),
(81, 'Jcucucuc', '', 'ifiucucjcjch', 'bnhhhhh', 'fufufucx@jcufuiv.com', '20160727133845.jpeg', '8625383868', NULL, 3, 1, 'd52983bfa6041e57', 0, '2016-07-27 13:38:45', '0000-00-00 00:00:00', 0),
(82, ' Xbxhxh', '', 'zhdhdjfjfj', 'ndjfhxhxjx', 'bdhxhxh@djfjf.com', '20160728053422.jpeg', '7976565676', NULL, 3, 1, ' ', 0, '2016-07-28 05:34:22', '0000-00-00 00:00:00', 0),
(83, 'Hxhchch', '', 'ucjcjchcch', 'hcjcjcjj', 'icjcjc@cjcjcjc.com', '20160728112302.jpeg', '6776838675', NULL, 3, 1, '649c681b07f065d0', 0, '2016-07-28 11:23:02', '0000-00-00 00:00:00', 0),
(84, ' Bxhcncn', '', 'ncjcjcncncncn', 'xbbbnxn', 'jcnckccn@hxhxhxj.com', '20160728130147.jpeg', '6868685*5*', NULL, 3, 1, ' ', 0, '2016-07-28 13:01:47', '0000-00-00 00:00:00', 0),
(85, 'Varma', '', 'varmab', '4emc912', 'varmab@gmail.com', '20160729031238.jpeg', '9496532693', NULL, 3, 1, '58ee599ade628e26', 0, '2016-07-29 03:12:38', '0000-00-00 00:00:00', 0),
(86, 'Dbfbfbf', '', 'xvvdvdbdh', 'fngngnfjf', 'xnfbxbfnf@dnfjgkg.com', '20160805100613.jpeg', '9595959595', NULL, 3, 1, '70c857edc969c92f', 0, '2016-08-05 10:06:13', '0000-00-00 00:00:00', 0),
(87, 'Sasha Woman', '', 'G4sasha', 'g4sasha1', 'carson1@zekedesign.com', '20160807004405.jpeg', '9491234567', NULL, 3, 1, 'cd334699523d47bb', 0, '2016-08-07 00:44:05', '0000-00-00 00:00:00', 0),
(88, 'Zeke Galaxy ', '', 'GalaxyMan', 'galaxyman1', 'sutter1@zekedesign.com', '201608070044051.jpeg', '7141236547', NULL, 3, 1, '358a593264046337', 0, '2016-08-07 00:44:05', '0000-00-00 00:00:00', 0),
(89, 'Bat Man', '', 'HTCaackr', 'htcaackr1', 'zeke1@zekedesign.com', '20160807025549.jpeg', '1234567789', NULL, 3, 0, '4b5112f182b61985', 0, '2016-08-07 02:55:49', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
