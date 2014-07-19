<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
 * Armony Constants
 */
define('RULE_SETTINGS_DELIMITER',':::'); //The delimiter for rule settings splitter
define('LOANS_TABLE','');
define('LOANS_SETTINGS_TABLE','loans_settings');
define('CONTRIBUTIONS_TABLE','contributions');
define('CONTRIBUTIONS_SETTINGS_TABLE','contributions_settings');
define('CONTRIBUTION_CATEGORY','contribution');
define('LOAN_CATEGORY','loan');
define('RULE_SETTINGS_TABLE','rules_settings');
define('COMMA_DELIMITER',',');

//Settings Module configuration
define('SETTINGS_TABLE','settings');
define('KEY_COLUMN','key');
define('VALUE_COLUMN','value');
define('MODULES_ON','on');
define('MODULES_OFF','off');
define('MODULE_DEACTIVATED','Module Deactivated!');

//Notifications/SMS Settings
define('SMS_URL','http://www.nuobjects.com/nusms/');
define('SMS_ADMIN_USERNAME','');
define('SMS_ADMIN_PASS','');
define('SMS_TYPE','sms');
define('EMAIL_TYPE','email');
define('NOTIFICATIONS_MODULE','notifications');
define('SUCCESS_MESSAGE','success');
define('FAILURE_MESSAGE','failed');

/* End of file constants.php */
/* Location: ./application/config/constants.php */