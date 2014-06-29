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
/*!40000 ALTER TABLE `admin_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_actions` ENABLE KEYS */;


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
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;
REPLACE INTO `contributions` (`id`, `name`, `description`, `date_created`, `status`) VALUES
	(1, 'First savings contributions', 'Just a sample for testing', '2014-06-29 12:23:06', 'active');
/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;


-- Dumping structure for table armony.contributions_rules
CREATE TABLE IF NOT EXISTS `contributions_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `contribution_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_rules_contrib_fk01` (`rule_id`),
  KEY `FK_contrib_rules_fk02` (`contribution_id`),
  CONSTRAINT `FK_contrib_rules_fk02` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rules_contrib_fk01` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.contributions_rules: ~2 rows (approximately)
/*!40000 ALTER TABLE `contributions_rules` DISABLE KEYS */;
REPLACE INTO `contributions_rules` (`id`, `rule_id`, `contribution_id`) VALUES
	(5, 1, 1),
	(7, 2, 1);
/*!40000 ALTER TABLE `contributions_rules` ENABLE KEYS */;


-- Dumping structure for table armony.contributions_settings
CREATE TABLE IF NOT EXISTS `contributions_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribution_id` int(11) unsigned NOT NULL,
  `rule_id` int(11) NOT NULL,
  `key` varchar(150) NOT NULL,
  `value` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`),
  UNIQUE KEY `unique_key` (`key`),
  KEY `FK_contributions_settings_fk01` (`contribution_id`),
  KEY `FK_contributions_rules_fk05` (`rule_id`),
  CONSTRAINT `FK_contributions_rules_fk05` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_contributions_settings_fk01` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.contributions_settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `contributions_settings` DISABLE KEYS */;
REPLACE INTO `contributions_settings` (`id`, `contribution_id`, `rule_id`, `key`, `value`, `date_created`) VALUES
	(2, 1, 2, 'contribution-value', '20000', '2014-06-29 21:46:58');
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
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cooperators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.cooperators: ~1 rows (approximately)
/*!40000 ALTER TABLE `cooperators` DISABLE KEYS */;
REPLACE INTO `cooperators` (`id`, `user_id`, `employee_id`, `firstname`, `lastname`, `email`, `date_created`, `phone_number`, `gender`, `branch`, `date_joined_company`, `date_approved`, `home_address`, `home_town`) VALUES
	(1, 1, 'oi009jjkl', 'Samuel', 'Okoroafor', 'samuel.okoroafor@gems3nigeria.com', '2014-06-29 12:23:56', '08184474987', 'male', 'Lokoja', '2014-06-29 12:24:16', '2014-06-29 12:24:17', 'Somewhere in Lokoja', 'ohaozara');
/*!40000 ALTER TABLE `cooperators` ENABLE KEYS */;


