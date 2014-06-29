<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Users extends MX_Controller
{
	
	 function __construct()
    {
        parent::__construct();
        //Modules::run('login/is_logged_in');
		$this->load->model('userviewmodel', 'userview');

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
	
	
	public function view($update_id)
				{
						
		$update_id = $this->uri->segment(3);
		
		if (!isset($update_id)) {
			$update_id = $this->input->post('update_id', $id);
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
					
					// send sms notification
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
					
					//}
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
					
					// send sms notification
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
					
					//}
					}
					

					} //end foreach
					redirect('users');
				
					} else {
						$this->session->set_flashdata('result', 'Error : Select a member to update');
						redirect('users');
							} 
				} else {
						$this->session->set_flashdata('result', 'Error : Select an action to perfrom');
						redirect('users');
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
	
	

}