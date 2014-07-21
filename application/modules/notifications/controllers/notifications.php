<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 7/18/14
 * Time: 10:53 PM
 */

class Notifications extends MX_Controller {
public function __construct()
{
    parent::__construct();
    $this->load->model('Notifications_model');
}
    public function sendMessage($type,$recipients,$message,$subject='',$sender)
    {
        if(modules::run('settings/isModuleOn',NOTIFICATIONS_MODULE))
        {
        if(is_array($recipients))
        {
         switch($type)
         {
             case SMS_TYPE:
                 return $this->Notifications_model->sendSMS($recipients,$message,$sender);
                 break;
             case EMAIL_TYPE:
                 return $this->Notifications_model->sendEmail($recipients,$subject,$message,$sender);
                 break;
             default:
                 break;

         }
        }
    }
        else echo MODULE_DEACTIVATED;
    }
	
	public function index() 
	{
		//this works fine
		// change the mobile number to urs wen testing
		echo $this->Notifications_model->sendSMS('+2348063777394', 'Password to an emotionally unstable person', 'ORACLE');
		
		
		//this does not work
		//echo modules::run('notifications/sendMessage', 'sms', '+2348063777394', 'Password to an emotionally unstable person', 'subject', 'ORACLE');

							
	}
} 