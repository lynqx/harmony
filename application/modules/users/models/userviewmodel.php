<?php

class userviewmodel extends CI_Model
{

    public function get_user($update_id = FALSE)
    {
        $this->db->select('*');
		$this->db->from('users');
		$this->db->join('cooperators', 'cooperators.user_id = users.id');
		$this->db->where(array('users.id' => $update_id));
		$query = $this->db->get();
        return $query->row_array();
    }
	
	public function get_profile($id = FALSE)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }


    function get_image($update_id)
    {

        // query userphoto db to get user image
        $query = $this->db->select('*')
            ->from('userphoto')
            ->where('id', $update_id)
            ->limit(1);
        $result['rows'] = $query->get()->result();

        return $result;

    }


    function deleteuser()
    {

        $this->db->where('member_id', $this->uri->segment(3));
        $this->db->delete('members');

    }


    function viewuser()
    {


        $this->db->where('member_id', $this->uri->segment(3))
            ->from('members');
        $query = $this->db->get();
        $results['rows'] = $query->row_array();
        return $results;


        if ($query->num_rows() > 0) {
            $row = $query->row_array();

            echo $row['title'];
            echo $row['name'];
            echo $row['body'];
        }

    }


    public function update_cooperator($update_id, $data)
    {

        // generate date the content was updated
        $datestring = "%Y/%m/%d %h:%i %a"; // create date and time
        $time = time();
        $datetime = mdate($datestring, $time);

        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'phone_number' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'home_address' => $this->input->post('homeaddress'),
            'home_town' => $this->input->post('hometown'),
            // 'updated' => 1
        );

        $this->db->where('user_id', $update_id);
        $this->db->update('cooperators', $data);

    }


    public function update_address($update_id, $data)
    {

        // generate date the content was updated
        $datestring = "%Y/%m/%d %h:%i %a"; // create date and time
        $time = time();
        $datetime = mdate($datestring, $time);

        $data = array(
            'addressline1' => $this->input->post('addressline1'),
            'addressline2' => $this->input->post('addressline2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country')
        );

        $this->db->where('id', $update_id);
        $this->db->update('address', $data);

    }

}