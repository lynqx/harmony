<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Users extends MX_Controller
{
	
	 function __construct()
    {
        parent::__construct();
        //Modules::run('users/is_logged_in');
		$this->load->model('userviewmodel', 'userview');
		$this->load->model('register_model', 'register');
		$this->load->model('changepwdmodel', 'change');
		$this->load->model('loginmodel');




    }

	// view your profile
	public function index()
				{
						
        $update_id = $this->session->userdata('id');
		
		if (!isset($update_id)) {
			$update_id = $this->input->post('update_id', $id);
			}
		
		if (is_numeric($update_id)) {
			$data = $this->userview->get_user($update_id);
			$data['update_id'] = $update_id;
			} else {
			$data = $this->get_data_from_post();
				}
							
					$firstname = $data['firstname'];
					$lastname = $data['lastname'];
					$image = $data['image'];
					
                    $data['page_title'] = $firstname. ' ' . $lastname;
					$data['module'] = 'users';
					$data['view_file'] = 'user_view';
					
					echo Modules::run('templates/main_site', $data);

					
	}
	
	// view profile of another user
	// redirected from view all user page
	public function view($update_id)
				{
						
		$update_id = $this->uri->segment(3);
		if (!is_numeric($update_id)) {
			$location = 'users/viewall';
			redirect ($location);
			}
		
		if (is_numeric($update_id)) {
			//$data = $this->get_member_data_from_db($update_id);
			$data = $this->userview->get_user($update_id);
			$data['update_id'] = $update_id;
			} else {
			$data = $this->get_data_from_post();
				}
							
					$firstname = $data['firstname'];
					$lastname = $data['lastname'];
					$image = $data['image'];

                    $data['page_title'] = $firstname. ' ' . $lastname;
					$data['module'] = 'users';
					$data['view_file'] = 'user_view';
					
					echo Modules::run('templates/main_site', $data);

					
	}
		
	//update cooperators profile
	public function update()
			    {
					
					$this->load->library('form_validation');
		
		// validate inputs
		// field name, error message, validation rules
		$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|max_length[30]|xss_clean|');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|');
		$this->form_validation->set_rules('homeaddress', 'Home Address', 'trim|required|xss_clean|');
		$this->form_validation->set_rules('hometown', 'Home Town', 'trim|required|xss_clean|');
		//$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|');
					
				$update_id = $this->input->post('update_id', TRUE);
				
		if($this->form_validation->run() == FALSE)
						{
						$this->session->set_flashdata('result', 'Error : Validation Failed');
						$location = 'users/view/' . $update_id;
						redirect ($location);
						} else {
							
			$data = $this->get_data_from_post();
			
			// if its an update action
			if (is_numeric($update_id)) {
				
			//update db
		  	$this->userview->update_cooperator($update_id, $data);
			
			// if update successful, show success message
			$this->session->set_flashdata('result', 'Success : User Profile Updated Successfully');
			$location = 'users/view/' . $update_id;
		 	redirect ($location);
			
			   } else {
   			$this->session->set_flashdata('result', 'Error : Update failed due to system error. Sorry for all inconviniences');
		 	redirect ($location);

			   }
		 }
    }		
	
    function viewall($offset = 0)
    {
        $limit = 20;

        $this->load->model('viewusersmodel');
        //$data['query'] = $this->viewUsersModel->search($limit, $offset);

        $results = $this->viewusersmodel->search($limit, $offset);
        $data['users'] = $results['rows'];
        $data['num_results'] = $results['num_rows'];
		
		// load groups to add member to groups
        $this->load->model('groups/groupsmodel');
		$sub = $this->groupsmodel->get_groups();
		$data['groups'] = $sub['rows'];
		// end selecting groups to add members
		
		
        //pagination
        // set configurations

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = site_url('viewusers/index');
        //$config['total_rows'] = $data['num_results'];
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;
        $config['url_segment'] = 3;
        //$config['full_tag_open'] = '<ul>';
        //$config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<span style="background-color:#333; color:#fff">';
        $config['cur_tag_close'] = '</span>';
        $config['prev_link'] = 'PREVIOUS';
        $config['next_link'] = 'NEXT';

        //initialize the pagination
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['page_title'] = 'View Users';
        $data['module'] = 'users';
        $data['view_file'] = 'view_users';

        echo Modules::run('templates/main_site', $data);

    }
	
	
	
	function pending($offset = 0)
    {
        $limit = 20;

        $this->load->model('viewusersmodel');
        //$data['query'] = $this->viewUsersModel->search($limit, $offset);

        $results = $this->viewusersmodel->searchpending($limit, $offset);
        $data['users'] = $results['rows'];
        $data['pending_results'] = $results['num_rows'];
		
		// load groups to add member to groups
        $this->load->model('groups/groupsmodel');
		$sub = $this->groupsmodel->get_groups();
		$data['groups'] = $sub['rows'];
		// end selecting groups to add members
		
		
        //pagination
        // set configurations

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = site_url('viewusers/index');
        //$config['total_rows'] = $data['num_results'];
        $config['total_rows'] = $data['pending_results'];
        $config['per_page'] = $limit;
        $config['url_segment'] = 3;
        //$config['full_tag_open'] = '<ul>';
        //$config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<span style="background-color:#333; color:#fff">';
        $config['cur_tag_close'] = '</span>';
        $config['prev_link'] = 'PREVIOUS';
        $config['next_link'] = 'NEXT';

        //initialize the pagination
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['page_title'] = 'View Pending Users';
        $data['module'] = 'users';
        $data['view_file'] = 'pending_users';

        echo Modules::run('templates/main_site', $data);

    }


    function manageuser()
    {

       // Check if save button active, start this 
	
				if(isset($_POST['update'])){
				$checked = $this->input->post('checkbox');
		 		$status = $this->input->post('action');
					 		
				if (isset($status) && $status != "") { 


		  			if (!empty($checked)) {
			  		foreach ($checked as $check) {
				 // echo $check;  			

				$data = array(
				   'active' => $status
							   );
	
					$this->db->where('id', $check);
					$query = $this->db->update('users', $data);
					
					if ($query) {
					
					/* send sms notification
					// Select users mobile no to send notification
					$this->db->select('mobile');
           			$this->db->from('users');
           			$this->db->where('id', $check);
            		$query = $this->db->get();

				 	$row = $query->row();

					//TODO: Call the numbers
					$mobilenumber = $row->mobile;
					if ($status == 1) {
						$stat = 'Active';
						} else {
							$stat = 'Blocked';
							}							
					$msg = 'Your account on the Armony Portal is now ' . $stat;
					// send msg
					Modules::run('sms/update_sms', $mobilenumber, $msg);
					
					}
					*/
					}
					

					} //end foreach
					redirect('users/pending');
				
					} else {
						$this->session->set_flashdata('result', 'Error : Select a member to update');
						redirect('users/pending');
							} 
				} else {
						$this->session->set_flashdata('result', 'Error : Select an action to perfrom');
						redirect('users/pending');
				}
			}
	}
  


    function manageall()   {
		
		// Check if save button active, start this 
	
				if(isset($_POST['update'])){
				$checked = $this->input->post('checkbox');
		 		$status = $this->input->post('action');
					 		
				if (isset($status) && $status != "") { 


		  			if (!empty($checked)) {
			  		foreach ($checked as $check) {
				 // echo $check;  			

				$data = array(
				   'active' => $status
							   );
	
					$this->db->where('id', $check);
					$query = $this->db->update('users', $data);
					
					if ($query) {
					
					/* send sms notification
					// Select users mobile no to send notification
					$this->db->select('mobile');
           			$this->db->from('users');
           			$this->db->where('id', $check);
            		$query = $this->db->get();

				 	$row = $query->row();

					//TODO: Call the numbers
					$mobilenumber = $row->mobile;
					if ($status == 1) {
						$stat = 'Active';
						} else {
							$stat = 'Blocked';
							}							
					$msg = 'Your account on the Armony Portal is now ' . $stat;
					// send msg
					Modules::run('sms/update_sms', $mobilenumber, $msg);

					}
					*/
					}
					

					} //end foreach
					redirect('users/viewall');
				
					} else {
						$this->session->set_flashdata('result', 'Error : Select a member to update');
						redirect('users/viewall');
							} 
				} else {
						$this->session->set_flashdata('result', 'Error : Select an action to perfrom');
						redirect('users/viewall');
				}
				
	} elseif (isset($_POST['join_group'])) {
           
		    $checked = $this->input->post('checkbox');
			$group = $this->input->post('group_action');

			if (isset($group) && $group != "") { 

            if (!empty($checked)) {
			  		
					foreach ($checked as $member) {
				
		 		//call validate function to deny already joined members
            	$this->load->model('groups/groupsmodel');
				$results = $this->groupsmodel->get_group_members($member, $group);
				$data['gp_results'] = $results['num_rows'];
				if ($data['gp_results'] > 0)
				{ 
				$this->session->set_flashdata('result', 'NOTICE: Some of the selected Coperators are already a member of the group.<br />
				However, others who are not have been added to the group');
						redirect('users'); 
				} else {
		        
				//add member to group
            	$this->load->model('groups/groupsmodel');
			    $this->groupsmodel->add_member_group($group, $member);
				}
					}

						$this->session->set_flashdata('result', 'Success : Member successfully added to group');
						redirect('users');
									} else {
				$this->session->set_flashdata('result', 'Error : Select a member to add to group');
						redirect('users');
				}
				} else {
						$this->session->set_flashdata('result', 'Error : Select a group to join');
						redirect('users');
						
				}
			}
		}
		


    function delete()
    {

        $this->load->model('viewusersmodel');
        $this->viewusersmodel->deleteuser();
        $this->index();

    }
	
	
	// extra functions
	
	function get_data_from_post() {
		$data['firstname'] = $this->input->post('firstname', TRUE);		
		$data['lastname'] = $this->input->post('lastname', TRUE);		
		$data['mobile'] = $this->input->post('mobile', TRUE);
		$data['email'] = $this->input->post('email', TRUE);
		$data['username'] = $this->input->post('username', TRUE);
		return $data;
		
		}
	
	
			/*------------------------ START LOGIN SECTION ----------------------------*/

	
	function login()
    {

        //TODO: check that the user session contains the username
        if ($this->session->userdata('username')) {
            //TODO: check that the user has the permission to view admin
            if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") {
                redirect('admin');
            }
        }

        $data['page_title'] = 'Login Page';
        $data['module'] = 'users';
        $data['view_file'] = 'login_form';

        echo Modules::run('templates/login', $data);

    }

    function validate_credentials()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {


            $query = $this->loginmodel->validate();

            if ($query) // if the user's credentials validated...
            {

                foreach ($query->result() as $row) {

                    $data = array(
                        'id' => $row->id,
                        'username' => $row->username,
                        'firstname' => $row->firstname,
                        'lastname' => $row->lastname,
                        //'user_image' => $row->user_image,
                        //'user_level' => $row->user_level,
                        'email' => $row->email,
                        'image' => $row->image,
                        'is_logged_in' => true,
                        //TODO: get the user's role using the username so that it gets stored in the session
                        'role' => modules::run('permissions/getUserRolePermissions', $row->username)->rolename
                    );

                    $this->session->set_userdata($data);
                }

                // after session is started
                // update the lastlogin with current timestamp
                // SELECT UNIX_TIMESTAMP() - date AS TimeSent from ...

                $id = $row->id;
                $datetime = strtotime(date("Y-m-d H:i:s")); // create date and time
                $data = array(
                    'last_login' => $datetime
                );

                $this->db->where('id', $id);
                $this->db->update('users', $data);

                // all passed, redirect to privilege page according to role access
                //TODO: call the permissions module to check if this user is permitted to viewAdmin
                if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") {
                    redirect('admin');
                } else {
                    redirect('home/pages');
                }

            } else {

                $data['page_title'] = 'Login Page';
                $data['module'] = 'users';
                $data['view_file'] = 'login_form';
                $data['error'] = 'Username and Password does not match those on file or you have been blocked from using the portal.';


                echo Modules::run('templates/login', $data);


            }
        }

    }


    function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            echo 'You don\'t have permission to access this page. <a href="' . base_url() . 'users/login">Login</a>';
            die();
        }
    }

    function cp()
    {
        if ($this->session->userdata('username')) {
            // load the model for this controller
            $this->load->model('membership_model');
            // Get User Details from Database
            $user = $this->membership_model->get_member_details();
            if (!$user) {
                // No user found
                return false;
            } else {
                // display our widget
                $this->load->view('templates/login', $user);
            }
        } else {
            // There is no session so we return nothing
            return false;
        }
    }

    function admin_login()
    {
        //TODO: use this controller to handle admin login

    }
	
	
	
		/*------------------------ END LOGIN SECTION ----------------------------*/



		/*------------------------ REGISTER NEW COOPERATOR ----------------------------*/

	// create new cooperator
	
	public function register()
    {
        //TODO: Ensure the user is logged in
        Modules::run('users/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        /*echo "User Data with Roles for schand<br/><hr/>";
        print_r(modules::run('permissions/getUserRolePermissions',"schand"));
        echo "<hr/>";
        echo "<br/>Is schand permitted to Read a doc?<br/>";
        print_r(modules::run('permissions/isPermitted',"schand","canReadDoc"));
        echo "<br/>Can schand view Admin?<br/>";
        echo modules::run('permissions/isPermitted',"schand","canViewAdmin");*/
        $update_id = $this->uri->segment(3);

        if (!isset($update_id)) {
            $update_id = $this->input->post('update_id', $id);
        }

        if (is_numeric($update_id)) {
            $data = $this->get_data_from_db($update_id);
            $data['update_id'] = $update_id;
        } else {
            $data = $this->get_data_from_post();
        }

        $data['page_title'] = 'Membership Account Setup';
        $data['module'] = 'users';
        $data['view_file'] = 'create_member';

        echo Modules::run('templates/main_site', $data);

    }
	
	
	public function createMember()
    {
        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for User Biodata
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[cooperators.email]|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[users.username]|xss_clean');
        $this->form_validation->set_rules('passwd', 'Password', 'trim|required|min_length[6]|xss_clean');
		
        //TODO: The following are validation rules for work information
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required|xss_clean');
        $this->form_validation->set_rules('djc', 'Date Joined Company', 'trim|xss_clean');
		
		//TODO: The following are validation rules for address information
        $this->form_validation->set_rules('homeaddress', 'Home Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('hometown', 'Home Town', 'trim|xss_clean');
        
        //TODO: The following is for the role
        $this->form_validation->set_rules('role', 'Role', 'required');
        //TODO: Run the validation
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $data['page_title'] = 'Membership registration';
            $data['module'] = 'users';
            $data['view_file'] = 'create_member';
            echo Modules::run('templates/main_site', $data);
			
        } else {
		
            //TODO: call the model
            $result = $this->register->create_user();
            if ($result) {
                //TODO: This means we were successful.Let's tell the user the good news
                $data['page_title'] = 'Member Registration Success';
                $data['module'] = 'permissions';
                $data['view_file'] = 'create_user_success';
                echo Modules::run('templates/main_site', $data);

            }

        }


    }
	
	/*------------------------ END REGISTER NEW COOPERATOR ----------------------------*/

	
	

		/*------------------------ CHANGE PASSWORD ----------------------------*/
	public function change()
    {
		//Change password merged into login sub-module
        //TODO: Ensure the user is logged in
        Modules::run('users/is_logged_in');
        //TODO: The user has been cleared to proceed if he's still here after that module runs

        $data['page_title'] = 'Change Password';
        $data['module'] = 'users';
        $data['view_file'] = 'change_pwd';

        echo Modules::run('templates/main_site', $data);

    }
	
	public function updatepwd()
    {
        //TODO: Ensure the user is logged in
        Modules::run('users/is_logged_in');
        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for User Biodata

        $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]|xss_clean');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|xss_clean');

        //TODO: Run the validation
        if ($this->form_validation->run() == FALSE) {
				//if validation fails do nothing
				$this->change();

        } else {

            //check if it matches old password
            // and there is user id ## extra security

            
            $id = $this->session->userdata('id');
            $password = $this->input->post('password');
            $oldpassword = $this->input->post('oldpassword');
            $result = $this->change->updatePassword($id, $oldpassword, $password);

            if ($result != null) {

                //TODO: This means we were successful.Let's tell the user the good news
                $this->session->set_flashdata('error', 'Password updated successfully!');
                
				$this->change();

                
					} else {
						$this->session->set_flashdata('error', 'Password change unsuccessful!');
						
						$this->change();

					}
        }


    }
	
		/*------------------------ END CHANGE PASSWORD ----------------------------*/
		

	/*------------------------ FORGOT PASSWORD ----------------------------*/
	function recover()
				{

						$data['page_title'] = 'Forgot Password';
						$data['module'] = 'users';
						$data['view_file'] = 'forgot_password';

						echo Modules::run('templates/main_site', $data);

				}



				public function getpassword()
				{
					//TODO: Run validations
					$this->load->library('form_validation');

					// field name, error message, validation rules
					//TODO: The following are validation rules for User Biodata

					$this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean');

					//TODO: Run the validation
					if ($this->form_validation->run() == FALSE) {

						$this->recover();

					} else {

						$email = $this->input->post('email');

						$this->db->select('id');
						$this->db->where('email', $this->input->post('email'));
						$query = $this->db->get('users');
						if ($query->num_rows == 1) {

							// create a temp password
							//update db.user
							//send the mail

							// Create a unique password:
							$passwd = uniqid();

							$new_user_update_data = array(
								'passwd' => SHA1($passwd),
							);

							$this->db->where('email', $this->input->post('email'));
							$insert = $this->db->update('users', $new_user_update_data);

							if ($insert) {

								//send the password
								$admin = 'admin@armony.com';

								// send the details to user's mail
								$this->email->set_newline("\r\n");
								$this->email->from($admin . '  ARMONY CTCS PORTAL');
								$this->email->to($email);
								$this->email->subject('User Registration at ARMONY CTCS');
								$this->email->message('Congratulations. \n You have successfully changed your password. Kindly find details below. \n\n Please login with your One Time
													Password below and change the password on your first login as it will expire after login. \n\n 
													One Time Password : ' . $passwd . '\n\n\n Kindly remember to change your password immediately you 			
													login for the first time. \n\n Regards.');

								// send mail
								$this->email->send();
								

								//tell the success story
								$this->session->set_flashdata('error', 'Temporary Password sent to your email address. Please change upon first login!');
                
								$this->recover();

							} else {

								$data['error'] = 'Your password cannot be changed at the moment due to technical reasons. Please try again later.';
								$data['page_title'] = 'Forgot Password';
								$data['module'] = 'users';
								$data['view_file'] = 'forgot_password';

								echo Modules::run('templates/main_site', $data);
							}

						} else {
							$data['error'] = 'Your email does not exist in our database. Please contact an administrator to create an account.';
							$data['page_title'] = 'Forgot Password';
							$data['module'] = 'users';
							$data['view_file'] = 'forgot_password';

							echo Modules::run('templates/main_site', $data);
						}
					}
				}
				
		/*------------------------ END FORGOT PASSWORD ----------------------------*/

	
		/*------------------------ LOGOUT ----------------------------*/

	public function logout()
		{
			$this->session->unset_userdata('is_logged_in');
			$this->session->sess_destroy();
			redirect('users/login');

		}
		
				/*------------------------ END LOGOUT ----------------------------*/
				
				

}