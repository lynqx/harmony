<?php

class changepwdmodel extends CI_Model
{


    function validate()

    {

        $user = $this->session->userdata('id');

        $this->db->where('id', $user);
        $this->db->where('passwd', SHA1($this->input->post('password')));
        //$this->db->where('active', 1);
        //$this->db->limit(1);
        $query = $this->db->get('users');

        if ($query->num_rows > 0) {

            return $query;

        }

    }

    public function update($id)
    {
        $id = $this->session->userdata('id');

        // generate date the content was updated
        $datestring = "%Y/%m/%d %h:%i %a"; // create date and time
        $time = time();
        $datetime = mdate($datestring, $time);

        $data = array(
            'passwd' => SHA1($this->input->post('password'))

        );

        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->update('users', $data);

    }

    public function updatePassword($userId, $oldpassword, $password)
    {

        //TODO: Check the old password before modifying the new one
        $this->db->select('passwd');
        $this->db->from('users');
        $this->db->where('id', $userId);
        $result = $this->db->get();
        $result = $result->result();
        //print_r($result);
        if (sha1($oldpassword) != $result[0]->passwd) {
            return null;
        } else {
            $data = array('passwd' => sha1($password));
            $this->db->where('id', $userId);
            $result = $this->db->update('users', $data);
            return $result;
        }

    }


}