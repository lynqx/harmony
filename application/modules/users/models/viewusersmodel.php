<?php

class viewusersmodel extends CI_Model
{


    function search($limit, $offset)
    {

        //actual results query
        $query = $this->db->select('UNIX_TIMESTAMP() - last_login AS TimeSent, users.id, firstname, lastname, username, email, phone_number, last_login, active')
            ->from('users')
			->join('cooperators', 'cooperators.user_id = users.id')
            ->limit($limit, $offset);
        $result['rows'] = $query->get()->result();

        // count query
        $query = $this->db->select('COUNT(*) as count', FALSE)
            ->from('users');
        $tmp = $query->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;

    }


    function searchpending($limit, $offset)
    {

        //actual results query
        $query = $this->db->select('UNIX_TIMESTAMP() - last_login AS TimeSent, users.id, firstname, lastname, username, email, phone_number, last_login, active')
            ->from('users')
			->join('cooperators', 'cooperators.user_id = users.id')
            ->where('active', 0)
            ->limit($limit, $offset);
        $result['rows'] = $query->get()->result();

        // count query
        $query = $this->db->select('COUNT(*) as count', FALSE)
            ->from('users')
            ->where('active', 0);
        $tmp = $query->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;

    }


    function deleteuser()
    {

        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('members');

    }

    function get_user($username)
    {
        $this->db->select('email, mobile, firstname, lastname');
        $this->db->from('members');
        $this->db->where('username', $username);

        $query = $this->db->get();

        $users = array();

        foreach ($query->result() as $row) {
            $user = new ViewUsersModel();
            $user->email = $row->email;
            $user->firstname = $row->firstname;
            $user->lastname = $row->lastname;
            $user->mobile = $row->mobile;

            $users[] = user;
        }

        return users;
    }

}