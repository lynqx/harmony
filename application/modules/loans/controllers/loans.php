<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 8/3/14
 * Time: 12:27 PM
 */

class Loans extends MX_Controller {
public function __construct()
{
    parent::__construct();
    $this->load->model('Loan_model');
}
    public function create()
    {
        //get values from post variable
        $data['page_title'] = 'Create Loans';
        $data['module'] = 'loans';
        $data['view_file'] = 'creation/index';
        //$data['ruleset']=$this->GetRules('membership');

        echo Modules::run('templates/contributions',$data);

    }
    public function applyFor($loan)
    {

    }
} 