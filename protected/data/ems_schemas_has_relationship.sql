-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2013 at 08:11 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activity_date` datetime DEFAULT NULL COMMENT 'Activity Date',
  `user_id` int(11) unsigned NOT NULL COMMENT 'ID of User execute action',
  `activity_type` int(11) unsigned DEFAULT NULL COMMENT 'Activity Type',
  `action_group` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Action Group',
  `action_id` int(11) unsigned DEFAULT NULL COMMENT 'ID of user been action',
  `ip_logged` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'IP Adrress',
  PRIMARY KEY (`id`),
  KEY `FK_activity_log_1` (`activity_type`),
  KEY `FK_activity_log_2` (`user_id`),
  KEY `FK_activity_log_3` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `activity_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `activity_type`
--

CREATE TABLE IF NOT EXISTS `activity_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activity_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `activity_type`
--

INSERT INTO `activity_type` (`id`, `activity_description`) VALUES
(1, 'log in'),
(2, 'log out'),
(3, 'create user'),
(4, 'view user'),
(5, 'edit user'),
(6, 'manage user'),
(7, 'deactivate user'),
(8, 'activate user'),
(9, 'create profile'),
(10, 'view profile'),
(11, 'edit profile'),
(12, 'manage profile'),
(13, 'view owner profile'),
(14, 'edit owner profile'),
(15, 'create vacation'),
(16, 'view vacation'),
(17, 'edit vacation'),
(18, 'manage vacation'),
(19, 'view owner vacation'),
(20, 'edit owner vacation');

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  KEY `FK_authassignment` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--


-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('account', 2, 'EMS''s Account', NULL, 'N;'),
('activateUser', 0, 'Activate a user', NULL, 'N;'),
('admin', 2, 'EMS''s Admin', NULL, 'N;'),
('createProfile', 0, 'Create a Profile', NULL, 'N;'),
('createUser', 0, 'Create a new user', NULL, 'N;'),
('createVacation', 0, 'Create a Vacation', NULL, 'N;'),
('deactivateUser', 0, 'Deactivate a User', NULL, 'N;'),
('editProfile', 0, 'Edit a Profile', NULL, 'N;'),
('editProfileOwner', 1, 'Edit Profile Owner', NULL, 'N;'),
('editUser', 0, 'Edit User''s Infomation', NULL, 'N;'),
('editVacation', 0, 'Edit Vacation', NULL, 'N;'),
('editVacationOwner', 1, 'Edit Vacation Owner', NULL, 'N;'),
('hr', 2, 'EMS''s HR', NULL, 'N;'),
('leader', 2, 'EMS''s Leader', NULL, 'N;'),
('manageProfile', 0, 'Profile Management', NULL, 'N;'),
('manager', 2, 'EMS''s Manager', NULL, 'N;'),
('manageUser', 0, 'User Management', NULL, 'N;'),
('manageVacation', 0, 'Manage Vacation', NULL, 'N;'),
('user', 2, 'EMS''s User', NULL, 'N;'),
('viewProfile', 0, 'View a Profile', NULL, 'N;'),
('viewProfileOwner', 1, 'View Profile Owner', NULL, 'N;'),
('viewUser', 0, 'View User''s Infomation', NULL, 'N;'),
('viewVacation', 0, 'view Vacation', NULL, 'N;'),
('viewVacationOwner', 1, 'view Vacation Owner', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('manager', 'activateUser'),
('leader', 'createProfile'),
('leader', 'createUser'),
('user', 'createVacation'),
('manager', 'deactivateUser'),
('leader', 'editProfile'),
('editProfile', 'editProfileOwner'),
('user', 'editProfileOwner'),
('leader', 'editUser'),
('editVacation', 'editVacationOwner'),
('user', 'editVacationOwner'),
('manager', 'leader'),
('leader', 'manageProfile'),
('admin', 'manager'),
('leader', 'manageUser'),
('hr', 'manageVacation'),
('leader', 'manageVacation'),
('account', 'user'),
('hr', 'user'),
('leader', 'user'),
('leader', 'viewProfile'),
('user', 'viewProfileOwner'),
('viewProfile', 'viewProfileOwner'),
('leader', 'viewUser'),
('hr', 'viewVacation'),
('leader', 'viewVacation'),
('user', 'viewVacationOwner'),
('viewVacation', 'viewVacationOwner');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE IF NOT EXISTS `contract` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Contract User',
  `contract_start_date` datetime DEFAULT NULL COMMENT 'Contract start date',
  `contract_length` int(11) DEFAULT NULL COMMENT 'Month',
  `contract_end_date` datetime DEFAULT NULL COMMENT 'Contract end date',
  `contract_stop_date` datetime DEFAULT NULL COMMENT 'Contract stop date',
  `contract_stop_reason` varchar(1000) DEFAULT NULL COMMENT 'Reason stop contract',
  `contract_status` int(11) unsigned DEFAULT '1' COMMENT '1: working; 0: non-working;',
  `price` float unsigned DEFAULT NULL COMMENT 'Exchange Rate',
  `gross_salary` float unsigned DEFAULT NULL COMMENT 'User Gross Salary',
  `net_salary` float unsigned DEFAULT NULL COMMENT 'User Net Salary',
  `petrol_allowance` float unsigned DEFAULT NULL COMMENT 'User Petrol Allowance',
  `lunch_allowance` float unsigned DEFAULT NULL COMMENT 'User Lunch Allowance',
  `other_allowance` float unsigned DEFAULT NULL COMMENT 'User Other Allowance',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contract`
