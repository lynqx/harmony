<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ContactModel extends CI_Model
{
    var $upload_path = '';

    function __construct()
    {
        parent::__construct();

    }


    function send_record()

    {
        $datestring = "%Y/%m/%d %h:%i %a"; // create date and time
        $time = time();
        $datetime = mdate($datestring, $time);

        $new_record_insert_data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'message' => $this->input->post('message'),
            'status' => "unread",
            'sentdate' => $datetime
        );

        $insert = $this->db->insert('contact', $new_record_insert_data);
        return $insert;

    }


    function search($limit, $offset)
    {

        //actual results query
        $query = $this->db->select('contact_id, name, email, mobile, message, status, sentdate')
            ->from('contact')
            ->limit($limit, $offset);
        $result['rows'] = $query->get()->result();

        // count query
        $query = $this->db->select('COUNT(*) as count', FALSE)
            ->from('contact');
        $tmp = $query->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;

    }

    function deletecontact()
    {

        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('contact');

    }

}