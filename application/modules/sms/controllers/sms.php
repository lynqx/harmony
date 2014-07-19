<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User: "Lynqx"
 * Date: 2/4/14
 * Time: 9:57 PM
 */
//TODO: A very small module for sending emails

class Sms extends MX_Controller
{
	
	
	function __construct()
    {
        parent::__construct();
        Modules::run('login/is_logged_in');
    }

	
/*
not used, auth details from db.sms_admin table
   // var $user = "cow_sms";
	//var $pass = "c0w123";
	//var $sender = "Armony";
*/

    public function bulk_sms()
    {


        //TODO: Run validations
        $this->load->library('form_validation');

        $this->form_validation->set_rules('group', 'Group', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $this->index();

        } else {

            $this->db->select('username, password, sender_id');
            $this->db->from('sms_admin');
				$query = $this->db->get();

				 $row = $query->row();

				//TODO: Collect the emails together in an array
				$user = $row->username;
                $pass = $row->password;
                $from = $row->sender_id;

            if (isset($_POST['send'])) {

                $group = $this->input->post('group');
                $country_code = '234';

                $query = $this->db->query("SELECT users.id, users.mobile FROM users JOIN groupmembers on groupmembers.member_id = users.id
						WHERE groupmembers.group_id = '$group'");


                foreach ($query->result_array() as $row) {
												$mobilenumber = $row['mobile'];

                    if (substr($mobilenumber, 0, 1) == '0') {
                        $to = $country_code . substr($mobilenumber, 1);
                    } else {
												$to = $mobilenumber;
												}


                    $to = preg_replace("/[^0-9,]/", "", $to);
                    $message = $this->input->post('message');
							$msg = rawurlencode($message); // It is important that you use urlencode() here in order to manage special characters.


                    // build HTTP URL and query
                    $postdata = 'user='.$user.'&pass='.$pass.'&from='.$from.'&to='.$to.'&msg='.$msg; //initialize the request variable
        //echo $postdata;

         $url = 'http://www.nuobjects.com/nusms/'; //this is the url of the gateway's interface
        $ch = curl_init(); //initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $url); //set the url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
        curl_setopt($ch, CURLOPT_POST, 1); //set POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); //set the POST variables
        $response = curl_exec($ch); // grab URL and pass it to the browser. Run the whole process and return the response
        curl_close($ch); //close the curl handle

                }

                // return $response;
		$this->session->set_flashdata('result', 'Success : Message Sent Successfully');
                redirect('sms');

            }
        }

	}

    /** This module method should only be called after you have cleaned up your data
     * Method name: sendMail
     * This method sends email to every member on this platform
     * @param $subject
     * @param $message
     * @param $sender
     */
    public function index()
    {

        $data['page_title'] = 'Send group messages';
        $data['module'] = 'sms';
        $data['view_file'] = 'group_sms';

        echo Modules::run('templates/main_site', $data);

    }

    public function single_sms($msg) // plugged in for single sms notificatios
    {
       // TODO: Ensure the user is logged in
        //TODO: if the user survives this, he/she has been cleared

		//$from = rawurlencode($this->sender); //LOOK MAX 11 CHARs. This is the senderID that will appear on the recipients Phone.
        //$msg = rawurlencode($message); // It is important that you use urlencode() here in orde to manage special characters.
       // $to = preg_replace("/[^0-9,]/", "", $to);
	  		$this->db->select('username, password, sender_id');
            $this->db->from('sms_admin');
            $query = $this->db->get();

				 $row = $query->row();

				//TODO: Collect the emails together in an array
				$user = $row->username;
                $pass = $row->password;
                $from = $row->sender_id;
				
				// to get mobile no to send sms
			$update_id = $this->input->post('member');
			if (isset($update_id) && is_numeric($update_id)) {

			$data = $this->get_mobile_from_db($update_id);
			
			$mobilenumber = $data['mobile'];
			$country_code = '234';

		if ( substr($mobilenumber,0,1) == '0') 
			{ 
			$to = $country_code . substr($mobilenumber,1);
			} else {
					$to=$mobilenumber;
			}
						
		$msg = rawurlencode($msg); // It is important that you use urlencode() here in order to manage special characters.
		$to = preg_replace("/[^0-9,]/", "", $to);

			        
        // build HTTP URL and query
        $postdata = 'user='.$user.'&pass='.$pass.'&from='.$from.'&to='.$to.'&msg='.$msg; //initialize the request variable
        

        $url = 'http://www.nuobjects.com/nusms/'; //this is the url of the gateway's interface
			
        $ch = curl_init(); //initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $url); //set the url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
        curl_setopt($ch, CURLOPT_POST, 1); //set POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); //set the POST variables
        $response = curl_exec($ch); // grab URL and pass it to the browser. Run the whole process and return the response
        curl_close($ch); //close the curl handle
        
        return $response;
		
   		 }
	
	}
	
	
	//query users db.table for mobile number

    function get_mobile_from_db($update_id)
    {

        $query = $this->db->query("SELECT mobile FROM users WHERE id = '$update_id'");

        if ($query->num_rows > 0) {

            foreach ($query->result() as $row) {
                $data['mobile'] = $row->mobile;
            }
            return $data;
        } else {

            echo 'no mobile number selected';
            die();

        }
    }


    //........................for update notification .....................................

    function get_group_mobile_from_db($update_id)
    {

        $query = $this->db->query("SELECT users.id, users.mobile FROM `users` JOIN `groupmembers` on users.id=groupmembers.member_id
		WHERE groupmembers.group_id = '$update_id'");
		if ($query->num_rows > 0) {

            foreach ($query->result_array() as $row) {
                $data['mobile'] = $row['mobile'];
					}
					return $data;
					} else {

            echo 'no mobile number selected';
            die();

        }
    }


    //query users db.table for data

    public function update_sms($mobilenumber, $msg) // plugged in for single sms notificatios
    {

        $this->db->select('username, password, sender_id');
        $this->db->from('sms_admin');
            $query = $this->db->get();

				 $row = $query->row();

				//TODO: Collect the emails together in an array
				$user = $row->username;
                $pass = $row->password;
                $from = $row->sender_id;

        // to get mobile no to send sms
        $country_code = '234';

        if (substr($mobilenumber, 0, 1) == '0') {
            $to = $country_code . substr($mobilenumber, 1);
        } else {
					$to=$mobilenumber;
			}

        $msg = rawurlencode($msg); // It is important that you use urlencode() here in order to manage special characters.
        $to = preg_replace("/[^0-9,]/", "", $to);

        // build HTTP URL and query
        $postdata = 'user='.$user.'&pass='.$pass.'&from='.$from.'&to='.$to.'&msg='.$msg; //initialize the request variable


        $url = 'http://www.nuobjects.com/nusms/'; //this is the url of the gateway's interface

        $ch = curl_init(); //initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $url); //set the url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
        curl_setopt($ch, CURLOPT_POST, 1); //set POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); //set the POST variables
        $response = curl_exec($ch); // grab URL and pass it to the browser. Run the whole process and return the response
        curl_close($ch); //close the curl handle

        return $response;

    }


}

/* End of file Sms.php */