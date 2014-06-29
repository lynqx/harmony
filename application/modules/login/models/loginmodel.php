<?php

class loginmodel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_table()
    {
        $table = "users";
        return $table;
    }


    function validate()

    {
			$this->db->select('UNIX_TIMESTAMP() - last_login AS TimeSent, users.id, firstname, lastname, username, email, phone_number, image, last_login, active');
            $this->db->from('users');
			$this->db->join('cooperators', 'cooperators.user_id = users.id');
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('passwd', SHA1($this->input->post('password')));
			$this->db->where('active', 1);
			$query =  $this->db->get();

        if ($query->num_rows == 1) {

            return $query;
        }

    }


    function get_member_details($id = false)
    {
        if (!$id) {
            // Set Active Record where to the current session's username
            if ($this->session->userdata('username')) {
                $this->db->where('username', $this->session->userdata('username'));
            } else {
                // Return a non logged in person from accessing member profile dashboard
                return false;
            }
        } else {
            // get the user by id
            $this->db->where('id', $id);
        }
        // Find all records that match this query
        $query = $this->db->get('users');
        // In this case because we don't have a check set for unique username
        // we will return the last user created with selected username.
        if ($query->num_rows() > 0) {
            // Get the last row if there are more than one
            $row = $query->last_row();
            // Assign the row to our return array
            $data['id'] = $row->id;
            $data['firstname'] = $row->firstname;
            $data['lastname'] = $row->lastname;
            // Return the user found
            return $data;
        } else {
            // No results found
            return false;
        }
    }

    function _update($id, $data)
    {

        $table = $this->get_table();
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }


}