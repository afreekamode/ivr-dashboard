-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2014 at 05:07 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `table`
--

-- --------------------------------------------------------

--
-- Table structure for table `signup_and_login_table`
--

CREATE TABLE IF NOT EXISTS `signup_table` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `signup_and_login_table`
--

INSERT INTO `signup_table` (`id`, `firstname`, `lastname`, `ademail`, `adpassword`, `log_date`) VALUES
(1, 'Dada', 'Olufemi', 'odada@fmnplc.com', md5('abimbola'), now());

-- assform tabls
DROP TABLE IF EXISTS `assform`;

CREATE TABLE `assform` (
  `id` int(22) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_assign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_locate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unique4` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_request` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_request1` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `retask_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ass` date NOT NULL,
  `task_time` datetime NOT NULL,
  `retask_time` datetime NOT NULL,
  `time_reopen` datetime NOT NULL,
  `time_completed` datetime NOT NULL,
  `task_acc` int(2) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- item verification table
DROP TABLE IF EXISTS `controlform`; 
CREATE TABLE `controlform` ( `emp_id` int(11) NOT NULL, 
	`fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`lname` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`dept` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`locat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`recv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`recv_date` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`priority` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`phone` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL, 
	`descp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`unique4` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL, 
	`status` int(1) NOT NULL DEFAULT '0', 
	`submit_date` datetime NOT NULL, 
	`ass` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 
	'unassigned' ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- users table
DROP TABLE IF EXISTS `signup_table`; 
CREATE TABLE `signup_table` ( `id` int(100) NOT NULL, 
	`firstname` varchar(200) NOT NULL, 
	`lastname` varchar(200) NOT NULL, 
	`email` varchar(200) NOT NULL, 
	`password` varchar(200) NOT NULL, 
	`log_date` datetime NOT NULL, 
	`login_status` int(11) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- admin table

DROP TABLE IF EXISTS `ad_table`; CREATE TABLE `ad_table` ( `id` int(100) NOT NULL, 
	`firstname` varchar(200) NOT NULL, 
	`lastname` varchar(200) NOT NULL, 
	`ademail` varchar(200) NOT NULL, 
	`adpassword` varchar(200) NOT NULL, 
	`log_date` datetime NOT NULL, 
	`login_status` int(11) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Feedback table
DROP TABLE IF EXISTS `feed_table`; 
CREATE TABLE `feed_table` ( `id` int(100) NOT NULL, 
  `unique4` varchar(10) NOT NULL, 
  `feed` varchar(300) NOT NULL,  
  `feed_date` datetime NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- staff list

DROP TABLE IF EXISTS `empda`;

CREATE TABLE `empda` (
  `id` int(22) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `attempts` (
  `ip` varchar(20) NOT NULL,
  `when` datetime NOT NULL,
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DURODOLA DAYO AHMEED
OKEDIYA OKESHOLA GBENGA
AKINTOTU ANDREW DICKSON 
TAIWO OLANREWAJU MICHAEL 
ADEYINKA ADENIYI
CHUKWUEMEKA ANI
ERUM OKECHUKWU SAMUEL
OMINIGBO PETER
OTOLOTA FAVOUR 
OLAYIWOLA AKINKUNMI
CYRIACUS ONYEWU
UMAH DAVID SAMUEL 
IFECHUKWU JOSEPH CHUKWUMA 
EJEMBI SUNDAY 
OBI VICTOR OGAGA
ADEBAYO SULAIMAN 
OYANNA GODWIN OSHIREKU
AKHIMIEN CLIFFORD ERUMOSE
IBANGA CHRISTOPHER UMOH
ISHOLA KARIM JAIYESIMI
ISRAEL EMMANUEL NDUBUISI 
MOSES ONYEKACHI UZOMA
JOHN AYUBA
ENEFAZU OGHALE AENEAS
ABAWUNMI ABIDEMI OLABISI 
EMEH JOHNSON CHIEDOZIE
INYANG DAVID UDEME
AJETOMOBI ADEMOLA 
IBIYEMI MALEEK LUKUMON
ODAFE ELOHOR DANIEL
ENIAIYEKAN CHRISTIANA ANUOLU
OBI IFEANYICHUKWU HENRY
HUSSENI JOHNSON ENEJOH
NWANJI PETER C.
ETEFIA IBORO
OGUNDIPE OLUSEGUN
EZE CHRISTIAN Y.
KANENE CHEKWUME H
SULAIMON YUSUF A
UGWUJA SAMUEL U.
OYELEYE KELVIN K.
SHITTU SIKIRU


ALTER TABLE `users` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;