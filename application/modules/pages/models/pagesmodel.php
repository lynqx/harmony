<?php

class pagesmodel extends CI_Model {	

					
		
		public function get_fullnews($slug = FALSE)
			{
				if ($slug === FALSE)
				{
					$this->db->order_by('content_id', 'DESC');
					$query = $this->db->get('site_content', 4);
					return $query->result_array();
				}
				
				$query = $this->db->get_where('site_content', array('slug' => $slug));
				return $query->row_array();
			}

			
			
}