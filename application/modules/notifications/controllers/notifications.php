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
    public function sendMessage($type,$recipients,$message)
    {
        if(modules::run('settings/isModuleOn',NOTIFICATIONS_MODULE))
        {
        if(is_array($recipients))
        {
         switch($type)
         {
             case SMS_TYPE:
                 return $this->Notifications_model->sendSMS($recipients,$message,NOTIFICATION_SENDER);
                 break;
             case EMAIL_TYPE:
                 return $this->Notifications_model->sendEmail($recipients);
                 break;
             case INTERNAL_MESSAGE_TYPE:
                 return $this->Notifications_model->sendInternalMessage($recipients);
                 break;
             default:
                 break;

         }
        }
    }
        else echo MODULE_DEACTIVATED;
    }
} 