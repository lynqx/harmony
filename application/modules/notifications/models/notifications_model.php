<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 7/18/14
 * Time: 10:52 PM
 */

class Notifications_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sms_model');
    }

    public function sendSMS($phoneNumbers,$message,$sender)
    {
        //expects an array of one or more phone numbers
        $validNumbers=[];
        $result='';
        //filter for numbers
        if(is_array($phoneNumbers))
        {
            $validNumbers=array_filter($phoneNumbers,"phoneNumbersFilter");
        }
        if(count($validNumbers)>0)
        {
            //call sms handler
            foreach($validNumbers as $number)
            {
                $result=$this->Sms_model->send($number,$message,$sender);

            }
            return $result;
        }
    }

    public function sendEmail($emails)
    {
        //expects an array of one or more emails
    }

    public function sendInternalMessage($recipients)
    {
        //expects an array of one or more cooperatorIds/userIds
        if(count($recipients) > 0)
        {

        }
    }

    public function sendMessage()
    {

    }

    /**
    //Filter call back functions for array_filter
     **/
    private function phoneNumbersFilter($number)
    {
        $filtered=filter_var($number,FILTER_SANITIZE_NUMBER_INT);
        $filtered=filter_var($filtered,FILTER_VALIDATE_INT);
        if(!is_false($filtered))
        {
            return true;
        }
        else return false;
    }
    private function emailFilter($email)
    {
        $filtered=filter_var($email,FILTER_VALIDATE_EMAIL);
        if(!is_false($filtered))
        {
            return true;
        }
        else return false;
    }
} 