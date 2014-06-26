<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/27/14
 * Time: 6:51 AM
 */

class Message_model extends CI_Model
{
    //TODO: Fields to help store message_model data
    var $message_id = 0; //The message Id
    var $sender_name = ''; //The message sender
    var $message_title = ''; //The Subject for the message
    var $message_date = ''; //The date the message was sent
    var $message_receiver = '';
    var $message_content = '';

    function __construct()
    {
        parent::__construct();
    }

    function sendMessage()
    {
        //TODO: Get the current user from the session
        $this->load->library('session');
        $sender_id = $this->session->userdata('id');

        //TODO: Get the message data from the post
        $receiver_id = $this->input->post('receiver_id');
        $subject = $this->input->post('subject');
        $content = $this->input->post('content');

        //TODO: Persist to the msg table first
        $message_insert_data = array(
            'subject' => $subject,
            'content' => $content
        );
        $this->db->insert('msg', $message_insert_data);
        $msg_id = $this->db->insert_id();

        $bridge_insert_data = array(
            'receipient_id' => $receiver_id + 0, //little trick to auto-convert into integer
            'sender_id' => $sender_id + 0,
            'message_id' => $msg_id + 0,
            'state' => 'sent'
        );
        $result = $this->db->insert('user_messages', $bridge_insert_data);
        return $result;

    }

    function loadMessages($userId, $type = 'inbox')
    {
        //TODO: Strategy is to use the input parameter to sort the message query.
        //TODO: The default is inbox

        $result_array = array();
        if ($type == 'inbox') {
            $this->db->select('sender_id,message_id,state');
            $this->db->from('user_messages');
            $this->db->where('receipient_id', $userId);
            $this->db->where('state', 'sent'); //The state for sent messages would be sent
            $query = $this->db->get();

            //TODO: Now use the message_id and sender_id to load additional information
            foreach ($query->result() as $row) {
                $sender = $row->sender_id;
                $msg_id = $row->message_id;
                //TODO: Get the sender's name
                $username = $this->_getUserName($sender);
                //TODO: Get the message title and date_sent
                $this->db->select('subject,sent_time');
                $this->db->from('msg');
                $this->db->where('id', $msg_id);
                $result = $this->db->get(); //->result();
                //TODO: Declare and instance for Message_model and store the collected information
                foreach ($result->result() as $message) {
                    $msg = new Message_model();
                    $msg->message_id = $msg_id;
                    $msg->message_date = $message->sent_time;
                    $msg->message_title = $message->subject;
                    $msg->sender_name = $username;
                    //TODO: Now that we have all the data we need, we store this object in the result_array
                    $result_array[] = $msg;
                }
            }
            //TODO: Having retrieved all records, return the result_array
            return $result_array;
        } else if ($type == 'sent') {
            //TODO: What we would try to achieve here is to retrieve all the messages that the requesting user has sent
            $this->db->select('receipient_id,message_id,state');
            $this->db->from('user_messages');
            $this->db->where('sender_id', $userId);
            $this->db->where('state', 'sent'); //The state for sent messages would be sent
            $query = $this->db->get();

            //TODO: Now use the message_id and receipient_id to retrieve all the messages sent by the requesting user
            foreach ($query->result() as $row) {
                $receiver = $row->receipient_id;
                $msg_id = $row->message_id;
                //TODO: Get the sender's name
                $username = $this->_getUserName($receiver);
                //TODO: Get the message title and date_sent
                $this->db->select('subject,sent_time');
                $this->db->from('msg');
                $this->db->where('id', $msg_id);
                $result = $this->db->get(); //->result();
                //TODO: Declare and instance for Message_model and store the collected information
                foreach ($result->result() as $message) {
                    $msg = new Message_model();
                    $msg->message_id = $msg_id;
                    $msg->message_date = $message->sent_time;
                    $msg->message_title = $message->subject;
                    $msg->message_receiver = $username;
                    //TODO: Now that we have all the data we need, we store this object in the result_array
                    $result_array[] = $msg;
                }
            }
            //Having retrieved the messages, return the result
            return $result_array;
        }
    }

    private function _getUserName($userId)
    {
        //TODO: This function allows you to get a user's name
        $this->db->select('users.username');
        $this->db->from('users');
        $this->db->where('users.id', $userId);
        $result = $this->db->get();
        return $result->result()[0]->username; //TODO: Ensure you extract the username as a field: $result->username
    }

    function getMessage($id)
    {
        //TODO: get the sender's name, id, message title and message content
        $query = 'SELECT msg.id,msg.content,msg.subject,msg.sent_time,user_messages.sender_id,user_messages.state,users.username FROM msg JOIN user_messages ON user_messages.message_id=msg.id JOIN users ON users.id=user_messages.sender_id WHERE msg.id=? AND user_messages.state="sent"';
        $result = $this->db->query($query, array($id));
        //TODO: Since we are expecting just one result
        $messageBag = array();
        foreach ($result->result() as $row) {
            //TODO: Create Message_model
            $message = new Message_model();
            $message->sender_name = $row->username;
            $message->message_date = $row->sent_time;
            $message->message_id = $row->id;
            $message->message_title = $row->subject;
            $message->message_content = $row->content;
            $messageBag[] = $message;
        }
        return $messageBag;
    }

    function deleteMessage($id)
    {
        //TODO: Delete the Message with the supplied ID
        try {
            //TODO: Delete from the user_messages table

            $tables = array('user_messages');
            $this->db->where('message_id', $id);
            $this->db->delete($tables);

            //TODO: Delete from the message table

            $tables=array('msg');
            $this->db->where('id',$id);
            $this->db->delete($tables);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
	
	
			function count() {
				
        $id = $this->session->userdata('id');

	$query = $this->db->select('COUNT(*) as count', FALSE)
					->from('user_messages')
					->where('recepient_id', $id);

					$tmp = $query->get()->result();
					$result['num_rows'] = $tmp[0]->count;
					return $result;			
			
			}
} 