<?php

class ProfileModel extends CI_Model
{

    public function get_profile($id = FALSE)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }


    function get_image($id)
    {

        // query userphoto db to get user image
        $query = $this->db->select('*')
            ->from('userphoto')
            ->where('id', $id);
        $result['rows'] = $query->get()->result();

        return $result;

    }


    function deleteuser()
    {

        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('users');

    }


    public function view_users($slug = FALSE)
    {
        if ($slug === FALSE) {
            $query = $this->db->get('users');
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('id' => $this->uri->segment(3)));
        return $query->row_array();
    }


    function viewuser()
    {


        $this->db->where('id', $this->uri->segment(3))
            ->from('users');
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


}