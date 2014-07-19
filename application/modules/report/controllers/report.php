<?php

class Report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        Modules::run('login/is_logged_in');
        $this->load->model('reportmodel', 'contrib');
        $this->load->helper('url');

    }


    function index()
    {
        redirect('admin');
    }


    function loan()
    {
        // to select biodata
        $this->load->model('reportmodel');
        $sub = $this->reportmodel->get_loan();
        $data['loantypes'] = $sub['rows'];

        $data['page_title'] = 'Export Loan Reports';
        $data['module'] = 'report';
        $data['view_file'] = 'select_loan';
        $this->load->view('select_loan', $data);
        //echo Modules::run('templates/main_site', $data);
    }


    function report_loan()
    {
        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for User Biodata
        $this->form_validation->set_rules('selectloanname', 'Loan Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member', 'Coperator\'s name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('limit', 'Number of Records', 'trim|required|xss_clean');

        //TODO: Run the validation
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $this->loan();

        } else {

            $loanname = $this->input->post('selectloanname');
            $member = $this->input->post('member');
            $amount = $this->input->post('amount');
            $duration = $this->input->post('duration');
            $loanbalance = $this->input->post('loanbalance');
            $reason = $this->input->post('reason');
            $formno = $this->input->post('formno');
            $status = $this->input->post('status');
            $limit = $this->input->post('limit');

            $status2 = $this->input->post('status2');

            //TODO: Capture
            $loan_select_data = array(
                $this->input->post('member'),
                $this->input->post('amount'),
                $this->input->post('duration'),
                $this->input->post('loanbalance'),
                $this->input->post('reason'),
                $this->input->post('formno'),
                $this->input->post('status')
            );

            $this->db->select($loan_select_data);
            $this->db->from('activeloan');
            $this->db->where('activeloan.loantype', $this->input->post('selectloanname'));
            if ($this->input->post('status2') == "pending" || $this->input->post('status2') == "active" || $this->input->post('status2') == "complete") {
                $this->db->where('activeloan.status', $this->input->post('status2'));
            }
            $this->db->limit($this->input->post('limit'));

            $query = $this->db->get();
            //echo '<table>';

            //load pdf
            $this->load->library('cezpdf');
            $this->load->helper('pdf');

            //$user = $this->session->userdata('id');
            prep_pdf(); // creates the footer for the document we are creating.

            foreach ($query->result() as $row) {

                $data['member'] = $row->member_id;
                $data['amount'] = $row->amount;

                if (isset($row->duration)) {
                    $data['duration'] = $row->duration;
                    $duration = $data['duration'];
                }

                if (isset($row->loanbalance)) {
                    $data['loanbalance'] = $row->loanbalance;
                    $loanbalance = $data['loanbalance'];
                }

                if (isset($row->reason)) {
                    $data['reason'] = $row->reason;
                    $reason = $data['reason'];
                }

                if (isset($row->formno)) {
                    $data['formno'] = $row->formno;
                    $formno = $data['formno'];
                }

                if (isset($row->status)) {
                    $data['status'] = $row->status;
                    $status = $data['status'];
                }


                $member = $data['member'];
                $amount = $data['amount'];


                $query = $this->db->query("SELECT firstname, lastname FROM users WHERE id = '$member'");
                foreach ($query->result_array() as $row) {
                    $member = $row['firstname'] . '  ' . $row['lastname'];
                }


                $db_data[] = array(
                    'name' => $member,
                    'amount' => $amount,
                    'duration' => $duration,
                    'loanbalance' => $loanbalance,
                    'reason' => $reason,
                    'formno' => $formno,
                    'status' => $status
                );

            }


            $col_duration = $this->input->post('duration');
            $col_loanbalance = $this->input->post('loanbalance');
            $col_reason = $this->input->post('reason');
            $col_formno = $this->input->post('formno');
            $col_status = $this->input->post('status');


            // if statement inside array
            $col_names = array(
                'name' => 'Coperator Name',
                'amount' => 'Amount'
            );


            if (isset($col_duration) && $col_duration != "") {
                $col_names['duration'] = 'Duration';
            }

            if (isset($col_loanbalance) && $col_loanbalance != "") {
                $col_names['loanbalance'] = 'Loan Balance';
            }

            if (isset($col_reason) && $col_reason != "") {
                $col_names['reason'] = 'Reason';
            }

            if (isset($col_formno) && $col_formno != "") {
                $col_names['formno'] = 'Form Number';
            }

            if (isset($col_status) && $col_status != "") {
                $col_names['status'] = 'Status';
            }


            $query = $this->db->query("SELECT loanname FROM loantype WHERE loan_id = '$loanname'");
            foreach ($query->result_array() as $row) {
                $title = $row['loanname'];
            }

            // generate header introduction
            $id = $this->session->userdata('id');
            $user = $this->session->userdata('username');
            $query = $this->db->query("SELECT mobile, email FROM users WHERE id = '$id' LIMIT 1");
            foreach ($query->result_array() as $row) {
                $mobile = $row['mobile'];
                $email = $row['email'];
            }

            $this->cezpdf->addText(50, 810, 8, 'Generated by : ');
            $this->cezpdf->addText(50, 800, 8, $user);
            $this->cezpdf->addText(50, 790, 8, $email);
            $this->cezpdf->addText(50, 780, 8, $mobile);

            $this->cezpdf->ezText('Armony Demo Server Test', 18, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-10);

            $contact = 'Email : memcos@memcos.net  ||  Telephone : +2348063777394';
            $content = 'We make your space your Kingdom';
            $this->cezpdf->ezText($contact, 10, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-5);
            $this->cezpdf->ezText($content, 10, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-10);


            //generate the table into pdf'
            $this->cezpdf->ezTable($db_data, $col_names, 'Loan Name - ' . $title, array('width' => 520));
            $this->cezpdf->ezStream();

        }
    }

    //...............................................asset loan reports...........................................

    function asset()
    {
        // to select biodata
        $this->load->model('reportmodel');
        $sub = $this->reportmodel->get_asset();
        $data['assettypes'] = $sub['rows'];

        $data['page_title'] = 'Export Asset Loan Reports';
        $data['module'] = 'report';
        $data['view_file'] = 'select_asset';

        echo Modules::run('templates/main_site', $data);
    }


    function report_asset()
    {
        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for User Biodata
        $this->form_validation->set_rules('selectloanname', 'Loan Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member', 'Coperator\'s name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('limit', 'Number of Records', 'trim|required|xss_clean');

        //TODO: Run the validation
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $this->asset();

        } else {

            $loanname = $this->input->post('selectloanname');
            $member = $this->input->post('member');
            $amount = $this->input->post('amount');
            $duration = $this->input->post('duration');
            $loanbalance = $this->input->post('loanbalance');
            $reason = $this->input->post('reason');
            $formno = $this->input->post('formno');
            $status = $this->input->post('status');
            $limit = $this->input->post('limit');

            $status2 = $this->input->post('status2');

            //TODO: Capture
            $loan_select_data = array(
                $this->input->post('member'),
                $this->input->post('amount'),
                $this->input->post('duration'),
                $this->input->post('loanbalance'),
                $this->input->post('reason'),
                $this->input->post('formno'),
                $this->input->post('status')
            );

            $this->db->select($loan_select_data);
            $this->db->from('activeasset');
            $this->db->where('activeasset.assettype', $this->input->post('selectloanname'));
            if ($this->input->post('status2') == "pending" || $this->input->post('status2') == "active" || $this->input->post('status2') == "complete") {
                $this->db->where('activeasset.status', $this->input->post('status2'));
            }
            $this->db->limit($this->input->post('limit'));

            $query = $this->db->get();
            //echo '<table>';

            //load pdf
            $this->load->library('cezpdf');
            $this->load->helper('pdf');

            //$user = $this->session->userdata('id');
            prep_pdf(); // creates the footer for the document we are creating.

            foreach ($query->result() as $row) {

                $data['member'] = $row->member_id;
                $data['amount'] = $row->amount;

                if (isset($row->duration)) {
                    $data['duration'] = $row->duration;
                    $duration = $data['duration'];
                }

                if (isset($row->loanbalance)) {
                    $data['loanbalance'] = $row->loanbalance;
                    $loanbalance = $data['loanbalance'];
                }

                if (isset($row->reason)) {
                    $data['reason'] = $row->reason;
                    $reason = $data['reason'];
                }

                if (isset($row->formno)) {
                    $data['formno'] = $row->formno;
                    $formno = $data['formno'];
                }

                if (isset($row->status)) {
                    $data['status'] = $row->status;
                    $status = $data['status'];
                }


                $member = $data['member'];
                $amount = $data['amount'];


                $query = $this->db->query("SELECT firstname, lastname FROM users WHERE id = '$member'");
                foreach ($query->result_array() as $row) {
                    $member = $row['firstname'] . '  ' . $row['lastname'];
                }


                $db_data[] = array(
                    'name' => $member,
                    'amount' => $amount,
                    'duration' => $duration,
                    'loanbalance' => $loanbalance,
                    'reason' => $reason,
                    'formno' => $formno,
                    'status' => $status
                );

            }


            $col_duration = $this->input->post('duration');
            $col_loanbalance = $this->input->post('loanbalance');
            $col_reason = $this->input->post('reason');
            $col_formno = $this->input->post('formno');
            $col_status = $this->input->post('status');


            // if statement inside array
            $col_names = array(
                'name' => 'Coperator Name',
                'amount' => 'Amount'
            );


            if (isset($col_duration) && $col_duration != "") {
                $col_names['duration'] = 'Duration';
            }

            if (isset($col_loanbalance) && $col_loanbalance != "") {
                $col_names['loanbalance'] = 'Loan Balance';
            }

            if (isset($col_reason) && $col_reason != "") {
                $col_names['reason'] = 'Reason';
            }

            if (isset($col_formno) && $col_formno != "") {
                $col_names['formno'] = 'Form Number';
            }

            if (isset($col_status) && $col_status != "") {
                $col_names['status'] = 'Status';
            }


            $query = $this->db->query("SELECT loanname FROM loantype WHERE loan_id = '$loanname'");
            foreach ($query->result_array() as $row) {
                $title = $row['loanname'];
            }

            // generate header introduction
            $id = $this->session->userdata('id');
            $user = $this->session->userdata('username');
            $query = $this->db->query("SELECT mobile, email FROM users WHERE id = '$id' LIMIT 1");
            foreach ($query->result_array() as $row) {
                $mobile = $row['mobile'];
                $email = $row['email'];
            }

            $this->cezpdf->addText(50, 810, 8, 'Generated by : ');
            $this->cezpdf->addText(50, 800, 8, $user);
            $this->cezpdf->addText(50, 790, 8, $email);
            $this->cezpdf->addText(50, 780, 8, $mobile);

            $this->cezpdf->ezText('Armony Demo Server Test', 18, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-10);

            $contact = 'Email : memcos@memcos.net  ||  Telephone : +2348063777394';
            $content = 'We make your space your Kingdom';
            $this->cezpdf->ezText($contact, 10, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-5);
            $this->cezpdf->ezText($content, 10, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-10);


            //generate the table into pdf'
            $this->cezpdf->ezTable($db_data, $col_names, 'Loan Name - ' . $title, array('width' => 520));
            $this->cezpdf->ezStream();

        }
    }


    //.................. coperators report ........................................

    function coperator()
    {

        $data['page_title'] = 'Export Coperator Reports';
        $data['module'] = 'report';
        $data['view_file'] = 'select_coperator';

        echo Modules::run('templates/main_site', $data);
    }


    function report_coperator()
    {
        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for User Biodata
        $this->form_validation->set_rules('firstname', 'Coperator\'s Firstname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Coperator\'s Lastname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('limit', 'Number of Records', 'trim|required|xss_clean');

        //TODO: Run the validation
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $this->coperator();

        } else {

            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            $status2 = $this->input->post('status2');
            $limit = $this->input->post('limit');


            //TODO: Capture
            $select_data = array(
                $this->input->post('firstname'),
                $this->input->post('lastname'),
                $this->input->post('email'),
                $this->input->post('mobile'),
                $this->input->post('status')
            );

            $this->db->select($select_data);
            $this->db->from('users');
            $this->db->join('cooperators', 'cooperators.user_id=users.id');

            if ($this->input->post('start') != "") {
                $this->db->where('users.date_created >=', $this->input->post('start'));
            }

            if ($this->input->post('end') != "") {
                $this->db->where('users.date_created <=', $this->input->post('end'));
            }

            if ($this->input->post('status2') != "" && $this->input->post('status2') == 0 || $this->input->post('status2') == 1) {
                $this->db->where('users.active', $this->input->post('status2'));
            }
            $this->db->limit($this->input->post('limit'));

            $query = $this->db->get();

            //load pdf
            $this->load->library('cezpdf');
            $this->load->helper('pdf');

            //$user = $this->session->userdata('id');
            prep_pdf(); // creates the footer for the document we are creating.

            foreach ($query->result() as $row) {

                $data['firstname'] = $row->firstname;
                $data['lastname'] = $row->lastname;
                $data['email'] = $row->email;

                if (isset($row->phone_number)) {
                    $data['phone_number'] = $row->phone_number;
                    $mobile = $data['phone_number'];
                }

                if (isset($row->active)) {
                    $data['active'] = $row->active;
                    $active = $data['active'];
                }


                $member = $data['firstname'] . '  ' . $data['lastname'];
                $email = $data['email'];
                if ($active == 0) {
                    $status = 'Blocked';
                } elseif ($active == 1) {
                    $status = 'Active';
                }


                $db_data[] = array(
                    'name' => $member,
                    'email' => $email,
                    'mobile' => $mobile,
                    'status' => $status
                );

            }


            $col_mobile = $this->input->post('mobile');
            $col_status = $this->input->post('status');


            // if statement inside array
            $col_names = array(
                'name' => 'Coperator Name',
                'email' => 'Email'
            );


            if (isset($col_mobile) && $col_mobile != "") {
                $col_names['mobile'] = 'Mobile Number';
            }

            if (isset($col_status) && $col_status != "") {
                $col_names['status'] = 'Status';
            }


            // generate header introduction
            $id = $this->session->userdata('id');
            $user = $this->session->userdata('username');
            $query = $this->db->query("SELECT phone_number, email FROM users JOIN cooperators ON cooperators.user_id=users.id WHERE users.id = '$id' LIMIT 1");
            foreach ($query->result_array() as $row) {
                $adminmobile = $row['phone_number'];
                $adminemail = $row['email'];
            }

            $this->cezpdf->addText(50, 810, 8, 'Generated by : ');
            $this->cezpdf->addText(50, 800, 8, $user);
            $this->cezpdf->addText(50, 790, 8, $adminmobile);
            $this->cezpdf->addText(50, 780, 8, $adminmobile);

            $this->cezpdf->ezText('Armony Demo Server Test', 18, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-10);

            $contact = 'Email : memcos@memcos.net  ||  Telephone : +2348063777394';
            $content = 'We make your space your Kingdom';
            $this->cezpdf->ezText($contact, 10, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-5);
            $this->cezpdf->ezText($content, 10, array('justification' => 'center'));
            $this->cezpdf->ezSetDy(-10);


            //generate the table into pdf'
            $this->cezpdf->ezTable($db_data, $col_names, 'Coperators Report (' . $start . ' - ' . $end . ')', array('width' => 520));
            $this->cezpdf->ezStream();

        }
    }


}
