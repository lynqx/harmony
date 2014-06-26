<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Contact extends MX_Controller {
	

		function index()
				{
					
					$data['page_title'] = 'Contact Us';
					$data['module'] = 'contact';
					$data['view_file'] = 'ContactPage';
					
					echo Modules::run('templates/main_site', $data);
					
				}



	function submit()
				{
	
						
			//form_validation helper has been autoloaded
			
		$this->form_validation->set_rules('name', 'Name', 'trim|required' );
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'  );
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required'  );
		$this->form_validation->set_rules('message', 'Message', 'trim|required'  );

				if($this->form_validation->run() == FALSE) 
					
					{
						$this->index();

					} else {
		
			// validation passed, then send to db
			// add to db
						
			$this->load->model('contactModel');							
			if($query = $this->contactModel->send_record())
					
					{	
		
			// send the mail then load a success page

						
					$admin = 'admin@armony.com';
					
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$mobile = $this->input->post('mobile');
					$message = $this->input->post('message');
					
					// send the details to administrator's mail
						
					$this->email->set_newline("\r\n");
					
					$this->email->from($email . 'ARMONY CTCS Portal');
					$this->email->to($admin);
					$this->email->subject('Message from' . $name); 
					$this->email->message('Message fom a user of Armony CTCS Portal. \n View the message below. \n\n
					Name :' . $name . '\n Email : ' . $email . '\n Mobile No. : \n' . $mobile . '\n \n MESSAGE : ' . $message );
					
					//$path = $this->config->item('server_root');
					//$file = $path . '/joit/uploads/' . $attach ;
					//$this->email->attach($file);
					
					// send mail
					$this->email->send();
					
					//load view
					$data['page_title'] = 'Message Sent';
					$data['module'] = 'contact';
					$data['view_file'] = 'ContactSuccess';
					
					echo Modules::run('templates/main_site', $data);						
												
					} else {

					$this->index();

					}
		
				}
			
			}
			
			
			function view($offset = 0)
    {
        $limit = 20;

        $this->load->model('contactmodel');
        $results = $this->contactmodel->search($limit, $offset);
        $data['contacts'] = $results['rows'];
        $data['contact_count'] = $results['num_rows'];

        //pagination
        // set configurations

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = site_url('contact/view');
        //$config['total_rows'] = $data['num_results'];
        $config['total_rows'] = $data['contact_count'];
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

        $data['page_title'] = 'Manage Site Enquiries';
        $data['module'] = 'contact';
        $data['view_file'] = 'view_enquiries';

        echo Modules::run('templates/main_site', $data);

    }
		
		
		
		function read()
				{
					$contactId = $this->uri->segment(3);
					if (is_numeric($contactId)) {
					$data = $this->get_data_from_db($contactId);
					
					$name = $data['name'];
					//echo $name;
					//die();

					$data['page_title'] = 'Contact from ' .$name;
					$data['module'] = 'contact';
					$data['view_file'] = 'Contact_view';
					
					echo Modules::run('templates/main_site', $data);
					
				} else {
					
					$this->view();
					}
					
			}
				
				
				
		//query users db.table for data
		function get_data_from_db($contactId) {
					
				$data = array(
               'status' => 1
            );

				$this->db->where('contact_id', $contactId);
				$sql = $this->db->update('contact', $data);
				if ($sql) {
		$query = $this->db->query("SELECT * FROM contact WHERE contact.contact_id = '$contactId'");
		
		foreach($query->result() as $row) {
			
			$data['name'] = $row->name;
			$data['email'] = $row->email;
			$data['mobile'] = $row->mobile;
			$data['message'] = $row->message;
			
			}
			
			return $data;
			}
		
		}
		
		
		function managecontact()
    {

        // Check if update button active, start this

        if (isset($_POST['update'])) {
            $checked = $this->input->post('checkbox');
            for ($i = 0; $i < count($checked); $i++) {
                $contactId = $checked[$i];
              

                $status = $this->input->post('action');
                echo $status;
				

                $data = array(
                    'status' => $status
                );

                $this->db->where('contact_id', $contactId);
                $this->db->update('contact', $data);
                redirect('contact/view');
            }
		}
    }

	
	public function about() // the about us page has been merged into the contact us sub module
	{
		$data['page_title'] = 'About Us';
		$data['module'] = 'contact';
		$data['view_file'] = 'AboutPage';
		
		echo Modules::run('templates/main_site', $data);
		
	}
	
		
		
		
		
}

