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
        $data['page_title'] = 'Create Contributions';
       $data['module'] = 'rules';
        $data['view_file'] = 'contributions_creator_widget';
        //$data['ruleset']=$this->GetRules('membership');

        echo Modules::run('templates/contributions',$data);
        //$this->load->view('contributions_creator_widget');
    }
    public function GetRules($category)
    {
        //Hold on still testing the models
        $ruleSet=$this->Rules_model->fetchRules($category);
        return $ruleSet;
    }

}