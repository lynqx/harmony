<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 6/24/14
 * Time: 3:31 AM
 */

class Rules extends MX_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rules_model');
    }
    public function index()
    {
        $this->load->view('index');
    }
    public function GetRules($category,$rule_id)
    {
        //Hold on still testing the models
    }
}