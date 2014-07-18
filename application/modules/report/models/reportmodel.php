<?php

class Reportmodel extends CI_Model
{


    function get_loan()
    {

        //$id = $this->session->userdata('id');
        // query userphoto db to get user image
        $this->db->select('loan_id, loanname');
        $this->db->from('loantype');

        $query = $this->db->get();

        if ($query) {
            $result['rows'] = $query->result();
            return $result;
        } else {
            return FALSE;
        }
    }


    function get_loan_data()
    {
        //TODO: use the supplied data to select details from loan

        $userId = $this->session->userdata('id');

        //TODO: Capture and store Address Info first
        $loan_select_data = array(
            // 'user_id' => $userId,
            $this->input->post('member'),
            $this->input->post('amount'),
            $this->input->post('duration')
        );
        $this->db->select($loan_select_data);
        $this->db->from('activeloan');
        $this->db->where('activeloan.loantype', $this->input->post('selectloanname'));
        $this->db->limit($this->input->post('limit'));

        $query = $this->db->get();

        if ($query) {
            $result['rows'] = $query->result();
            return $result;
        } else {
            return FALSE;
        }
    }


    //.......................asset reports...........................

    function get_asset()
    {

        //$id = $this->session->userdata('id');
        // query userphoto db to get user image
        $this->db->select('asset_id, assetname');
        $this->db->from('assettype');

        $query = $this->db->get();

        if ($query) {
            $result['rows'] = $query->result();
            return $result;
        } else {
            return FALSE;
        }
    }


    function get_asset_data()
    {
        //TODO: use the supplied data to select details from loan

        $userId = $this->session->userdata('id');

        //TODO: Capture and store Address Info first
        $loan_select_data = array(
            // 'user_id' => $userId,
            $this->input->post('member'),
            $this->input->post('amount'),
            $this->input->post('duration')
        );
        $this->db->select($loan_select_data);
        $this->db->from('activeasset');
        $this->db->where('activeasset.assettype', $this->input->post('selectloanname'));
        $this->db->limit($this->input->post('limit'));

        $query = $this->db->get();

        if ($query) {
            $result['rows'] = $query->result();
            return $result;
        } else {
            return FALSE;
        }
    }


}