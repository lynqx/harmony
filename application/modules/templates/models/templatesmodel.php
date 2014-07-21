<?php

class TemplatesModel extends CI_Model {


			function get_image() {
				
				$id = $this->session->userdata('id');
			 // query userphoto table to get user image
			if ( $query = $this->db->select('image')
			->from('cooperators')
			->where('user_id', $id)
			->limit(1) ) { 
			$result['rows'] = $query->get()->result();	
			return $result;	
			} else {
				return FALSE;
				}
			}
			
			
			function get_role() {
				
				$id = $this->session->userdata('id');
			if ( $query = $this->db->select('*')
			->from('user_roles')
			->where('user_id', $id)
			->limit(1) ) { 
			$result['rows'] = $query->get()->result();	
			return $result;	
			} else {
				return 0;
				}
			}
			
			
			function get_balance() {
				
				$id = $this->session->userdata('id');
			 // query userphoto db to get user image
			$query = $this->db->select_sum('balance')
			->from('contribution_accounts')
			->where('owner_id', $id);
			$result['rows'] = $query->get()->result();	
			
			return $result;	
			
			}
			
			
			function get_loan() {
				
				$id = $this->session->userdata('id');
			 // query userphoto db to get user image
			$query = $this->db->select_sum('loanbalance')
			->from('activeloan')
			->where('member_id', $id);
			$result['rows'] = $query->get()->result();	
			
			return $result;	
			
			}


				function get_all_members() {

			// count query
			$query = $this->db->select('COUNT(*) as count', FALSE)
					->from('members');
					$tmp = $query->get()->result();
					$result['num_rows'] = $tmp[0]->count;
					return $result;			
			
			}
			
			function get_active_loans() {

			// count query
			$query = $this->db->select('COUNT(*) as count', FALSE)
					->from('activeloan')
					->where('status', 'Active');
					$tmp = $query->get()->result();
					$result['num_rows'] = $tmp[0]->count;
					return $result;			
			
			}
			
			function get_active_asset_loans() {

			// count query
			$query = $this->db->select('COUNT(*) as count', FALSE)
					->from('activeasset')
					->where('status', 'Active');
					$tmp = $query->get()->result();
					$result['num_rows'] = $tmp[0]->count;
					return $result;			
			
			}
			
			
			function get_menu() {
					
			
									// count query
									$query = $this->db->select('COUNT(*) as count', FALSE)
									->from('site_content')
									->where('published', 1);
									$tmp = $query->get()->result();
									$result['num_rows'] = $tmp[0]->count;
							
			 //actual results query
			 $query = $this->db->select('title, alias, slug')
			->from('site_content')
			->where('published', 1);
			$result['rows'] = $query->get()->result();	
			
			return $result;	

			}
			

	function count_message ()
		{
				$this->db->where('user_id', $this->session->userdata('user_id'));
				echo $this->db->count_all('messages');
				$query = $this->db->get('messages');
				return $query;
	
		}
		
			
			
}