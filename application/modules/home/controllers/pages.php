<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $user = $this->session->userdata("username");
        if ($user != false) {
            if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewMember") == "permitted") {
                redirect('/selfservice');
            } else if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") {
                redirect('/admin');
            }
        }
    }

    public function index()
    {

        $data['page_title'] = 'Armony';
        $data['module'] = 'home';
        $data['view_file'] = 'main_page';

        echo Modules::run('templates/main_site', $data);
    }


}