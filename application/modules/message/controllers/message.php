<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/27/14
 * Time: 6:50 AM
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

    function create()
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for Membership
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('content', 'Message content', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $data['page_title'] = 'Create Message';
            $data['module'] = 'message';
            $data['view_file'] = 'create_message';
            echo modules::run('templates/main_site', $data);
        } else {
            //TODO: This means Validation passed. So process it!
            $result = $this->message->sendMessage();
            if ($result > 0) {
                $this->session->set_flashdata('result', 'Message sent successfully!');
                redirect('message/create');
            } else {
                $this->session->set_flashdata('result', 'Message wasnt sent! Please try again');
                redirect('message/create');
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