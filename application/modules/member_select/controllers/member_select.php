<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class member_select extends MX_Controller {
	
	function index($select_limit = 1, $input_field_name = "member_id")
	{
		
		$data['select_limit'] = $select_limit;
		$data['input_field_name'] = $input_field_name;
		$this->load->view('select', $data);
		
	}


	function form_search()
	{
		//echo 'here...';

		$q = $this->input->post('q');

		$this->load->model('member_select_model');

		echo json_encode($this->member_select_model->fetch_members($q));
		
	}
	
		
		
}