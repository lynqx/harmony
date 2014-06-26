<?php
## created by Akinjiola

class smsModel extends CI_Model
{

// not used
    function get_mobile()
    {

        //actual results query
        $group = $this->input->post('group');
        $query = $this->db->select('users.id, users.mobile')
            ->from('users')
            ->join('groupmembers', 'groupmembers.member_id = users.id')
            ->where('groupmembers.group_id', $group);
        $result['rows'] = $query->get()->result();

        return $result;

    }


}