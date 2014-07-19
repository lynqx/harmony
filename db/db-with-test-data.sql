-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for armony
CREATE DATABASE IF NOT EXISTS `armony` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `armony`;


-- Dumping structure for table armony.admin_actions
CREATE TABLE IF NOT EXISTS `admin_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.admin_actions: ~0 rows (approximately)
DELETE FROM `admin_actions`;
/*!40000 ALTER TABLE `admin_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_actions` ENABLE KEYS */;


-- Dumping structure for table armony.basicsettings
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.basicsettings: ~0 rows (approximately)
DELETE FROM `basicsettings`;
/*!40000 ALTER TABLE `basicsettings` DISABLE KEYS */;
INSERT INTO `basicsettings` (`id`, `companyname`, `shortname`, `address`, `phone`, `email`, `monthEndDay`, `yearEndMonth`, `monthlyReports`, `monthlyReportsFolder`, `minSavingAmount`, `rescheduleDateLimit`, `interestSavings`, `adminWithdrawCharge`, `adminWithdrawChargeFixed`, `adminWithdrawChargeAmount`, `registrationFee`, `showWelcomePopup`, `lockMonthEnd`, `salariesFileLoaded`, `enableInvAcc`, `last_update`) VALUES
	(1, 'Armony CTCS Worldwide Portal', 'MEMCOS', 'Iyana Sasa, Ibadan Nigeria', '0900000000', 'memcos@memcos.com', 0, NULL, NULL, NULL, 5000, 5, 20, b'1', b'1', 10, 0, b'1', NULL, NULL, NULL, '2014/02/08 09:33 pm');
/*!40000 ALTER TABLE `basicsettings` ENABLE KEYS */;


-- Dumping structure for table armony.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.categories: ~3 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `title`, `date_created`, `code`) VALUES
	(1, 'Membership Requirements', '2014-07-08 15:18:48', 'membership'),
	(2, 'Groups or Loans participation requirement', '2014-07-08 15:19:02', 'groups_participation'),
	(3, 'Financial Requirements', '2014-07-08 15:19:10', 'financial_requirements');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table armony.contributions
CREATE TABLE IF NOT EXISTS `contributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT 'inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.contributions: ~0 rows (approximately)
DELETE FROM `contributions`;
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;
INSERT INTO `contributions` (`id`, `name`, `description`, `date_created`, `status`) VALUES
	(1, 'First Contribution', 'A test first contribution', '2014-07-06 10:10:26', 'active');
/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;


-- Dumping structure for table armony.contributions_rules
CREATE TABLE IF NOT EXISTS `contributions_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribution_id` int(10) unsigned NOT NULL,
  `rule_title` varchar(150) NOT NULL,
  `category_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contribution_id` (`contribution_id`),
  KEY `rule_title` (`rule_title`),
  CONSTRAINT `contributions_rules_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contributions_rules_ibfk_2` FOREIGN KEY (`rule_title`) REFERENCES `rules` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.contributions_rules: ~1 rows (approximately)
DELETE FROM `contributions_rules`;
/*!40000 ALTER TABLE `contributions_rules` DISABLE KEYS */;
INSERT INTO `contributions_rules` (`id`, `contribution_id`, `rule_title`, `category_code`) VALUES
	(2, 1, 'user_balance_greater_than_amount', 'membership');
/*!40000 ALTER TABLE `contributions_rules` ENABLE KEYS */;


-- Dumping structure for table armony.contributions_settings
CREATE TABLE IF NOT EXISTS `contributions_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribution_id` int(11) unsigned NOT NULL,
  `value` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`),
  KEY `FK_contribution_id` (`contribution_id`),
  CONSTRAINT `FK_contribution_id` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.contributions_settings: ~0 rows (approximately)
DELETE FROM `contributions_settings`;
/*!40000 ALTER TABLE `contributions_settings` DISABLE KEYS */;
INSERT INTO `contributions_settings` (`id`, `contribution_id`, `value`, `date_created`) VALUES
	(1, 1, '1:::15000', '2014-07-06 10:27:34');
/*!40000 ALTER TABLE `contributions_settings` ENABLE KEYS */;


-- Dumping structure for table armony.cooperators
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
  KEY `user_id` (`user_id`),
  CONSTRAINT `cooperators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.cooperators: ~0 rows (approximately)
