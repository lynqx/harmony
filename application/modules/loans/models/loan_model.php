<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 7/26/14
 * Time: 1:27 PM
 */

class Loan_model extends CI_Model
{
    //Model Properties
    var $name='';
    var $description='';
    var $dateCreated='';
    var $id='';
    var $rules = array();

    public function create(Loan_model $loan)
    {
        //rules array format array('rule_id'=>settings)
    }

    public function apply($loan)
    {

    }
} 