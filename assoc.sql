-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2016 at 06:10 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_guests`
--

CREATE TABLE `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_users`
--

INSERT INTO `active_users` (`username`, `timestamp`) VALUES
('admin', '0000-00-00 00:00:00'),
('chiarz', '0000-00-00 00:00:00'),
('chris', '0000-00-00 00:00:00'),
('JHING', '0000-00-00 00:00:00'),
('member', '0000-00-00 00:00:00'),
('SEMOS2016', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `assisted_view`
--
CREATE TABLE `assisted_view` (
`comp_id` int(11)
,`user_id` int(11)
,`dept_id` int(11)
,`ticket` varchar(255)
,`cat_comp_id` int(11)
,`cat_spec_id` int(11)
,`cat_con_id` int(11)
,`subject` varchar(255)
,`description` varchar(500)
,`remarks` varchar(500)
,`file` varchar(255)
,`status` int(1)
,`claimed` varchar(255)
,`req_date` timestamp
,`res_date` timestamp
,`Assisted` varchar(511)
);

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cat_comp`
--

CREATE TABLE `cat_comp` (
  `cat_comp_id` int(11) NOT NULL,
  `cat_complaint` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_comp`
--

INSERT INTO `cat_comp` (`cat_comp_id`, `cat_complaint`) VALUES
(1, 'Biomedical Complaints'),
(2, 'I.T. Issues'),
(3, 'maintenance concerns');

-- --------------------------------------------------------

--
-- Table structure for table `cat_conc`
--

CREATE TABLE `cat_conc` (
  `cat_con_id` int(11) NOT NULL,
  `cat_comp_id` int(11) DEFAULT NULL,
  `cat_spec_id` int(11) DEFAULT NULL,
  `cat_concern` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_conc`
--

INSERT INTO `cat_conc` (`cat_con_id`, `cat_comp_id`, `cat_spec_id`, `cat_concern`) VALUES
(1, 2, 1, 'data fixing / system error'),
(2, 2, 1, 'credit note /post charge/ merging/ etc'),
(3, 2, 1, 'OTHERS'),
(5, 2, 2, 'TRANSMITTAL ISSUES'),
(6, 2, 2, 'ACCOUNT CONCERNS'),
(7, 2, 2, 'OTHERS'),
(8, 2, 3, 'SYSTEM ERROR'),
(9, 2, 3, 'NO CONNECTION'),
(10, 2, 3, 'OTHERS'),
(11, 2, 4, 'COMPUTER ERROR'),
(12, 2, 4, 'PRINTER ERROR'),
(13, 2, 4, 'CONNECTIVITY ISSUES'),
(14, 2, 4, 'MONITOR ISSUES'),
(15, 2, 4, 'others'),
(16, 3, 5, 'outlet, wires'),
(17, 3, 5, 'light bulbs'),
(18, 3, 5, 'ups / power supply'),
(19, 3, 5, 'others'),
(20, 3, 6, 'cleaning'),
(21, 3, 6, 'repair'),
(22, 3, 6, 'others'),
(23, 3, 7, 'pipes'),
(24, 3, 7, 'faucets'),
(25, 3, 7, 'others'),
(26, 3, 8, 'furniture repairs'),
(27, 3, 8, 'customized furnitures'),
(28, 3, 8, 'others'),
(29, 1, 9, 'c - arm');

-- --------------------------------------------------------

--
-- Table structure for table `cat_spec`
--

CREATE TABLE `cat_spec` (
  `cat_spec_id` int(11) NOT NULL,
  `cat_comp_id` int(11) DEFAULT NULL,
  `cat_specific` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_spec`
--

INSERT INTO `cat_spec` (`cat_spec_id`, `cat_comp_id`, `cat_specific`) VALUES
(1, 2, 'bizbox concerns'),
(2, 2, 'lis - laboratory system'),
(3, 2, 'ris - pacs viewer'),
(4, 2, 'computer hardware & peripheralS'),
(5, 3, 'electrical'),
(6, 3, 'aircon concerns'),
(7, 3, 'PLUMBING CONCERNS'),
(8, 3, 'CARPENTRY CONCERNS'),
(9, 1, 'ct scan machines');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `comp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `ticket` varchar(255) NOT NULL DEFAULT '0000',
  `cat_comp_id` int(11) NOT NULL,
  `cat_spec_id` int(11) NOT NULL,
  `cat_con_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `assisted` varchar(255) NOT NULL COMMENT 'user who assist the complaint',
  `claimed` varchar(255) NOT NULL COMMENT 'user who accept the complaint if the first user who assist the complaint can''t fix the issue',
  `req_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `res_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`comp_id`, `user_id`, `dept_id`, `ticket`, `cat_comp_id`, `cat_spec_id`, `cat_con_id`, `subject`, `description`, `remarks`, `file`, `status`, `assisted`, `claimed`, `req_date`, `res_date`) VALUES
(1, 3, 18, 'CN-0001', 2, 1, 1, 'examination upshots erro', 'unable to generate reports', 'repaired examination template', '', 5, 'LOUIE GIBERSON', '', '2016-12-05 01:20:26', '2016-12-05 01:21:59'),
(2, 3, 18, 'CN-0002', 3, 6, 21, 'hema aircon', 'not turning on', 'fixed broken wire', '', 5, 'christian escol', '', '2016-12-05 01:35:42', '2016-12-05 01:37:37'),
(3, 3, 18, 'CN-0003', 1, 9, 29, 'not working', 'needs repair', 'fixed lan', '', 5, 'LOUIE GIBERSON', '', '2016-12-05 01:40:54', '2016-12-05 01:41:20'),
(4, 3, 18, 'CN-0004', 1, 9, 29, 'tes', 'test', '', '', 2, 'LOUIE GIBERSON', '', '2016-12-05 01:41:52', '0000-00-00 00:00:00'),
(5, 3, 18, 'CN-0005', 2, 2, 5, 'test', 'test', '', '', 2, 'LOUIE GIBERSON', '', '2016-12-05 01:42:02', '0000-00-00 00:00:00'),
(6, 3, 18, 'CN-0006', 3, 5, 16, 'outlet', 'no power', '', '', 2, 'christian escol', '', '2016-12-05 01:42:14', '0000-00-00 00:00:00'),
(7, 3, 18, 'CN-0007', 2, 4, 12, 'hema printer', 'error 3306 occured', '', '', 0, '', '', '2016-12-05 02:32:34', '0000-00-00 00:00:00'),
(8, 3, 18, 'CN-0008', 2, 1, 1, 'or error', 'pt. ledesma', '', '', 1, 'LOUIE GIBERSON', '', '2016-12-05 02:33:01', '0000-00-00 00:00:00'),
(9, 3, 18, 'CN-0009', 1, 9, 29, 'OR 4 c arm', 'not turning on', '', '', 1, 'LOUIE GIBERSON', '', '2016-12-06 07:35:15', '0000-00-00 00:00:00'),
(10, 3, 18, 'CN-0010', 2, 2, 5, 'chem not transmitting', 'test', '', '', 1, 'LOUIE GIBERSON', '', '2016-12-14 06:08:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `comp_view`
--
CREATE TABLE `comp_view` (
`comp_id` int(11)
,`user_id` int(11)
,`dept_id` int(11)
,`ticket` varchar(255)
,`cat_comp_id` int(11)
,`cat_spec_id` int(11)
,`cat_con_id` int(11)
,`subject` varchar(255)
,`description` varchar(500)
,`remarks` varchar(500)
,`file` varchar(255)
,`status` int(1)
,`assisted` varchar(255)
,`claimed` varchar(255)
,`req_date` timestamp
,`res_date` timestamp
,`firstname` varchar(255)
,`lastname` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'I.T. Department'),
(2, 'maintenance department'),
(3, 'ACCOUNTING'),
(4, 'ADMIN'),
(5, 'ADMITTING'),
(6, 'BILLING'),
(7, 'CENTRAL SUPPLY'),
(8, 'DIALYSIS'),
(9, 'EEG / EMG'),
(10, 'EMERGENCY ROOM'),
(11, 'ENT'),
(12, 'FLOOR 2A'),
(13, 'FLOOR 2B'),
(14, 'FLOOR 2C'),
(15, 'FLOOR 3'),
(16, 'HEART STATION'),
(17, 'ICU'),
(18, 'LABORATORY'),
(19, 'MEDICAL RECORDS'),
(20, 'NICU/PICU/DELIVERY'),
(21, 'OPERATING ROOM'),
(22, 'OUTPATIENT  DEPT.'),
(23, 'PHARMACY'),
(24, 'PHYSICAL REHAB'),
(25, 'RADIOLOGY'),
(26, 'ULTRASOUND');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_users`
--

CREATE TABLE `maintenance_users` (
  `m_id` int(11) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `gender` int(1) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `ticket` varchar(255) NOT NULL,
  `cat_comp_id` int(11) NOT NULL,
  `cat_spec_id` int(11) NOT NULL,
  `cat_con_id` int(11) NOT NULL,
  `task_subject` varchar(255) NOT NULL,
  `task_desc` varchar(500) NOT NULL,
  `status` int(1) NOT NULL,
  `exec_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `res_date` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `exec_name` varchar(255) DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `ticket`, `cat_comp_id`, `cat_spec_id`, `cat_con_id`, `task_subject`, `task_desc`, `status`, `exec_date`, `res_date`, `user_id`, `exec_name`, `m_id`) VALUES
(1, 'MN-0001', 2, 4, 15, 'cpu cleaning', 'cleaning', 0, '2016-12-05 01:50:54', '0000-00-00 00:00:00', 1, 'LOUIE GIBERSON', NULL),
(2, 'MN-0002', 3, 5, 16, 'laboratory', 'needs new outlet for machine', 0, '2016-12-05 01:51:23', '0000-00-00 00:00:00', 2, 'CHRISTIAN ESCOL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `userlevel` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `salt`, `userid`, `userlevel`, `email`, `timestamp`, `firstname`, `lastname`, `gender`, `bday`, `photo`, `contact`, `address`, `dept_id`) VALUES
(1, 'SEMOS2016', '4e8e26fc1f0a0100a14bd1108a31c133152538aabcbf9e1f378cc5f44e8109897f01c661ecb8330dae28440984f04600a23241a45b55825a9afce037530ba833', '970badc3a8f24089e94de654362b426b106bf9b27a3ca99cdec3ec9b18d3fce76f9038e0f9197176f34ad27ab9935d663e597e71297c2298a89807b0206e3c94', 'a164d558f184718440bb32c93c5baae0', 9, '', '0000-00-00 00:00:00', 'LOUIE', 'GIBERSON', '', '', '', '', '', 1),
(2, 'chris', 'c5c0253d23730089525499fb4798b6b426320be24f6e921266f5c21ee6091c52e7be27fa9235c09ae66e4f2fbf204cc3d9978eb6c7e36722c309022303a01358', 'e5b133458e7de3b1c2324913ecc7b9181b1a49cdf7261d5519972adb0d795ce5874b308a5111893936cc1451502e478b6d70a30e700931ef0b4bb0e90fcb3345', 'dfd71b541039c660330d29bdaadc2b25', 8, '', '0000-00-00 00:00:00', 'christian', 'escol', '1', '', '', '', '', 2),
(3, 'JHING', '84ef4b079268f5914a870e3899afc54931d62850ba173e55a3bc002724b2835e4118f8ca8190a770a29cd4ace518f81841529a19d589c99ed3a98133b22b4548', 'a915479df9b6b2cf2ee41e2fc20864d9ccbba86a6fa5bf21ede09d317f7ba31e14173055b58c9bfb9a3f7f7de58f1651bfb0feca7a63bb1167def0928d504770', 'bd81b6580d059330cf20e019d1636ed7', 1, '', '0000-00-00 00:00:00', 'lovella girlie', 'lacierda', '', '', '', '', '', 18),
(4, 'chiarz', '9e0192f77ef55497239ea02a5222a198cd7d90f07a6db752f6d098a87e9c677242817196e5f1edbf213138fa35b25839955e87dac81644e9280ba13113d25b7f', '2ed0f131afd8070f155288c2162770284cbb9bb60e0b02061acaef153a86eb29cd8b31dcf39c50ca314ccb2f9c06e27d589b51c1b9f67d57e50b7e178d8d16b0', '5eef90c015e5e2ce0532d002d7029a83', 7, '', '0000-00-00 00:00:00', 'maria chiara', 'estacio', '2', '', '', '', '', 4);

-- --------------------------------------------------------

--
-- Structure for view `assisted_view`
--
DROP TABLE IF EXISTS `assisted_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `assisted_view`  AS  select `complaint`.`comp_id` AS `comp_id`,`complaint`.`user_id` AS `user_id`,`complaint`.`dept_id` AS `dept_id`,`complaint`.`ticket` AS `ticket`,`complaint`.`cat_comp_id` AS `cat_comp_id`,`complaint`.`cat_spec_id` AS `cat_spec_id`,`complaint`.`cat_con_id` AS `cat_con_id`,`complaint`.`subject` AS `subject`,`complaint`.`description` AS `description`,`complaint`.`remarks` AS `remarks`,`complaint`.`file` AS `file`,`complaint`.`status` AS `status`,`complaint`.`claimed` AS `claimed`,`complaint`.`req_date` AS `req_date`,`complaint`.`res_date` AS `res_date`,concat(`users`.`firstname`,' ',`users`.`lastname`) AS `Assisted` from (`complaint` join `users` on((`complaint`.`assisted` = `users`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `comp_view`
--
DROP TABLE IF EXISTS `comp_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `comp_view`  AS  select `complaint`.`comp_id` AS `comp_id`,`complaint`.`user_id` AS `user_id`,`complaint`.`dept_id` AS `dept_id`,`complaint`.`ticket` AS `ticket`,`complaint`.`cat_comp_id` AS `cat_comp_id`,`complaint`.`cat_spec_id` AS `cat_spec_id`,`complaint`.`cat_con_id` AS `cat_con_id`,`complaint`.`subject` AS `subject`,`complaint`.`description` AS `description`,`complaint`.`remarks` AS `remarks`,`complaint`.`file` AS `file`,`complaint`.`status` AS `status`,`complaint`.`assisted` AS `assisted`,`complaint`.`claimed` AS `claimed`,`complaint`.`req_date` AS `req_date`,`complaint`.`res_date` AS `res_date`,`users`.`firstname` AS `firstname`,`users`.`lastname` AS `lastname` from ((((`complaint` join `cat_conc` on((`complaint`.`cat_con_id` = `cat_conc`.`cat_con_id`))) join `cat_comp` on((`complaint`.`cat_comp_id` = `cat_comp`.`cat_comp_id`))) join `cat_spec` on((`complaint`.`cat_spec_id` = `cat_spec`.`cat_spec_id`))) join `users` on((`users`.`user_id` = `complaint`.`user_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_guests`
--
ALTER TABLE `active_guests`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `banned_users`
--
ALTER TABLE `banned_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `cat_comp`
--
ALTER TABLE `cat_comp`
  ADD PRIMARY KEY (`cat_comp_id`);

--
-- Indexes for table `cat_conc`
--
ALTER TABLE `cat_conc`
  ADD PRIMARY KEY (`cat_con_id`);

--
-- Indexes for table `cat_spec`
--
ALTER TABLE `cat_spec`
  ADD PRIMARY KEY (`cat_spec_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `maintenance_users`
--
ALTER TABLE `maintenance_users`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_comp`
--
ALTER TABLE `cat_comp`
  MODIFY `cat_comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cat_conc`
--
ALTER TABLE `cat_conc`
  MODIFY `cat_con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `cat_spec`
--
ALTER TABLE `cat_spec`
  MODIFY `cat_spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `maintenance_users`
--
ALTER TABLE `maintenance_users`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
