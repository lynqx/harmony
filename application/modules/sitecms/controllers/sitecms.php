<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Samuel Okoroafor
 * Date: 1/24/14
 * Time: 7:03 AM
 */

class Sitecms extends MX_Controller {
    const IMAGE_UPLOAD_DIR = 'uploads/images';
    public $data = array(); //Image upload directory

    public function __construct() {

        parent::__construct();
        Modules::run('login/is_logged_in');
        $this->load->helper('ckeditor');

        //The following are supported extensions for image upload in the content editor (ckEditor)
        $this->_supported_extensions = array('jpg', 'jpeg', 'gif', 'png', 'pdf');


    }


    // just redirects to the create function

    function index()
    {
        redirect('sitecms/create');
    }

    //This is the index controller function for the siteCMS module
    //It loads the ckEditor using the settings specified in $data['ckeditor_2'] array

    function submit()
    {

        //accept a post from the index_view view files and persist to the database
        if (isset($_POST['content_2'])) {

            $this->load->library('form_validation');

            // validate inputs
            // field name, error message, validation rules
            $this->form_validation->set_rules('post_title', 'Title', 'trim|required|min_length[6]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('alias', 'Alias', 'trim|required|min_length[6]|max_length[30]|xss_clean|');
            $this->form_validation->set_rules('content_2', 'Content', 'trim|required|xss_clean|');

            $update_id = $this->input->post('update_id', TRUE);

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {

                $data = $this->get_data_from_post();

                // if its an update action
                if (is_numeric($update_id)) {

                    // update db
                    $this->sitecmsmodel->update($update_id, $data);
                    //load view
                    redirect('sitecms/view');
                    //$data['page_title'] = 'Page Update Successful';
                    //$data['module'] = 'sitecms';
                    //$data['view_file'] = 'update_view';
                    //echo Modules::run('templates/main_site', $data);

                } else {

                    // if its a new page creation
                    //not an edit or update action

                    $this->sitecmsmodel->save();
                    //load view
                    $data['page_title'] = 'Page Created';
                    $data['module'] = 'sitecms';
                    $data['view_file'] = 'result_view';
                    echo Modules::run('templates/main_site', $data);

                }
            }
        }

    }

    //This controller function is called from the index_view file in the sitecms module


    //	to repopulate field in case of error

    function create()
    {

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

        $data['page_title']='Site Content Management System';
        $data['module'] = 'sitecms';
        $data['view_file']='index_view';
        $data['ckeditor_2'] = array(

            //ID of the textarea that will be replaced
            'id' => 'content_2',
            'path' => 'ckeditor',


            //Replacing styles from the "Styles tool"
            'styles' => array(

                //Creating a new style named "style 1"
                'style 3' => array(
                    'name' => 'Green Title',
                    'element' => 'h3',
                    'styles' => array(
                        'color' => 'Green',
                        'font-weight' => 'bold'
                    )
                )

            )
        );
        //$this->load->view('index_view', $this->data);
        echo Modules::run('templates/main_site',$data);
    }


    //$query = $this->db->get_where('mytable', array('id' => $id));

    function get_data_from_db($update_id)
    {
        $query = $this->db->get_where('site_content', array('content_id' => $update_id));
        foreach ($query->result() as $row) {

            $data['title'] = $row->title;
            $data['alias'] = $row->alias;
            $data['content'] = $row->content;
            $data['accessed'] = $row->access;
            $data['published'] = $row->published;
        }

        return $data;
    }

    function get_data_from_post()
    {
        $data['title'] = $this->input->post('post_title', TRUE);
        $data['alias'] = $this->input->post('alias', TRUE);
        $data['content_2'] = $this->input->post('content_2', TRUE);
        return $data;

    }

    function managecontent()
    {

        // Check if save button active, start this

        if (isset($_POST['update'])) {
            $checked = $this->input->post('checkbox');
            $status = $this->input->post('action');

            if (isset($status) && $status != "") {


                if (!empty($checked)) {
                    foreach ($checked as $check) {
                        // echo $check;

                        $data = array(
                            'published' => $status
                        );

                        $this->db->where('content_id', $check);
                        $this->db->update('site_content', $data);
                    }
                    redirect('sitecms/view');

                } else {
                    $this->session->set_flashdata('result', 'Error : Select a page to update');
                    redirect('sitecms/view');

                }
            } else {
                $this->session->set_flashdata('result', 'Error : Select an action to perfrom');
                redirect('sitecms/view');
            }
        }
    }

    function delete()
    {

        $this->load->model('sitecmsmodel');
        if ($this->sitecmsmodel->deletepage()) {

            $this->view();
        } else {
            $this->view();
        }


    }

    // to delete a page from the site

    function view($offset = 0)
    {
        $limit = 20;

        //$this->load->model('viewcontentModel');
        //$data['query'] = $this->viewUsersModel->search($limit, $offset);

        //  $this->SiteCMS_Model->update($update_id, $data);

        $results = $this->sitecmsmodel->search($limit, $offset);
        $data['contents'] = $results['rows'];
        $data['num_results'] = $results['num_rows'];

        //pagination
        // set configurations

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = site_url('Sitecms/view');
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;
        $config['url_segment'] = 3;
        $config['cur_tag_open'] = '<span style="background-color:#333; color:#fff">';
        $config['cur_tag_close'] = '</span>';
        $config['prev_link'] = 'PREVIOUS';
        $config['next_link'] = 'NEXT';

        //initialize the pagination
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['page_title'] = 'Content';
        $data['module'] = 'sitecms';
        $data['view_file'] = 'view_content';

        echo Modules::run('templates/main_site', $data);

    }


    //................................................................................

    // S-Chand Code below

    //function that deals with uploads from the ckEditor

    public function upload()
    {
        $callback = 'null';
        $url = '';
        $get = array();

        // for form action, pull CKEditorFuncNum from GET string. e.g., 4 from
        // /form/upload?CKEditor=content&CKEditorFuncNum=4&langCode=en
        // Convert GET parameters to PHP variables
        $qry = $_SERVER['REQUEST_URI'];
        parse_str(substr($qry, strpos($qry, '?') + 1), $get);

        if (!isset($_POST) || !isset($get['CKEditorFuncNum'])) {
            $msg = 'CKEditor instance not defined. Cannot upload image.';
        } else {
            $callback = $get['CKEditorFuncNum'];

            try {
                $url = $this->_move_image($_FILES['upload']);
                $msg = "File uploaded successfully to: {$url}";

                // Persist additions to file manager CMS here.

            } catch (Exception $e) {
                $url = '';
                $msg = $e->getMessage();
            }
        }

        $output = '<html><body><script type="text/javascript">' .
            'window.parent.CKEDITOR.tools.callFunction(' .
            $callback .
            ', "' .
            $url .
            '", "' .
            $msg .
            '");</script></body></html>';

        echo $output;
    }
    //This functions helps to move the images to the image folder

    private function _move_image($temp_location)
    {
        $filename = basename($temp_location['name']);
        $info = pathinfo($filename);
        $ext = strtolower($info['extension']);

        if (isset($temp_location['tmp_name']) &&
            isset($info['extension']) &&
            in_array($ext, $this->_supported_extensions)) {
            $new_file_path = self::IMAGE_UPLOAD_DIR . "/$filename";
            if (!is_dir(self::IMAGE_UPLOAD_DIR) ||
                !is_writable(self::IMAGE_UPLOAD_DIR)) {
                // Attempt to auto-create upload directory.
                if (!is_writable(self::IMAGE_UPLOAD_DIR) ||
                    FALSE === @mkdir(self::IMAGE_UPLOAD_DIR, null , TRUE)) {
                    throw new Exception('Error: File permission issue, ' .
                        'please consult your system administrator');
                }
            }

            if (move_uploaded_file($temp_location['tmp_name'], $new_file_path)) {
                return '/' . $new_file_path;
            }
        }

        throw new Exception('File could not be uploaded.');
    }
}

