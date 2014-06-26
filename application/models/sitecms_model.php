<?php
/**
 * Created by PhpStorm.
 * User: Samuel Okoroafor
 * Date: 1/25/14
 * Time: 7:05 AM
 */
class SiteCMS_Model extends CI_Model
{
    var $content_id=0;
    var $author_id='';
    var $title='';
    var $alias='';
    var $content='';
    function __construct()
    {
        parent::__construct();
    }
    public function save()
    {
					// create users author id from session data
					$user = $this->session->userdata('id');
					
        			// generate date the content was created
					$datestring= "%Y/%m/%d %h:%i %a"; // create date and time
					$time = time();
					$datetime = mdate($datestring, $time);
					
					// for menu link to the page
					$slug = url_title($this->input->post('post_title'), 'dash', TRUE);
				
		
		
		//accept the posted data and persist to the database
		
		$new_insert = array(
			'author_id' => $user,
			'title' => $this->input->post('post_title'),
			'alias' => $this->input->post('alias'),
			'slug' => $slug,
			'content' => $this->input->post('content_2'),
			'published' => $this->input->post('publish_page'),
			'access' => $this->input->post('access'),
			'date_created' => $datetime
			);
			
        $result=$this->db->insert('site_content', $new_insert);
        return $result;
    }
	
		
		
		public function update($id, $data) {
			
			$slug = url_title($this->input->post('post_title'), 'dash', TRUE);
			// generate date the content was updated
					$datestring= "%Y/%m/%d %h:%i %a"; // create date and time
					$time = time();
					$datetime = mdate($datestring, $time);

			$data = array(
               'title' => $this->input->post('post_title'),
               'alias' => $this->input->post('alias'),
    			'slug' => $slug,
               'content' => $this->input->post('content_2'),
			   'published' => $this->input->post('publish_page'),
			   'access' => $this->input->post('access'),
               'updated' => 1,
	   			'date_created' => $datetime
            );

				$this->db->where('content_id', $id);
				$this->db->update('site_content', $data);

				}
		
		
		function search($limit, $offset) {
					
			 //actual results query
			$query = $this->db->select('*')
			->from('site_content')
			->order_by('date_created DESC')
			->limit($limit, $offset);
			$result['rows'] = $query->get()->result();
					
			// count query
			$query = $this->db->select('COUNT(*) as count', FALSE)
					->from('site_content');
					$tmp = $query->get()->result();
					$result['num_rows'] = $tmp[0]->count;
					return $result;			
			
			}
			
			
				function deletepage() {
		
		$this->db->where('content_id', $this->uri->segment(3));
		$this->db->delete('site_content');
		
		}
			
		
}

