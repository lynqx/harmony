<?php

class Login extends MX_Controller
{

    function index()
    {

        //TODO: check that the user session contains the username
        if ($this->session->userdata('username')) {
            //TODO: check that the user has the permission to view admin
            if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") {
                redirect('admin');
            }
        }

        $data['page_title'] = 'Login Page';
        $data['module'] = 'login';
        $data['view_file'] = 'login_form';

        echo Modules::run('templates/login', $data);

    }

    function validate_credentials()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {


            $this->load->model('loginmodel');
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
                        'address' => $row->address,
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
                $data['module'] = 'login';
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
            echo 'You don\'t have permission to access this page. <a href="' . base_url() . 'login">Login</a>';
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
	
	
	
	/*------------------------ CHANGE PASSWORD ----------------------------*/
	public function changepwd()
    {
		//Change password merged into login sub-module
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: The user has been cleared to proceed if he's still here after that module runs

        $data['page_title'] = 'Change Password';
        $data['module'] = 'login';
        $data['view_file'] = 'change_pwd';

        echo Modules::run('templates/main_site', $data);

    }
	
	public function updatepwd()
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
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
				$this->changepwd();

        } else {

            //check if it matches old password
            // and there is user id ## extra security

            $this->load->model('changepwdmodel');
            
            $id = $this->session->userdata('id');
            $password = $this->input->post('password');
            $oldpassword = $this->input->post('oldpassword');
            $result = $this->changepwdmodel->updatePassword($id, $oldpassword, $password);

            if ($result != null) {

                //TODO: This means we were successful.Let's tell the user the good news
                $this->session->set_flashdata('error', 'Password updated successfully!');
                
				$this->changepwd();

                
					} else {
						$this->session->set_flashdata('error', 'Password change unsuccessful!');
						
						$this->changepwd();

					}
        }


    }
	
		/*------------------------ END CHANGE PASSWORD ----------------------------*/

		
		/*------------------------ FORGOT PASSWORD ----------------------------*/
				function forgot()
				{

						$data['page_title'] = 'Forgot Password';
						$data['module'] = 'login';
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

						$this->forgot();

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
                
								$this->forgot();

							} else {

								$data['error'] = 'Your password cannot be changed at the moment due to technical reasons. Please try again later.';
								$data['page_title'] = 'Forgot Password';
								$data['module'] = 'login';
								$data['view_file'] = 'forgot_password';

								echo Modules::run('templates/main_site', $data);
							}

						} else {
							$data['error'] = 'Your email does not exist in our database. Please contact an administrator to create an account.';
							$data['page_title'] = 'Forgot Password';
							$data['module'] = 'login';
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
			redirect('login');

		}
		
				/*------------------------ END LOGOUT ----------------------------*/

		
}