DELETE FROM `cooperators`;
/*!40000 ALTER TABLE `cooperators` DISABLE KEYS */;
INSERT INTO `cooperators` (`id`, `user_id`, `employee_id`, `firstname`, `lastname`, `email`, `date_created`, `phone_number`, `gender`, `branch`, `date_joined_company`, `date_approved`, `home_address`, `home_town`, `image`) VALUES
	(1, 1, '00001', 'Omomoh', 'Alabi', 'admin@harmony.com', '2014-06-29 20:27:30', '08063777394', 'male', 'whatever', '2014-06-26 00:00:00', '2014-06-27 00:00:00', 'Ibadan', 'Gombe', 'avatar.png');
/*!40000 ALTER TABLE `cooperators` ENABLE KEYS */;


-- Dumping structure for table armony.cooperators_bank_accounts
CREATE TABLE IF NOT EXISTS `cooperators_bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cooperator_id` int(11) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `acount_name` varchar(70) NOT NULL,
  `account_number` varchar(70) NOT NULL,
  `branch` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cooperator_id` (`cooperator_id`),
  CONSTRAINT `cooperators_bank_accounts_ibfk_1` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.cooperators_bank_accounts: ~0 rows (approximately)
DELETE FROM `cooperators_bank_accounts`;
/*!40000 ALTER TABLE `cooperators_bank_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `cooperators_bank_accounts` ENABLE KEYS */;


-- Dumping structure for table armony.cooperators_contributions
CREATE TABLE IF NOT EXISTS `cooperators_contributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cooperator_id` int(11) NOT NULL,
  `contribution_id` int(10) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `contribution_id` (`contribution_id`),
  KEY `cooperator_id` (`cooperator_id`),
  CONSTRAINT `cooperators_contributions_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cooperators_contributions_ibfk_2` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.cooperators_contributions: ~0 rows (approximately)
DELETE FROM `cooperators_contributions`;
/*!40000 ALTER TABLE `cooperators_contributions` DISABLE KEYS */;
INSERT INTO `cooperators_contributions` (`id`, `cooperator_id`, `contribution_id`, `date_created`) VALUES
	(1, 1, 1, '2014-07-06 11:58:40');
/*!40000 ALTER TABLE `cooperators_contributions` ENABLE KEYS */;


-- Dumping structure for table armony.cooperators_groups
CREATE TABLE IF NOT EXISTS `cooperators_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cooperator_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cooperator_id` (`cooperator_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `cooperators_groups_ibfk_1` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cooperators_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.cooperators_groups: ~0 rows (approximately)
DELETE FROM `cooperators_groups`;
/*!40000 ALTER TABLE `cooperators_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `cooperators_groups` ENABLE KEYS */;


-- Dumping structure for table armony.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(225) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.groups: ~0 rows (approximately)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Dumping structure for table armony.loans
CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.loans: ~0 rows (approximately)
DELETE FROM `loans`;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;


-- Dumping structure for table armony.loans_rules
CREATE TABLE IF NOT EXISTS `loans_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_title` varchar(150) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `loan_id` (`loan_id`),
  KEY `loans_rules_ibfk_2` (`rule_title`),
  CONSTRAINT `loans_rules_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `loans_rules_ibfk_2` FOREIGN KEY (`rule_title`) REFERENCES `rules` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.loans_rules: ~0 rows (approximately)
DELETE FROM `loans_rules`;
/*!40000 ALTER TABLE `loans_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans_rules` ENABLE KEYS */;


-- Dumping structure for table armony.loans_settings
CREATE TABLE IF NOT EXISTS `loans_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `value` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `loan_id` (`loan_id`),
  CONSTRAINT `loans_settings_ibfk_2` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.loans_settings: ~0 rows (approximately)
DELETE FROM `loans_settings`;
/*!40000 ALTER TABLE `loans_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans_settings` ENABLE KEYS */;


-- Dumping structure for table armony.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `message` varchar(1500) NOT NULL,
  `date_sent` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.messages: ~0 rows (approximately)
DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Dumping structure for table armony.next_of_kin
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
  KEY `cooperator_id` (`cooperator_id`),
  CONSTRAINT `next_of_kin_ibfk_1` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.next_of_kin: ~0 rows (approximately)
DELETE FROM `next_of_kin`;
/*!40000 ALTER TABLE `next_of_kin` DISABLE KEYS */;
/*!40000 ALTER TABLE `next_of_kin` ENABLE KEYS */;


-- Dumping structure for table armony.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The ID for available permissions',
  `title` varchar(255) NOT NULL COMMENT 'The title for the permissions.e.g. Can Add New User',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'The date of creation for the entry',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.permissions: ~5 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `title`, `date_created`) VALUES
	(1, 'canUpdateProfile', '2014-01-22 07:56:15'),
	(2, 'canReadDoc', '2014-01-25 18:11:28'),
	(3, 'canViewAdmin', '2014-01-26 01:39:03'),
	(4, 'canDoMemberTasks', '2014-01-30 17:37:21'),
	(5, 'canViewMember', '2014-01-31 14:42:29');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table armony.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.roles: ~0 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `title`, `date_created`) VALUES
	(1, 'admin', '2014-06-29 20:37:49');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table armony.roles_permissions
CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roles_permissions_ibfk_3` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.roles_permissions: ~6 rows (approximately)
DELETE FROM `roles_permissions`;
/*!40000 ALTER TABLE `roles_permissions` DISABLE KEYS */;
INSERT INTO `roles_permissions` (`id`, `role_id`, `permission_id`) VALUES
	(1, 1, 1),
	(2, 1, 1),
	(3, 1, 2),
	(4, 1, 3),
	(5, 1, 4),
	(6, 1, 5);
/*!40000 ALTER TABLE `roles_permissions` ENABLE KEYS */;


-- Dumping structure for table armony.rules
CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.rules: ~1 rows (approximately)
DELETE FROM `rules`;
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
INSERT INTO `rules` (`id`, `title`, `description`, `date_created`) VALUES
	(1, 'user_balance_greater_than_amount', 'The User\'s balance is greater than the speculated amount', '2014-07-05 22:52:31'),
	(2, 'user_must_belong_to_a_specific_group', 'The User must belong to a specific group', '2014-07-08 20:05:42');
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;


-- Dumping structure for table armony.rules_categories
CREATE TABLE IF NOT EXISTS `rules_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_title` varchar(150) NOT NULL,
  `category_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_rules_categories_fk02` (`category_code`),
  KEY `rule_title` (`rule_title`),
  CONSTRAINT `FK_rules_categories_fk01` FOREIGN KEY (`rule_title`) REFERENCES `rules` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rules_categories_fk02` FOREIGN KEY (`category_code`) REFERENCES `categories` (`code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='This table maps rules to categories based on the general front end grouping';

-- Dumping data for table armony.rules_categories: ~0 rows (approximately)
DELETE FROM `rules_categories`;
/*!40000 ALTER TABLE `rules_categories` DISABLE KEYS */;
INSERT INTO `rules_categories` (`id`, `rule_title`, `category_code`) VALUES
	(1, 'user_balance_greater_than_amount', 'membership');
/*!40000 ALTER TABLE `rules_categories` ENABLE KEYS */;


-- Dumping structure for table armony.rules_settings
CREATE TABLE IF NOT EXISTS `rules_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `rule_id` (`rule_id`),
  CONSTRAINT `rules_settings_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.rules_settings: ~0 rows (approximately)
DELETE FROM `rules_settings`;
/*!40000 ALTER TABLE `rules_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `rules_settings` ENABLE KEYS */;


-- Dumping structure for table armony.rule_definitions
CREATE TABLE IF NOT EXISTS `rule_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) DEFAULT NULL,
  `rule_title` varchar(150) DEFAULT NULL,
  `rules_def` varchar(1500) DEFAULT NULL,
  `require_settings` bit(1) DEFAULT NULL COMMENT 'This helps to know if a rule requires settings',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rule_id` (`rule_id`),
  KEY `rule_definitions_ibfk_2` (`rule_title`),
  CONSTRAINT `rule_definitions_ibfk_2` FOREIGN KEY (`rule_title`) REFERENCES `rules` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.rule_definitions: ~2 rows (approximately)
DELETE FROM `rule_definitions`;
/*!40000 ALTER TABLE `rule_definitions` DISABLE KEYS */;
INSERT INTO `rule_definitions` (`id`, `rule_id`, `rule_title`, `rules_def`, `require_settings`, `date_created`) VALUES
	(1, 1, 'user_balance_greater_than_amount', 'select (getContributionBalance(?) > ? , true,false) as vl', b'1', '2014-07-08 18:56:52'),
	(2, 2, 'user_must_belong_to_a_specific_group', NULL, NULL, '2014-07-08 20:07:32');
/*!40000 ALTER TABLE `rule_definitions` ENABLE KEYS */;


-- Dumping structure for table armony.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.settings: ~5 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `key`, `value`) VALUES
	(1, 'self-service', 'on'),
	(2, 'admin', 'on'),
	(3, 'groups', 'on'),
	(4, 'notifications', 'on'),
	(5, 'message', 'on');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table armony.sitelogo
CREATE TABLE IF NOT EXISTS `sitelogo` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `logo` varchar(64) NOT NULL,
  `favicon` varchar(64) NOT NULL,
  `date` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='for the site wide logo and shortcut icon';

