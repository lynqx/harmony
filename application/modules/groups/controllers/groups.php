<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Groups extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        Modules::run('login/is_logged_in');
    }


    function index()
    {
        $data['page_title'] = 'Create A New Group';
        $data['module'] = 'groups';
        $data['view_file'] = 'add_group';

        echo Modules::run('templates/main_site', $data);

    }


    public function creategroup($groupname, $groupdesc)
    {
        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for User Biodata

        $this->form_validation->set_rules('groupname', 'Group Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('groupdesc', 'Group Description', 'trim|required|xss_clean');

        //TODO: Run the validation
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $this->index();

        } else {
            //TODO: call the model
            //$groupname = $this->input->post('groupname');
            $this->load->model('groupsmodel');
            $result = $this->groupsmodel->create_group();

            if ($result > 0) {
                //TODO: This means we were successful.Let's tell the user the good news
                $this->session->set_flashdata('result', 'Group created successfully');

                //log action ## done in groupsmodel
                redirect('groups');

            } else {
                //TODO: Break the bad news
                $this->session->set_flashdata('result', 'Group creation failed');
                redirect('groups');
            }


        }

    }


    function view($offset = 0)
    {
        $limit = 20;

        $this->load->model('groupsmodel');
        //$data['query'] = $this->viewUsersModel->search($limit, $offset);

        $results = $this->groupsmodel->search($limit, $offset);
        $data['groups'] = $results['rows'];
        $data['group_results'] = $results['num_rows'];

        //pagination
        // set configurations

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = site_url('loantype/view');
        //$config['total_rows'] = $data['num_results'];
        $config['total_rows'] = $data['group_results'];
        $config['per_page'] = $limit;
        $config['url_segment'] = 3;
        //$config['full_tag_open'] = '<ul>';
        //$config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<span style="background-color:#333; color:#fff">';
        $config['cur_tag_close'] = '</span>';
        $config['prev_link'] = 'PREVIOUS';
        $config['next_link'] = 'NEXT';

        //initialize the pagination
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['page_title'] = 'View all Groups';
        $data['module'] = 'groups';
        $data['view_file'] = 'group_view';

        echo Modules::run('templates/main_site', $data);

    }


    function deletegroup()
    {

        $this->load->model('groupsmodel');
        $this->groupsmodel->deletegroup();

        $group_name = $this->uri->segment(3);

        //log action
        $this->Log_model->log('Delete Group- ' . $group_name, $this->session->userdata('id'));
        $this->view();

    }


    function remove()
    {

        $this->load->model('groupsmodel');
        $this->groupsmodel->deletemember();
        $member = $this->uri->segment(3);

        //log action
        $this->Log_model->log('Delete Member- ' . $member, $this->session->userdata('id'));

        $location = 'groups/view';
        redirect($location);
        die();
    }


// functions to view and edit individual groups
//.............................................................................................

    public function view_selected($update_id)
    {
        $data = array();
        $update_id = $this->uri->segment(3);

        if (!isset($update_id)) {
            $update_id = $this->input->post('update_id', $id);
        }

        if (is_numeric($update_id)) {
            $data = $this->get_data_from_db($update_id);
            $data['update_id'] = $update_id;
        } else {
            $data = $this->get_data_from_post();
        }


        $this->load->model('groupsmodel');

        //begin: to get group members 
        if ($query = $this->groupsmodel->get_members()) {

            $data['members'] = $query;
        }

        $groupname = $data['groupname'];
        $data['page_title'] = $groupname;
        $data['module'] = 'groups';
        $data['view_file'] = 'view_group';

        echo Modules::run('templates/main_site', $data);


    }


    function join()
    {
        $query = array();
        $this->load->model('groupsmodel');
        $result = $this->groupsmodel->validate_join();

        if ($result > 0) {
            $this->session->set_flashdata('result', 'You are already a member of the group');
            redirect('groups/view');

        } else {
            $this->groupsmodel->join_group($member, $group);
            {

            }
        }


        $this->view();

    }


    function managegroups()
    {

        // Check if save button active, start this

        if (isset($_POST['update'])) {
            $checked = $this->input->post('checkbox');
            for ($i = 0; $i < count($checked); $i++) {
                $save_id = $checked[$i];
                if (isset($save_id)) {
                    $status = $this->input->post('action');
                    // echo $status;

                    $data = array(
                        'status' => $status
                    );

                    $this->db->where('group_id', $save_id);
                    $this->db->update('groups', $data);
                    $this->Log_model->log('Changed Group Status - ' . $save_id . 'to ' . $status, $this->session->userdata('id'));

                    redirect('groups/view');
                } else {
                    $this->session->set_flashdata('result', 'Select a group to update');
                    redirect('groups/view');
                }
            }

        }

    }


    //query users db.table for data
    function get_data_from_db($update_id)
    {

        //$query = $this->db->get_where('users', array('id' => $id));

        $query = $this->db->query("SELECT * FROM groups WHERE groups.group_id = '$update_id'");

        foreach ($query->result() as $row) {

            $data['groupname'] = $row->group_name;
            $data['groupdesc'] = $row->group_desc;
            $data['groupadmin'] = $row->group_admin;
            $data['date'] = $row->date;
        }

        return $data;
    }


    //	to repopulate field in case of error and edit it
    function get_data_from_post()
    {
        $data['loanname'] = $this->input->post('loanname', TRUE);
        $data['loandesc'] = $this->input->post('loandesc', TRUE);
        $data['city'] = $this->input->post('city', TRUE);
        $data['other'] = $this->input->post('other', TRUE);
        return $data;

    }


}