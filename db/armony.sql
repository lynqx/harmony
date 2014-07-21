-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2014 at 12:36 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `armony`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getContributionBalance`(`cooperatorId` INT) RETURNS decimal(10,0)
    COMMENT 'Gets the balance of the implied cooperator'
BEGIN
declare contrib_amount decimal(10,0);
select SUM(amount) as vl into contrib_amount from transactions where cooperator_id=cooperatorId and transaction_type='contribution';
return contrib_amount;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `userIsInGroup`(`UserId` INT, `groupID` INT) RETURNS bit(1)
BEGIN
return 0;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_actions`
--

CREATE TABLE IF NOT EXISTS `admin_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `basicsettings`
--

CREATE TABLE IF NOT EXISTS `basicsettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(255) DEFAULT NULL,
  `shortname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `monthEndDay` int(11) NOT NULL,
  `yearEndMonth` varchar(255) DEFAULT NULL,
  `monthlyReports` varchar(255) DEFAULT NULL,
  `monthlyReportsFolder` varchar(255) DEFAULT NULL,
  `minSavingAmount` double NOT NULL,
  `rescheduleDateLimit` int(11) NOT NULL,
  `interestSavings` double NOT NULL,
  `adminWithdrawCharge` bit(1) NOT NULL,
  `adminWithdrawChargeFixed` bit(1) NOT NULL,
  `adminWithdrawChargeAmount` double NOT NULL,
  `registrationFee` double NOT NULL,
  `showWelcomePopup` bit(1) NOT NULL,
  `lockMonthEnd` bit(1) DEFAULT NULL,
  `salariesFileLoaded` bit(1) DEFAULT NULL,
  `enableInvAcc` bit(1) DEFAULT NULL,
  `last_update` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `basicsettings`
--

INSERT INTO `basicsettings` (`id`, `companyname`, `shortname`, `address`, `phone`, `email`, `monthEndDay`, `yearEndMonth`, `monthlyReports`, `monthlyReportsFolder`, `minSavingAmount`, `rescheduleDateLimit`, `interestSavings`, `adminWithdrawCharge`, `adminWithdrawChargeFixed`, `adminWithdrawChargeAmount`, `registrationFee`, `showWelcomePopup`, `lockMonthEnd`, `salariesFileLoaded`, `enableInvAcc`, `last_update`) VALUES
(1, 'Armony CTCS Worldwide Portal', 'MEMCOS', 'Iyana Sasa, Ibadan Nigeria', '0900000000', 'memcos@memcos.com', 0, NULL, NULL, NULL, 5000, 5, 20, '1', '1', 10, 0, '1', NULL, NULL, NULL, '2014/02/08 09:33 pm');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `date_created`, `code`) VALUES
(1, 'Membership Requirements', '2014-07-08 14:18:48', 'membership'),
(2, 'Groups or Loans participation requirement', '2014-07-08 14:19:02', 'groups_participation'),
(3, 'Financial Requirements', '2014-07-08 14:19:10', 'financial_requirements');

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE IF NOT EXISTS `contributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT 'inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`id`, `name`, `description`, `date_created`, `status`) VALUES
(1, 'First Contribution', 'A test first contribution', '2014-07-06 09:10:26', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `contributions_rules`
--

CREATE TABLE IF NOT EXISTS `contributions_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribution_id` int(10) unsigned NOT NULL,
  `rule_title` varchar(150) NOT NULL,
  `category_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contribution_id` (`contribution_id`),
  KEY `rule_title` (`rule_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contributions_rules`
--

INSERT INTO `contributions_rules` (`id`, `contribution_id`, `rule_title`, `category_code`) VALUES
(2, 1, 'user_balance_greater_than_amount', 'membership');

-- --------------------------------------------------------

--
-- Table structure for table `contributions_settings`
--

CREATE TABLE IF NOT EXISTS `contributions_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribution_id` int(11) unsigned NOT NULL,
  `value` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`),
  KEY `FK_contribution_id` (`contribution_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contributions_settings`
--

INSERT INTO `contributions_settings` (`id`, `contribution_id`, `value`, `date_created`) VALUES
(1, 1, '1:::15000', '2014-07-06 09:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `cooperators`
--

CREATE TABLE IF NOT EXISTS `cooperators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `employee_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone_number` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `date_joined_company` datetime DEFAULT NULL,
  `date_approved` datetime NOT NULL,
  `home_address` varchar(100) NOT NULL,
  `home_town` varchar(100) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cooperators`
--

INSERT INTO `cooperators` (`id`, `user_id`, `employee_id`, `firstname`, `lastname`, `email`, `date_created`, `phone_number`, `gender`, `branch`, `date_joined_company`, `date_approved`, `home_address`, `home_town`, `image`) VALUES
(1, 1, '00001', 'Omomoh', 'Alabi', 'admin@harmony.com', '2014-06-29 19:27:30', '08063777394', 'male', 'whatever', '2014-06-26 00:00:00', '2014-06-27 00:00:00', 'Ibadan', 'Gombe', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `cooperators_bank_accounts`
--

CREATE TABLE IF NOT EXISTS `cooperators_bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cooperator_id` int(11) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `acount_name` varchar(70) NOT NULL,
  `account_number` varchar(70) NOT NULL,
  `branch` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cooperator_id` (`cooperator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cooperators_contributions`
--

CREATE TABLE IF NOT EXISTS `cooperators_contributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cooperator_id` int(11) NOT NULL,
  `contribution_id` int(10) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `contribution_id` (`contribution_id`),
  KEY `cooperator_id` (`cooperator_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cooperators_contributions`
--

INSERT INTO `cooperators_contributions` (`id`, `cooperator_id`, `contribution_id`, `date_created`) VALUES
(1, 1, 1, '2014-07-06 10:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `cooperators_groups`
--

CREATE TABLE IF NOT EXISTS `cooperators_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cooperator_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cooperator_id` (`cooperator_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(225) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans_rules`
--

CREATE TABLE IF NOT EXISTS `loans_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_title` varchar(150) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `loan_id` (`loan_id`),
  KEY `loans_rules_ibfk_2` (`rule_title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans_settings`
--

CREATE TABLE IF NOT EXISTS `loans_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `value` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `loan_id` (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `message` varchar(1500) NOT NULL,
  `date_sent` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `next_of_kin`
--

CREATE TABLE IF NOT EXISTS `next_of_kin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cooperator_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `Column 9` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cooperator_id` (`cooperator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The ID for available permissions',
  `title` varchar(255) NOT NULL COMMENT 'The title for the permissions.e.g. Can Add New User',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'The date of creation for the entry',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `date_created`) VALUES
(1, 'canUpdateProfile', '2014-01-22 06:56:15'),
(2, 'canReadDoc', '2014-01-25 17:11:28'),
(3, 'canViewAdmin', '2014-01-26 00:39:03'),
(4, 'canDoMemberTasks', '2014-01-30 16:37:21'),
(5, 'canViewMember', '2014-01-31 13:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `date_created`) VALUES
(1, 'admin', '2014-06-29 19:37:49'),
(2, 'member', '2014-07-21 19:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(3, 1, 2),
(4, 1, 3),
(5, 1, 4),
(7, 2, 1),
(8, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `title`, `description`, `date_created`) VALUES
(1, 'user_balance_greater_than_amount', 'The User''s balance is greater than the speculated amount', '2014-07-05 21:52:31'),
(2, 'user_must_belong_to_a_specific_group', 'The User must belong to a specific group', '2014-07-08 19:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `rules_categories`
--

CREATE TABLE IF NOT EXISTS `rules_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_title` varchar(150) NOT NULL,
  `category_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_rules_categories_fk02` (`category_code`),
  KEY `rule_title` (`rule_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This table maps rules to categories based on the general front end grouping' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rules_categories`
--

INSERT INTO `rules_categories` (`id`, `rule_title`, `category_code`) VALUES
(1, 'user_balance_greater_than_amount', 'membership');

-- --------------------------------------------------------

--
-- Table structure for table `rules_settings`
--

CREATE TABLE IF NOT EXISTS `rules_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `rule_id` (`rule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rule_definitions`
--

CREATE TABLE IF NOT EXISTS `rule_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) DEFAULT NULL,
  `rule_title` varchar(150) DEFAULT NULL,
  `rules_def` varchar(1500) DEFAULT NULL,
  `require_settings` bit(1) DEFAULT NULL COMMENT 'This helps to know if a rule requires settings',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rule_id` (`rule_id`),
  KEY `rule_definitions_ibfk_2` (`rule_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rule_definitions`
--

INSERT INTO `rule_definitions` (`id`, `rule_id`, `rule_title`, `rules_def`, `require_settings`, `date_created`) VALUES
(1, 1, 'user_balance_greater_than_amount', 'select (getContributionBalance(?) > ? , true,false) as vl', '1', '2014-07-08 17:56:52'),
(2, 2, 'user_must_belong_to_a_specific_group', NULL, NULL, '2014-07-08 19:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'self-service', 'on'),
(2, 'admin', 'on'),
(3, 'groups', 'on'),
(4, 'notifications', 'on'),
(5, 'sitename', 'Armony Software'),
(6, 'show_sitename', 'on'),
(7, 'show_logo', 'off'),
(8, 'logo', 'knights.jpg'),
(9, 'show_favicon', 'on'),
(10, 'favicon', 'favicon.ico'),
(11, 'show_footer', 'on'),
(12, 'footername', 'MEMCOS'),
(13, 'address', 'Iyana Sasa, Ibadan Nigeria'),
(14, 'email', 'memcos@memcos.biz'),
(15, 'mobile', '090007785774');

-- --------------------------------------------------------

--
-- Table structure for table `site_content`
--

CREATE TABLE IF NOT EXISTS `site_content` (
  `content_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The ID for the site CMS contents',
  `author_id` int(5) NOT NULL COMMENT 'id of the admin user who posted the content gotten from session data',
  `title` varchar(550) DEFAULT NULL COMMENT 'The title for a page',
  `alias` varchar(32) NOT NULL COMMENT 'required for display as links in the nav',
  `slug` varchar(256) NOT NULL,
  `content` longtext COMMENT 'The text content',
  `published` varchar(32) NOT NULL,
  `updated` int(2) NOT NULL DEFAULT '0',
  `access` int(2) NOT NULL COMMENT 'to determine permissions and grant access',
  `date_created` varchar(25) NOT NULL COMMENT 'The date of creation',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `site_content`
--

INSERT INTO `site_content` (`content_id`, `author_id`, `title`, `alias`, `slug`, `content`, `published`, `updated`, `access`, `date_created`) VALUES
(1, 2, 'Membership Registration Procedures', 'How to Join', 'membership-registration-procedures', '<p>Membership registration is for serving employees of MTN Nigeria Communications Limited.</p>\n\n<p>Below is the <strong>three-step membership registration procedures</strong> for joining memcos:</p>\n\n <p >&nbsp; &nbsp;<img alt="" height="28" src="http://memcos.net/MEMCOSWeb/userfiles/image/buy.png"  width="36" />Pay the non-refundable Membership Registration Fee of N5,000.00 to any of MEMCOS bank accounts below with clear indication of your name as depositor:</p>\n\n<ol>\n  <li>1. GT Bank account : <font ><b>209/726569/110</b></font></li>\n  <li>2. Zenith Bank account : <font ><b>6012613503</b></font></li>\n</ol>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n <p >&nbsp; &nbsp;<img alt="" height="0" src="http://memcos.net/MEMCOSWeb/userfiles/image/buy.png"  width="0" />Fill the <b>online</b> Membership Registration Form accurately on the MEMCOS website, ensuring to submit the data in all fields.</p>\n\n<p>&nbsp;</p>\n\n <p >&nbsp; &nbsp;<img alt="" height="28" src="http://memcos.net/MEMCOSWeb/userfiles/image/buy.png"  width="36" />Print out a copy of the generated deduction form, append your signature and send together with a copy of your payment deposit slip to the MEMCOS Secretariat below:</p>\n\n <div align="center"  width="500">\n <p >The Manager,<br />\nMEMCOS Secretariat,<br />\n4, Aromire street,<br />\nIkoyi, Lagos.</p>\n</div>\n\n<p><br />\nYou will be contacted by MEMCOS after validation of the submitted data.</p>\n\n<table>\n <tbody>\n  <tr>\n   <td valign="top"><strong>NB:</strong></td>\n   <td valign="top">\n    <div >Exited employees of MTN Nigeria Communications Limited and former members of MEMCOS should contact the Secretariat for full information about their status.</div>\n   </td>\n  </tr>\n </tbody>\n</table>', '1', 0, 0, '2014/01/26 05:22 pm'),
(2, 2, 'About Us', 'About Us', 'about-us', '<p>About MEMCOS</p>', '1', 0, 0, '2014/01/26 05:28 pm'),
(3, 2, 'MEMCOS PRODUCTS', 'Products', 'memcos-products', '<p>This is the products page. Acessible to only members</p>', '1', 1, 2, '2014/01/26 05:38 pm'),
(4, 2, 'DOWNLOADS PAGE', 'Downloads', 'downloads-page', '<p>This is the download page</p>', '1', 0, 2, '2014/01/26 05:39 pm'),
(5, 2, 'EVENTS PAGE', 'Events', 'events-page', '<p>This is the events page and it has been editted</p>', '1', 1, 1, '2014/01/30 10:04 pm'),
(6, 2, 'HAAS LIST', 'Haas List', 'haas-list', '<p>HAAS List page. All pages are dynamically created</p>', '1', 0, 2, '2014/01/26 05:42 pm'),
(10, 20, 'Admin only', 'admin users', 'admin-only', '<p>This is for administrators only.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Samuel take note!!!</p>', '1', 1, 2, '2014/01/31 03:37 am');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` varchar(20) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `cooperator_id` int(11) NOT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `contribution_id` int(10) unsigned DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `contribution_id` (`contribution_id`),
  KEY `cooperator_id` (`cooperator_id`),
  KEY `loan_id` (`loan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_type`, `amount`, `cooperator_id`, `loan_id`, `contribution_id`, `date_created`) VALUES
(1, 'contribution', 20000, 1, NULL, 1, '2014-07-06 09:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE IF NOT EXISTS `transaction_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `name`, `description`, `date_created`) VALUES
(1, 'contribution', 'Contributions transaction types', '2014-07-06 08:41:54'),
(2, 'loan', 'Loans transaction types', '2014-07-06 08:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(1) NOT NULL DEFAULT '0',
  `last_login` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passwd`, `date_created`, `active`, `last_login`) VALUES
(1, 'doubleakins', '86d924717cd638a05caf87af8830077d1004abe4', '2014-06-29 19:03:27', 1, '1405970799'),
(2, 'schand', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-07-02 23:28:10', 1, '1404071766');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE IF NOT EXISTS `users_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `permissionsTitle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE IF NOT EXISTS `user_actions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `changed_by` int(10) unsigned NOT NULL,
  `action_performed` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `changed_by` (`changed_by`),
  KEY `FK_admin_actions_user_actions` (`action_performed`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE IF NOT EXISTS `user_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Messages id',
  `sender_id` int(10) unsigned DEFAULT NULL COMMENT 'The message sender',
  `receipient_id` int(10) unsigned DEFAULT NULL COMMENT 'The receipient of the message',
  `message_id` int(10) unsigned DEFAULT NULL COMMENT 'The message contents id from message table',
  `state` varchar(20) NOT NULL COMMENT 'The state of the message',
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'The time the message was sent',
  PRIMARY KEY (`id`),
  KEY `FK_user_sender_user_messages` (`sender_id`),
  KEY `FK_user_reciever_user_messages` (`receipient_id`),
  KEY `FK_message_user_messages` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `sender_id`, `receipient_id`, `message_id`, `state`, `date_sent`) VALUES
(4, 8, 6, 4, 'sent', '2014-01-31 13:00:32'),
(5, 6, 5, 4, 'unread', '2014-01-31 14:36:08'),
(6, 5, 7, 5, 'sent', '2014-02-08 21:03:48'),
(7, 5, 7, 6, 'sent', '2014-02-08 21:04:28'),
(8, 7, 5, 7, 'sent', '2014-02-08 21:07:35'),
(9, 5, 7, 8, 'unread', '2014-02-08 21:27:31'),
(10, 5, 7, 9, 'unread', '2014-02-08 21:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contributions_rules`
--
ALTER TABLE `contributions_rules`
  ADD CONSTRAINT `contributions_rules_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contributions_rules_ibfk_2` FOREIGN KEY (`rule_title`) REFERENCES `rules` (`title`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contributions_settings`
--
ALTER TABLE `contributions_settings`
  ADD CONSTRAINT `FK_contribution_id` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cooperators`
--
ALTER TABLE `cooperators`
  ADD CONSTRAINT `cooperators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cooperators_bank_accounts`
--
ALTER TABLE `cooperators_bank_accounts`
  ADD CONSTRAINT `cooperators_bank_accounts_ibfk_1` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cooperators_contributions`
--
ALTER TABLE `cooperators_contributions`
  ADD CONSTRAINT `cooperators_contributions_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooperators_contributions_ibfk_2` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cooperators_groups`
--
ALTER TABLE `cooperators_groups`
  ADD CONSTRAINT `cooperators_groups_ibfk_1` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooperators_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loans_rules`
--
ALTER TABLE `loans_rules`
  ADD CONSTRAINT `loans_rules_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loans_rules_ibfk_2` FOREIGN KEY (`rule_title`) REFERENCES `rules` (`title`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loans_settings`
--
ALTER TABLE `loans_settings`
  ADD CONSTRAINT `loans_settings_ibfk_2` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `next_of_kin`
--
ALTER TABLE `next_of_kin`
  ADD CONSTRAINT `next_of_kin_ibfk_1` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_permissions_ibfk_3` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rules_categories`
--
ALTER TABLE `rules_categories`
  ADD CONSTRAINT `FK_rules_categories_fk01` FOREIGN KEY (`rule_title`) REFERENCES `rules` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rules_categories_fk02` FOREIGN KEY (`category_code`) REFERENCES `categories` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rules_settings`
--
ALTER TABLE `rules_settings`
  ADD CONSTRAINT `rules_settings_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rule_definitions`
--
ALTER TABLE `rule_definitions`
  ADD CONSTRAINT `rule_definitions_ibfk_2` FOREIGN KEY (`rule_title`) REFERENCES `rules` (`title`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD CONSTRAINT `user_actions_ibfk_1` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