-- Dumping structure for table armony.cooperators_bank_accounts
CREATE TABLE IF NOT EXISTS `cooperators_bank_accounts` (
  `id` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.cooperators_contributions: ~1 rows (approximately)
/*!40000 ALTER TABLE `cooperators_contributions` DISABLE KEYS */;
REPLACE INTO `cooperators_contributions` (`id`, `cooperator_id`, `contribution_id`, `date_created`) VALUES
	(2, 1, 1, '2014-06-29 12:26:04');
/*!40000 ALTER TABLE `cooperators_contributions` ENABLE KEYS */;


-- Dumping structure for table armony.cooperators_groups
CREATE TABLE IF NOT EXISTS `cooperators_groups` (
  `id` int(11) NOT NULL,
  `cooperator_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cooperator_id` (`cooperator_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `cooperators_groups_ibfk_1` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cooperators_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.cooperators_groups: ~0 rows (approximately)
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
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Dumping structure for table armony.loans
CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.loans: ~2 rows (approximately)
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
REPLACE INTO `loans` (`id`, `name`, `description`, `date_created`) VALUES
	(1, 'First Loan', 'This is a sample first loan', '2014-06-25 23:31:43'),
	(2, 'Second Loan', 'This is a sample second oan', '2014-06-25 23:32:04');
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;


-- Dumping structure for table armony.loans_rules
CREATE TABLE IF NOT EXISTS `loans_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `loan_id` (`loan_id`),
  KEY `rule_id` (`rule_id`),
  CONSTRAINT `loans_rules_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `loans_rules_ibfk_2` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.loans_rules: ~2 rows (approximately)
/*!40000 ALTER TABLE `loans_rules` DISABLE KEYS */;
REPLACE INTO `loans_rules` (`id`, `rule_id`, `loan_id`, `date_created`) VALUES
	(1, 1, 1, '2014-06-28 22:36:49'),
	(2, 2, 1, '2014-06-28 22:37:06');
/*!40000 ALTER TABLE `loans_rules` ENABLE KEYS */;


-- Dumping structure for table armony.loans_settings
CREATE TABLE IF NOT EXISTS `loans_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `br_id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `br_id` (`br_id`),
  KEY `loan_id` (`loan_id`),
  CONSTRAINT `loans_settings_ibfk_1` FOREIGN KEY (`br_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `loans_settings_ibfk_2` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.loans_settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `loans_settings` DISABLE KEYS */;
REPLACE INTO `loans_settings` (`id`, `loan_id`, `br_id`, `key`, `value`, `date_created`) VALUES
	(1, 1, 2, 'loan_minimum_balance', '45000', '2014-06-29 13:28:45');
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
/*!40000 ALTER TABLE `next_of_kin` DISABLE KEYS */;
/*!40000 ALTER TABLE `next_of_kin` ENABLE KEYS */;


-- Dumping structure for table armony.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
REPLACE INTO `permissions` (`id`, `title`, `date_created`) VALUES
	(1, 'canEditPassword', '2014-06-26 08:05:36');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table armony.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.roles: ~0 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`id`, `title`, `date_created`) VALUES
	(1, 'admin', '2014-06-26 08:05:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table armony.roles_permissions
CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_permissions_ibfk_2` (`role_id`),
  KEY `roles_permissions_ibfk_1` (`permission_id`),
  CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.roles_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `roles_permissions` DISABLE KEYS */;
REPLACE INTO `roles_permissions` (`id`, `role_id`, `permission_id`) VALUES
	(2, 1, 1);
/*!40000 ALTER TABLE `roles_permissions` ENABLE KEYS */;


-- Dumping structure for table armony.rules
CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.rules: ~3 rows (approximately)
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
REPLACE INTO `rules` (`id`, `title`, `description`, `date_created`) VALUES
	(1, 'check-user-exists', 'This checks if a user exits', '2014-06-25 23:33:08'),
	(2, 'loans-user-balance-must-be-greater-than-amount', 'This checks that the user\'s balance is great than a set amount in the settings for loan rules', '2014-06-25 23:35:06'),
	(3, 'loans-user-balance-not-less-than-amount', 'This checks that the user\'s balance is not less than a specified amount', '2014-06-26 00:00:44');
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;


-- Dumping structure for table armony.rules_settings
CREATE TABLE IF NOT EXISTS `rules_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `FK_rule_rule_settings_fk01` (`rule_id`),
  CONSTRAINT `FK_rule_rule_settings_fk01` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.rules_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `rules_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `rules_settings` ENABLE KEYS */;


-- Dumping structure for table armony.rule_definitions
CREATE TABLE IF NOT EXISTS `rule_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) DEFAULT NULL,
  `rules_def` varchar(1500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rule_id` (`rule_id`),
  CONSTRAINT `rule_definitions_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.rule_definitions: ~1 rows (approximately)
/*!40000 ALTER TABLE `rule_definitions` DISABLE KEYS */;
REPLACE INTO `rule_definitions` (`id`, `rule_id`, `rules_def`) VALUES
	(1, 1, 'select if(count(*)>0,true,false) as vl from users where id=?'),
	(2, 2, 'SELECT if(?>getUserBalance(?), false,true) as vl');
/*!40000 ALTER TABLE `rule_definitions` ENABLE KEYS */;


-- Dumping structure for table armony.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT '0',
  `value` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


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
  KEY `transactions_ibfk_4` (`transaction_type`),
  CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`transaction_type`) REFERENCES `transaction_types` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`cooperator_id`) REFERENCES `cooperators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.transactions: ~2 rows (approximately)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
REPLACE INTO `transactions` (`id`, `transaction_type`, `amount`, `cooperator_id`, `loan_id`, `contribution_id`, `date_created`) VALUES
	(1, 'loan', 50000, 1, 1, NULL, '2014-06-29 12:30:27'),
	(3, 'contribution', 60000, 1, NULL, 1, '2014-06-29 12:31:17');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;


-- Dumping structure for table armony.transaction_types
CREATE TABLE IF NOT EXISTS `transaction_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.transaction_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `transaction_types` DISABLE KEYS */;
REPLACE INTO `transaction_types` (`id`, `name`, `description`, `date_created`) VALUES
	(1, 'loan', 'Loan transaction type', '2014-06-29 12:26:35'),
	(2, 'contribution', 'Contribution transaction type', '2014-06-29 12:27:26');
/*!40000 ALTER TABLE `transaction_types` ENABLE KEYS */;


-- Dumping structure for table armony.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` bit(1) NOT NULL DEFAULT b'0',
  `last_login` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `username`, `passwd`, `date_created`, `active`, `last_login`) VALUES
	(1, 'schand', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-06-26 08:04:03', b'1', '2014-06-26 08:04:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table armony.users_permissions
CREATE TABLE IF NOT EXISTS `users_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `permissionsTitle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.users_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;
REPLACE INTO `users_permissions` (`id`, `username`, `permissionsTitle`) VALUES
	(1, 'schand', 'canEditPassword');
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
/*!40000 ALTER TABLE `user_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_actions` ENABLE KEYS */;


-- Dumping structure for table armony.user_messages
CREATE TABLE IF NOT EXISTS `user_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned DEFAULT NULL,
  `receipient_id` int(10) unsigned DEFAULT NULL,
  `message_id` int(10) unsigned DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  KEY `receipient_id` (`receipient_id`),
  KEY `sender_id` (`sender_id`),
  CONSTRAINT `user_messages_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_messages_ibfk_2` FOREIGN KEY (`receipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_messages_ibfk_3` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table armony.user_messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_messages` ENABLE KEYS */;


-- Dumping structure for table armony.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_roles_ibfk_2` (`user_id`),
  KEY `user_roles_ibfk_1` (`role_id`),
  CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table armony.user_roles: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
REPLACE INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
	(2, 1, 1);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;


-- Dumping structure for function armony.getUserBalance
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `getUserBalance`(`userId` INT) RETURNS decimal(10,0)
    DETERMINISTIC
BEGIN
DECLARE val DECIMAl;
select amount from armony.transactions where cooperator_id=1 and transaction_type='contribution' into val;
return val;
END//
DELIMITER ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
