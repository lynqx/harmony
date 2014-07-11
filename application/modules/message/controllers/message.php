<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/27/14
 * Time: 6:50 AM
 */
 /**
 * Editted :
 * User: "Lynqx" Date: 07/11/14
 */
 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Message extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model', 'message');
    }

    function index()
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        $data['page_title'] = 'Messaging';
        $data['module'] = 'message';
        $data['view_file'] = 'messages_list';
        echo Modules::run('templates/main_site', $data);
    }

    function compose()
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        //TODO: Run validations
		$receive = $this->uri->segment(3);
		
		if (is_numeric($receive)) {
			//$data = $this->get_member_data_from_db($update_id);
			$user = $this->message->getUserName2($receive);
			$data['users'] = $user['rows'];
		
		}
			
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for Membership
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('content', 'Message content', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $data['page_title'] = 'Compose Message';
            $data['module'] = 'message';
            $data['view_file'] = 'create_message';
            echo modules::run('templates/main_site', $data);
        } else {
            //TODO: This means Validation passed. So process it!
            $result = $this->message->sendMessage();
            if ($result > 0) {
                $this->session->set_flashdata('result', 'Message sent successfully!');
                redirect('message/compose');
            } else {
                $this->session->set_flashdata('result', 'Message wasnt sent! Please try again');
                redirect('message/compose');
            }

        }
    }
	
	function reply()
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        //TODO: Run validations
		$repId = $this->uri->segment(3);
		
		$this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for Membership
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('content', 'Message content', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $this->session->set_flashdata('result', 'One or more fields are empty! Reply wasnt sent! Please try again');
            $location = 'message/view/'.$repId;
			redirect ($location);
        } else {
            //TODO: This means Validation passed. So process it!
            $result = $this->message->sendMessage();
            if ($result > 0) {
                $this->session->set_flashdata('result', 'Message sent successfully!');
                $location = 'message/view/'.$repId;
				redirect ($location);
            } else {
                $this->session->set_flashdata('result', 'Message wasnt sent! Please try again');
                $location = 'message/view/'.$repId;
				redirect ($location);
            }

        }
    }

    function save()
    {


    }

    /**
     * Send()
     * This controller action is called when messages are to be sent. It should be called via post
     */
    function sent()
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        $data['page_title'] = 'Messaging';
        $data['module'] = 'message';
        $data['view_file'] = 'sent_messages_view';
        echo Modules::run('templates/main_site', $data);
    }

    function fetchMessages($userId, $type)
    {
        return $this->message->loadMessages($userId, $type);
    }

    function view($messageId)
    {
	
	$messageId = $this->uri->segment(3);
		if (!is_numeric($messageId)) {
			$location = 'message.....';
			redirect ($location);
			}
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        //TODO: Call the model to give us this data

        $data['page_title'] = 'Inbox';
        $data['module'] = 'message';
        $data['view_file'] = 'view_message';
        $data['message'] = $this->fetchMessage($messageId);
        echo Modules::run('templates/main_site', $data);
    }

    function fetchMessage($id)
    {
        //TODO: Call the message_model to give us this data
        return $this->message->getMessage($id);
    }

    function delete($mesageId)
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        $result = $this->message->deleteMessage($mesageId);
        //Return result
        if ($result == true)
            $this->session->set_flashdata('delete', 'Message Deleted successfully!');
        else $this->session->set_flashdata('delete', 'Message Deleted successfully!');
        redirect('message');

    }
} 