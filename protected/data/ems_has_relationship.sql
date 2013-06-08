-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2013 at 12:10 PM
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
  `activity_date` int(11) NOT NULL COMMENT 'Activity Date',
  `user_id` int(11) unsigned NOT NULL COMMENT 'ID of User execute action',
  `activity_type` int(11) unsigned NOT NULL COMMENT 'Activity Type',
  `action_group` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Action Group',
  `action_id` int(11) unsigned NOT NULL COMMENT 'ID of user been action',
  `ip_logged` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'IP Adrress',
  PRIMARY KEY (`id`),
  KEY `FK_activity_log_1` (`user_id`),
  KEY `FK_activity_log_2` (`action_id`),
  KEY `FK_activity_log_3` (`activity_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `activity_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `activity_type`
--

CREATE TABLE IF NOT EXISTS `activity_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `activity_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Activity Description',
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
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  KEY `FK_authassignment` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1', NULL, 'N;'),
('admin', '2', NULL, 'N;'),
('user', '3', NULL, 'N;');

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
('accountant', 2, 'EMS''s Accountant', NULL, 'N;'),
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
('accountant', 'user'),
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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `contract_start_date` int(11) NOT NULL COMMENT 'Contract start date',
  `contract_length` int(11) NOT NULL COMMENT 'Month',
  `contract_end_date` int(11) NOT NULL COMMENT 'Contract end date',
  `contract_stop_date` int(11) DEFAULT NULL COMMENT 'Contract stop date',
  `contract_stop_reason` varchar(1000) DEFAULT NULL COMMENT 'Reason stop contract',
  `type` enum('Probation Contract','Limitation Contract','Non Limitation Contract') NOT NULL COMMENT 'Contract Type',
  `employee_id` int(11) unsigned NOT NULL COMMENT 'Employee ID',
  `crreated_id` int(11) unsigned NOT NULL COMMENT 'Created ID',
  `updated_id` int(11) unsigned DEFAULT NULL COMMENT 'Updated ID',
  `contract_status` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '1: working; 0: non-working;',
  `created_date` int(11) DEFAULT NULL COMMENT 'Contract Created Date',
  `updated_date` int(11) DEFAULT NULL COMMENT 'Contract updated Date',
  PRIMARY KEY (`id`),
  KEY `FK_contract_1` (`employee_id`),
  KEY `FK_contract_2` (`crreated_id`),
  KEY `FK_contract_3` (`updated_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contract`
--


-- --------------------------------------------------------

--
-- Table structure for table `contract_salary`
--

CREATE TABLE IF NOT EXISTS `contract_salary` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `contract_start_date` int(11) DEFAULT NULL COMMENT 'Contract Start Date',
  `contract_end_date` int(11) DEFAULT NULL COMMENT 'Contract End Date',
  `contract_id` int(11) unsigned NOT NULL COMMENT 'Contract ID',
  `gross_salary` decimal(10,2) NOT NULL COMMENT 'Employee Gross Salary',
  `net_salary` decimal(10,2) NOT NULL COMMENT 'Employee Net Salary',
  `petrol_allowance` decimal(10,2) DEFAULT NULL COMMENT 'Employee Petrol Allowance',
  `lunch_allowance` decimal(10,2) DEFAULT NULL COMMENT 'Employee Lunch Allowance',
  `other_allowance` decimal(10,2) DEFAULT NULL COMMENT 'Employee Other Allowance',
  PRIMARY KEY (`id`),
  KEY `FK_contract_salary_1` (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contract_salary`
--


-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Department Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Accounting'),
(2, 'Human Resource'),
(3, 'Management'),
(4, 'Software');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) unsigned NOT NULL COMMENT 'Employee ID',
  `job_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Employee Job Title',
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
  `department_id` int(11) unsigned NOT NULL COMMENT 'Department ID',
  `created_date` int(11) DEFAULT NULL COMMENT 'Employee Created Date',
  `updated_date` int(11) DEFAULT NULL COMMENT 'Employee Updated Date',
  `personal_email` varchar(255) DEFAULT NULL COMMENT 'Employee Personal Email',
  PRIMARY KEY (`id`),
  KEY `FK_employee_2` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `job_title`, `degree`, `background`, `telephone`, `mobile`, `homeaddress`, `education`, `skill`, `experience`, `notes`, `avatar`, `cv`, `department_id`, `created_date`, `updated_date`, `personal_email`) VALUES
(2, 'Senior Developer', 'Bachelors', 'IT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1370427816, 1370427816, NULL),
(3, 'Developer I', 'Bachelors', 'IT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1370429069, 1370429069, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_vacation`
--

CREATE TABLE IF NOT EXISTS `employee_vacation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yearly_date` int(11) DEFAULT NULL COMMENT 'Number Vacation Date Yearly',
  `remaining_vacation` int(11) DEFAULT NULL COMMENT 'Remaining Vacation in Current Year',
  `employee_id` int(11) unsigned DEFAULT NULL COMMENT 'Employee ID',
  `year` int(11) DEFAULT NULL,
  `total_day_off` int(11) DEFAULT NULL COMMENT 'Total Date off in Current Year',
  `pre_year_date` int(11) DEFAULT NULL COMMENT 'Number Remaining Vacation in Last Year',
  PRIMARY KEY (`id`),
  KEY `FK_employee_vacation_1` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `employee_vacation`
--


-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `types` int(11) unsigned NOT NULL COMMENT 'Message''s type',
  `status` int(11) unsigned DEFAULT NULL COMMENT 'Message''s status',
  `created_date` int(11) DEFAULT NULL COMMENT 'Created Date',
  `message_info` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Message Content',
  `mod_user_id` int(11) unsigned NOT NULL COMMENT 'Receiver ID',
  `mod_sender_id` int(11) unsigned NOT NULL COMMENT 'Sender ID',
  `title` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Title',
  PRIMARY KEY (`id`),
  KEY `FK_message_1` (`mod_user_id`),
  KEY `FK_message_2` (`mod_sender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `message`
--


-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Monthly Salary',
  `employee_id` int(11) unsigned DEFAULT NULL COMMENT 'Employee ID',
  `net_salary` decimal(10,2) unsigned DEFAULT NULL COMMENT 'Employee Net Salary',
  `gross_salary` decimal(10,2) unsigned DEFAULT NULL COMMENT 'Employee Gross Salary',
  `month` int(11) unsigned DEFAULT NULL,
  `year` int(11) unsigned DEFAULT NULL,
  `petrol_allowance` decimal(10,2) DEFAULT NULL COMMENT 'Employee Petrol Allowance',
  `lunch_allowance` decimal(10,2) DEFAULT NULL COMMENT 'Employee Lunch Allowance',
  `other_allowance` decimal(10,2) DEFAULT NULL COMMENT 'Employee Other Allowance',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'Exchange Rate',
  PRIMARY KEY (`id`),
  UNIQUE KEY `SALARY_UNIQUE` (`employee_id`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `salary`
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
  `dob` int(11) NOT NULL COMMENT 'Date of Birth',
  `password` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Password',
  `activkey` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User Activkey',
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'User Status: 0 Noactive, 1 Active, 2 Banned',
  `lastvisit` int(11) DEFAULT NULL COMMENT 'User Lastvisit',
  `created_date` int(11) DEFAULT NULL COMMENT 'User Create Date',
  `type` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '0: Non Supper Admin, 1: Supper Admin',
  `updated_date` int(11) DEFAULT NULL COMMENT 'User Update Date',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `fullname`, `email`, `dob`, `password`, `activkey`, `status`, `lastvisit`, `created_date`, `type`, `updated_date`) VALUES
(1, 'Admin', 'EMS', 'Admin EMS', 'adm.ems.project@gmail.com', 561196800, '61bd60c60d9fb60cc8fc7767669d40a1', NULL, 1, 1370533160, 1370073600, 1, 1370533160),
(2, 'Tuyen', 'Nguyen', 'Nguyen Thi Tuyen', 'thituyen24@gmail.com', 638443415, '61bd60c60d9fb60cc8fc7767669d40a1', NULL, 1, 1370570901, 1370427816, 0, 1370570901),
(3, 'Tuan', 'Tran', 'Tran Thanh Tuan', 'tuandeveloper@gmail.com', 561219955, '61bd60c60d9fb60cc8fc7767669d40a1', NULL, 1, 1370533120, 1370429069, 0, 1370533120);

-- --------------------------------------------------------

--
-- Table structure for table `vacation`
--

CREATE TABLE IF NOT EXISTS `vacation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `start_date` int(11) NOT NULL COMMENT 'Vacation start date',
  `end_date` int(11) NOT NULL COMMENT 'Vacation end date',
  `total_date` decimal(4,1) NOT NULL COMMENT 'Vacation total date',
  `type` int(11) NOT NULL COMMENT '1:vacation, 2:illness, 3:wedding, 4:bereavement, 5:maternity;',
  `reason` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Reason for Vacation',
  `user_id` int(11) unsigned NOT NULL COMMENT 'User Request Vacation',
  `approve_id` int(11) unsigned DEFAULT NULL COMMENT 'User Approve Vacation',
  `created_date` int(11) DEFAULT NULL COMMENT 'Vacation Created Date',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:waiting, 2:pending, 3:accept, 4:cancel, 5:decline;',
  `updated_date` int(11) DEFAULT NULL COMMENT 'Vacation Updated Date',
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
  ADD CONSTRAINT `FK_activity_log_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_activity_log_2` FOREIGN KEY (`action_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_activity_log_3` FOREIGN KEY (`activity_type`) REFERENCES `activity_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
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
  ADD CONSTRAINT `FK_contract_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_contract_2` FOREIGN KEY (`crreated_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_contract_3` FOREIGN KEY (`updated_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contract_salary`
--
ALTER TABLE `contract_salary`
  ADD CONSTRAINT `FK_contract_salary_1` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_employee_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_employee_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_vacation`
--
ALTER TABLE `employee_vacation`
  ADD CONSTRAINT `FK_employee_vacation_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_1` FOREIGN KEY (`mod_user_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_message_2` FOREIGN KEY (`mod_sender_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `FK_salary_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vacation`
--
ALTER TABLE `vacation`
  ADD CONSTRAINT `FK_vacation_1` FOREIGN KEY (`user_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_vacation_2` FOREIGN KEY (`approve_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