--


-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` enum('Accounting','Human Resource','Management','Software') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Department Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `department`
--


-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Employee ID',
  `probation_start_date` datetime DEFAULT NULL COMMENT 'probation start date',
  `probation_length` int(11) DEFAULT NULL COMMENT 'Month',
  `probation_end_date` datetime DEFAULT NULL COMMENT 'probation end date',
  `job_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Employee Job Title',
  `degree` enum('Associates','Diploma/Certificate','Bachelors','Masters','Doctorate','N/A') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Degree Type',
  `background` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Background of Employee',
  `telephone` int(11) unsigned DEFAULT NULL,
  `mobile` int(11) unsigned DEFAULT NULL,
  `homeaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Employee Home Address',
  `education` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Employee Education',
  `skill` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Employee Skills',
  `experience` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Employee Experience',
  `notes` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Employee Notes',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Employee Avatar',
  `cv` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Employee CV',
  `department_id` int(11) unsigned DEFAULT NULL COMMENT 'Department ID',
  PRIMARY KEY (`id`),
  KEY `FK_employee_2` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `employee`
--


-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `types` int(11) unsigned DEFAULT NULL COMMENT 'Message''s type',
  `status` int(11) unsigned DEFAULT NULL COMMENT 'Message''s status',
  `created_date` datetime DEFAULT NULL COMMENT 'Created Date',
  `message_info` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Message Content',
  `mod_user_id` int(11) unsigned DEFAULT NULL COMMENT 'Receiver ID',
  `mod_sender_id` int(11) unsigned DEFAULT NULL COMMENT 'Sender ID',
  `title` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Title',
  PRIMARY KEY (`id`),
  KEY `FK_message_1` (`mod_user_id`),
  KEY `FK_message_2` (`mod_sender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `message`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'User First Name',
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Last Name',
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Full Name',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Email',
  `dob` datetime DEFAULT NULL COMMENT 'Date of Birth',
  `password` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User Password',
  `activkey` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User Activkey',
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'User Status: 0 Noactive, 1 Active, 2 Banned',
  `lastvisit` datetime DEFAULT NULL COMMENT 'User Lastvisit',
  `created_date` datetime DEFAULT NULL COMMENT 'User Create Date',
  `department_id` int(11) unsigned DEFAULT NULL COMMENT 'Department ID',
  `type` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '0: Non Supper Admin, 1: Supper Admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user`
--


-- --------------------------------------------------------

--
-- Table structure for table `vacation`
--

CREATE TABLE IF NOT EXISTS `vacation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `start_date` datetime NOT NULL COMMENT 'Vacation start date',
  `end_date` datetime NOT NULL COMMENT 'Vacation end date',
  `total_date` decimal(4,1) NOT NULL COMMENT 'Vacation total date',
  `type` int(11) NOT NULL COMMENT '1:vacation, 2:illness, 3:wedding, 4:bereavement, 5:maternity;',
  `reason` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Reason for Vacation',
  `user_id` int(11) unsigned NOT NULL COMMENT 'User Request Vacation',
  `approve_id` int(11) unsigned DEFAULT NULL COMMENT 'User Approve Vacation',
  `request_date` datetime NOT NULL COMMENT 'Vacation Request date',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:waiting, 2:pending, 3:accept, 4:cancel, 5:decline;',
  PRIMARY KEY (`id`),
  KEY `FK_vacation_1` (`user_id`),
  KEY `FK_vacation_2` (`approve_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vacation`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `FK_activity_log_3` FOREIGN KEY (`action_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_activity_log_1` FOREIGN KEY (`activity_type`) REFERENCES `activity_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_activity_log_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `FK_authassignment` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `FK_contract_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_employee_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_employee` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_2` FOREIGN KEY (`mod_sender_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_message_1` FOREIGN KEY (`mod_user_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vacation`
--
ALTER TABLE `vacation`
  ADD CONSTRAINT `FK_vacation_2` FOREIGN KEY (`approve_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_vacation_1` FOREIGN KEY (`user_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
