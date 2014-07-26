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
    public function view()
    {
        //$data['data2']=$this->LoadRules(CONTRIBUTION_CATEGORY,1);
        //$result=$this->LoadRules(CONTRIBUTION_CATEGORY,1);
        //$data['data']=$this->execute($result);
        //$this->load->view('rule_view',$data);
        $data['data2']=$this->LoadRules(LOAN_CATEGORY,1);
        $result=$this->LoadRules(LOAN_CATEGORY,1);
        $data['data']=$this->execute($result);
        $this->load->view('rule_view',$data);
    }
    public function GetRules($category)
    {
        //Hold on still testing the models
        $ruleSet=$this->Rules_model->fetchRules($category);
        return $ruleSet;
    }
    private function LoadRules($category,$id)
    {
        $result=$this->Rules_model->loadRuleSet($category,$id);
            return $result;
    }
    private function execute($ruleset)
    {
        $result=$this->Rules_model->executeRuleSet($ruleset);
        return $result;
    }


}