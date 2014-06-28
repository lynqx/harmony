<?php

class groupsmodel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    function create_group()
    {
        //TODO: use the supplied data to create a new loan
        // create date and time for last login
        $datetime = strtotime(date("Y-m-d H:i:s"));
        //$date = NOW();
        $userId = $this->session->userdata('id');
        $groupname = $this->input->post('groupname');
        $groupdesc = $this->input->post('groupdesc');
        //TODO: Capture and store Address Info first
        $loan_insert_data = array(
            'group_name' => $groupname,
            'group_desc' => $groupdesc,
            'group_admin' => $userId,
            // group not active by default
            'status' => 'suspended',
            'date' => $datetime
        );
        $insert = $this->db->insert('groups', $loan_insert_data);

        //TODO: if insert was successful, add the user to a role before returning results
        if ($insert) {

            //TODO: Get the sender from the session
            // $this->load->library('session');
            $group_name = $this->input->post('groupname');
            //TODO: Get the Id
            // log user actions
            $userId = $this->session->userdata('id');
            $action = 'Created New Group - ' . $group_name; //TODO: set the action
            $this->Log_model->log($action, $userId);
            return $insert;
        } else return false;


    }


    function search($limit, $offset)
    {

        //actual results query
        $query = $this->db->select('*, UNIX_TIMESTAMP() - date AS TimeSent')
            ->from('groups')
            ->limit($limit, $offset);
        $result['rows'] = $query->get()->result();

        // count query
        $query = $this->db->select('COUNT(*) as count', FALSE)
            ->from('groups');
        $tmp = $query->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;

    }


    function deletegroup()
    {

        $this->db->where('group_id', $this->uri->segment(3));
        $this->db->delete('groups');

    }


    function get_members()
    {

        //actual results query
        $group_id = $this->uri->segment(3);

        $this->db->select('users.id, users.username, users.firstname, users.lastname, users.mobile, users.email, groupmembers.group_id');
        $this->db->from('groupmembers');
        $this->db->join('users', 'users.id = groupmembers.member_id');
        $this->db->where('groupmembers.group_id', $group_id);

        $query = $this->db->get();

        return $query->result();

    }


    function validate_join($member, $group)
    {
        $member = $this->session->userdata('id');
        $group = $this->uri->segment(3);
        //echo $member;
        //echo $group;

        $this->db->where('member_id', $member);
        $result = $this->db->get('groupmembers');
        if ($result) {
            return $result;
        }

    }


    function join_group()
    {

        // create date and time for last login
        $datetime = strtotime(date("Y-m-d H:i:s"));


        $new_group_insert_data = array(
            'member_id' => $this->session->userdata('id'),
            'group_id' => $this->uri->segment(3),
            'date_joined' => $datetime
        );

        $insert = $this->db->insert('groupmembers', $new_group_insert_data);
        return $insert;
    }

    // used to create dynamic groups
    function dynamic_group($groupname, $groupdesc)
    {
        $datetime = strtotime(date("Y-m-d H:i:s"));
        $userId = $this->session->userdata('id');

        $loan_insert_data = array(
            'group_name' => $groupname,
            'group_desc' => $groupdesc,
            'group_admin' => $userId,
            // group not active by default
            'status' => 'suspended',
            'date' => $datetime
        );
        $insert = $this->db->insert('groups', $loan_insert_data);
    }

    function add_member_group($group, $member)
    {
        // create date and time
        $datetime = strtotime(date("Y-m-d H:i:s"));

        $new_group_member_insert_data = array(
            'group_id' => $group,
            'member_id' => $member,
            'date_joined' => $datetime
        );

        $insert = $this->db->insert('groupmembers', $new_group_member_insert_data);
        return $insert;
    }


    function get_groups()
    {

// count query
        $query = $this->db->select('COUNT(*) as count', FALSE)
            ->from('groups');
        $tmp = $query->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        //actual results query
        $query = $this->db->select('group_id, group_name')
            ->from('groups');
        $result['rows'] = $query->get()->result();

        return $result;

    }


    function get_group_members($member, $group)
    {

        // count query
        $query = $this->db->select('COUNT(*) as count', FALSE)
            ->from('groupmembers')
            ->where('member_id', $member)
            ->where('group_id', $group);
        $tmp = $query->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;

    }


    function deletemember()
    {

        $this->db->where('member_id', $this->uri->segment(3));
        $this->db->delete('groupmembers');

    }


}