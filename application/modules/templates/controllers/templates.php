<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Templates extends MX_Controller {
		
		function main_site($data) {
			
		$this->load->model('templatesmodel');

		// to select user pic
		$images = $this->templatesmodel->get_image();
       	$data['photos'] = $images['rows'];
		
		// to select user role
		$sub = $this->templatesmodel->get_role();
       	$data['roles'] = $sub['rows'];
		
		// to get coperator's contribution balance
		$bal = $this->templatesmodel->get_balance();
       	$data['balances'] = $bal['rows'];
		
		// to get coperator's outstanding loan
		$loanbal = $this->templatesmodel->get_loan();
       	$data['loans'] = $loanbal['rows'];
					
		// to get all members to the admin sidebar overview
        $results = $this->templatesmodel->get_all_members();
        $data['num_results'] = $results['num_rows'];
		
		$results = $this->templatesmodel->get_active_loans();
        $data['num_loans'] = $results['num_rows'];
		
		$results = $this->templatesmodel->get_active_asset_loans();
        $data['num_assets'] = $results['num_rows'];
		//end: side bar members overview

		//begin: to get menu for features in sidebar
            $menu = $this->templatesmodel->get_menu();

            $data['menus'] = $menu['rows'];
            $data['num_menu'] = $menu['num_rows'];
		
		
		//begin: to get site wide settings
            $query = $this->templatesmodel->get_sitelogo();
            $data['logos'] = $query['rows'];
			
			$query = $this->templatesmodel->get_settings();
            $data['settings'] = $query['rows'];
			
			$sub = $this->templatesmodel->get_display_settings();
            $data['displays'] = $sub['rows'];

            //end: to get menu for features in sidebar

       // $data['num_results'] = $results['num_rows'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar', $data);
			$this->load->view('main_content', $data);
			$this->load->view('footer', $data);

		
		
		}
		
		function login($data) {

            $this->load->model('templatesmodel');
		
        //begin: to get site wide settings
            $query = $this->templatesmodel->get_sitelogo();
            $data['logos'] = $query['rows'];
			
			$query = $this->templatesmodel->get_settings();
            $data['settings'] = $query['rows'];
			
			$sub = $this->templatesmodel->get_display_settings();
            $data['displays'] = $sub['rows'];

            //end: to get menu for features in sidebar

       // $data['num_results'] = $results['num_rows'];
	   
			$this->load->view('header_login', $data);
			$this->load->view('maincontent_login', $data);
			$this->load->view('footer', $data);
		
		
		}



}