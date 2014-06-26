<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        Modules::run('login/is_logged_in');
        if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") != "permitted") {
            redirect('/');
        }
    }

    public function index()
    {

        $data['page_title'] = 'Administrator';
        $data['module'] = 'admin';
        $data['view_file'] = 'member_area';

        echo Modules::run('templates/main_site', $data);
    }

    /*
            public function member_area()
                {
                    $data['page_title'] = 'Administrator';
                    $data['main_content'] = 'member_area';
                    $this->load->view('includes/template', $data);
                }

    */
    public function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in != true) {
            //This page was accessed in error - redirect back to login page
            redirect('login');

        }


    }


    public function timeout()

    {
        // set a time limit in seconds
        $timelimit = 100;
        // get the current time
        $now = time();
        // where to redirect if rejected
        $redirect = 'login';
        // if session variable not set, redirect to login page
        $user = $this->session->userdata('user_id');
        if (!isset($user)) {
            header("Location: $redirect");
            exit;
        } // if timelimit has expired, destroy session and redirect
        elseif ($now > $this->session + $timelimit) {
            // empty the $_SESSION array
            $data = array(
                'user_id' => $row->user_id,
                'username' => $row->username,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'user_image' => $row->user_image,
                'user_level' => $row->user_level,
                'email' => $row->email,
                'is_logged_in' => true
            );

            $this->session->unset_userdata($data);
            // invalidate the session cookie

            // end session and redirect with query string
            $this->session->sess_destroy();
            header("Location: {$redirect}?expired=yes");
            exit;
        } // if it's got this far, it's OK, so update start time
        else {
            $this->session = time();
        }


    }


}