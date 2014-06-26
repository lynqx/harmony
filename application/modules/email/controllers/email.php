<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 2/4/14
 * Time: 9:57 PM
 */
//TODO: A very small module for sending emails

class Email extends MX_Controller
{

    /** This module method should only be called after you have cleaned up your data
     * Method name: sendMail
     * This method sends email to every member on this platform
     * @param $subject
     * @param $message
     * @param $sender
     */
    public function sendMail($subject, $message, $sender)
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        try {
            //TODO: This module is designed to be called for sending emails to members of the platform
            //TODO: Strategy: get all platform members emails
            $this->db->select('email');
            $this->db->from('users');
            $emails = $this->db->get();
            $emailArray = array();
            //TODO: Now loop through and send those emails
            foreach ($emails->result() as $row) {
                //TODO: Collect the emails together in an array
                $emailArray[] = $row->email;
            }
            //TODO: Set up the CI Mail class
            $this->email->from($sender, 'Admin');
            $this->email->to($emailArray);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send(); // TODO: Sends the email
            //TODO: Tell the caller something about the successful operation
            return true;
        } catch (Exception $ex) {

            //TODO: Something went wrong? Sorry
            return false;
        }
    }

    /**
     * sendToSpecifiedEmails function sends emails to the specified email addresses
     * @param $subject
     * @param $message
     * @param $sender
     * @param $receiversCollection
     * @return bool
     */
    public function sendToSpecifiedEmails($subject, $message, $sender, $receiversCollection)
    {
        //TODO: Send Email to the specified Email Address or Addresses

        //TODO: Check that the user is logged in
        Modules::run('login/is_logged_in');

        //TODO: Set up codeIgniter's email
        try {
            $this->email->from($sender, 'Admin');
            $this->email->to($receiversCollection);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send(); // TODO: Sends the email
            //TODO: Tell the caller something about the successful operation
            return true;
        } catch (Exception $ex) {
            return false;
        }

    }

} 