-- Dumping data for table armony.sitelogo: ~0 rows (approximately)
DELETE FROM `sitelogo`;
/*!40000 ALTER TABLE `sitelogo` DISABLE KEYS */;
INSERT INTO `sitelogo` (`id`, `logo`, `favicon`, `date`) VALUES
	(1, 'knights.jpg', 'favicon.ico', '');
/*!40000 ALTER TABLE `sitelogo` ENABLE KEYS */;


-- Dumping structure for table armony.site_content
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.site_content: ~7 rows (approximately)
DELETE FROM `site_content`;
/*!40000 ALTER TABLE `site_content` DISABLE KEYS */;
INSERT INTO `site_content` (`content_id`, `author_id`, `title`, `alias`, `slug`, `content`, `published`, `updated`, `access`, `date_created`) VALUES
	(1, 2, 'Membership Registration Procedures', 'How to Join', 'membership-registration-procedures', '<p>Membership registration is for serving employees of MTN Nigeria Communications Limited.</p>\n\n<p>Below is the <strong>three-step membership registration procedures</strong> for joining memcos:</p>\n\n <p >&nbsp; &nbsp;<img alt="" height="28" src="http://memcos.net/MEMCOSWeb/userfiles/image/buy.png"  width="36" />Pay the non-refundable Membership Registration Fee of N5,000.00 to any of MEMCOS bank accounts below with clear indication of your name as depositor:</p>\n\n<ol>\n  <li>1. GT Bank account : <font ><b>209/726569/110</b></font></li>\n  <li>2. Zenith Bank account : <font ><b>6012613503</b></font></li>\n</ol>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n <p >&nbsp; &nbsp;<img alt="" height="0" src="http://memcos.net/MEMCOSWeb/userfiles/image/buy.png"  width="0" />Fill the <b>online</b> Membership Registration Form accurately on the MEMCOS website, ensuring to submit the data in all fields.</p>\n\n<p>&nbsp;</p>\n\n <p >&nbsp; &nbsp;<img alt="" height="28" src="http://memcos.net/MEMCOSWeb/userfiles/image/buy.png"  width="36" />Print out a copy of the generated deduction form, append your signature and send together with a copy of your payment deposit slip to the MEMCOS Secretariat below:</p>\n\n <div align="center"  width="500">\n <p >The Manager,<br />\nMEMCOS Secretariat,<br />\n4, Aromire street,<br />\nIkoyi, Lagos.</p>\n</div>\n\n<p><br />\nYou will be contacted by MEMCOS after validation of the submitted data.</p>\n\n<table>\n <tbody>\n  <tr>\n   <td valign="top"><strong>NB:</strong></td>\n   <td valign="top">\n    <div >Exited employees of MTN Nigeria Communications Limited and former members of MEMCOS should contact the Secretariat for full information about their status.</div>\n   </td>\n  </tr>\n </tbody>\n</table>', '1', 0, 0, '2014/01/26 05:22 pm'),
	(2, 2, 'About Us', 'About Us', 'about-us', '<p>About MEMCOS</p>', '1', 0, 0, '2014/01/26 05:28 pm'),
	(3, 2, 'MEMCOS PRODUCTS', 'Products', 'memcos-products', '<p>This is the products page. Acessible to only members</p>', '1', 1, 2, '2014/01/26 05:38 pm'),
	(4, 2, 'DOWNLOADS PAGE', 'Downloads', 'downloads-page', '<p>This is the download page</p>', '1', 0, 2, '2014/01/26 05:39 pm'),
	(5, 2, 'EVENTS PAGE', 'Events', 'events-page', '<p>This is the events page and it has been editted</p>', '1', 1, 1, '2014/01/30 10:04 pm'),
	(6, 2, 'HAAS LIST', 'Haas List', 'haas-list', '<p>HAAS List page. All pages are dynamically created</p>', '1', 0, 2, '2014/01/26 05:42 pm'),
	(10, 20, 'Admin only', 'admin users', 'admin-only', '<p>This is for administrators only.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Samuel take note!!!</p>', '1', 1, 2, '2014/01/31 03:37 am');
/*!40000 ALTER TABLE `site_content` ENABLE KEYS */;


-- Dumping structure for table armony.toggledisplay
CREATE TABLE IF NOT EXISTS `toggledisplay` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `logo` int(3) NOT NULL,
  `sitename` int(2) NOT NULL,
  `slogan` int(2) NOT NULL,
  `footername` int(2) NOT NULL,
  `favicon` int(2) NOT NULL,
  `defaultlogo` int(2) NOT NULL,
  `defaultfav` int(2) NOT NULL,
  `date` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Toggle the display of the entire site';

-- Dumping data for table armony.toggledisplay: ~0 rows (approximately)
DELETE FROM `toggledisplay`;
/*!40000 ALTER TABLE `toggledisplay` DISABLE KEYS */;
INSERT INTO `toggledisplay` (`id`, `logo`, `sitename`, `slogan`, `footername`, `favicon`, `defaultlogo`, `defaultfav`, `date`) VALUES
	(1, 1, 1, 0, 0, 1, 0, 0, '2014/02/28 09:39 pm');
/*!40000 ALTER TABLE `toggledisplay` ENABLE KEYS */;


-- Dumping structure for table armony.transactions
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
  KEY `loan_id` (`loan_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.transactions: ~0 rows (approximately)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`id`, `transaction_type`, `amount`, `cooperator_id`, `loan_id`, `contribution_id`, `date_created`) VALUES
	(1, 'contribution', 20000, 1, NULL, 1, '2014-07-06 10:09:16');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;


-- Dumping structure for table armony.transaction_types
CREATE TABLE IF NOT EXISTS `transaction_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.transaction_types: ~2 rows (approximately)
DELETE FROM `transaction_types`;
/*!40000 ALTER TABLE `transaction_types` DISABLE KEYS */;
INSERT INTO `transaction_types` (`id`, `name`, `description`, `date_created`) VALUES
	(1, 'contribution', 'Contributions transaction types', '2014-07-06 09:41:54'),
	(2, 'loan', 'Loans transaction types', '2014-07-06 09:53:16');
/*!40000 ALTER TABLE `transaction_types` ENABLE KEYS */;


-- Dumping structure for table armony.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(1) NOT NULL DEFAULT '0',
  `last_login` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `passwd`, `date_created`, `active`, `last_login`) VALUES
	(1, 'doubleakins', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2014-06-29 20:03:27', 1, '1404071766'),
	(2, 'schand', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-07-03 00:28:10', 1, '1404071766');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table armony.users_permissions
CREATE TABLE IF NOT EXISTS `users_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `permissionsTitle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.users_permissions: ~0 rows (approximately)
DELETE FROM `users_permissions`;
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_permissions` ENABLE KEYS */;


-- Dumping structure for table armony.user_actions
CREATE TABLE IF NOT EXISTS `user_actions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `changed_by` int(10) unsigned NOT NULL,
  `action_performed` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `changed_by` (`changed_by`),
  KEY `FK_admin_actions_user_actions` (`action_performed`),
  CONSTRAINT `user_actions_ibfk_1` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.user_actions: ~0 rows (approximately)
DELETE FROM `user_actions`;
/*!40000 ALTER TABLE `user_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_actions` ENABLE KEYS */;


-- Dumping structure for table armony.user_messages
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.user_messages: ~7 rows (approximately)
DELETE FROM `user_messages`;
/*!40000 ALTER TABLE `user_messages` DISABLE KEYS */;
INSERT INTO `user_messages` (`id`, `sender_id`, `receipient_id`, `message_id`, `state`, `date_sent`) VALUES
	(4, 8, 6, 4, 'sent', '2014-01-31 14:00:32'),
	(5, 6, 5, 4, 'unread', '2014-01-31 15:36:08'),
	(6, 5, 7, 5, 'sent', '2014-02-08 22:03:48'),
	(7, 5, 7, 6, 'sent', '2014-02-08 22:04:28'),
	(8, 7, 5, 7, 'sent', '2014-02-08 22:07:35'),
	(9, 5, 7, 8, 'unread', '2014-02-08 22:27:31'),
	(10, 5, 7, 9, 'unread', '2014-02-08 22:27:38');
/*!40000 ALTER TABLE `user_messages` ENABLE KEYS */;


-- Dumping structure for table armony.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.user_roles: ~2 rows (approximately)
DELETE FROM `user_roles`;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
	(1, 1, 1),
	(2, 2, 1);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;


-- Dumping structure for function armony.getContributionBalance
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `getContributionBalance`(`cooperatorId` INT) RETURNS decimal(10,0)
    COMMENT 'Gets the balance of the implied cooperator'
BEGIN
declare contrib_amount decimal(10,0);
select SUM(amount) as vl into contrib_amount from transactions where cooperator_id=cooperatorId and transaction_type='contribution';
return contrib_amount;
END//
DELIMITER ;


-- Dumping structure for function armony.userIsInGroup
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `userIsInGroup`(`UserId` INT, `groupID` INT) RETURNS bit(1)
BEGIN
return 0;
END//
DELIMITER ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
