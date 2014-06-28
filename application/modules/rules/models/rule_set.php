<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 6/25/14
 * Time: 6:12 AM
 */

class Rule_set extends CI_Model
{
//a collection for holding rule groups
    private $ruleSet = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rule_model');
    }

    public function addRuleToSet(Rule_model $rule)
    {
        $this->ruleSet[] = $rule;
    }

    /**
     * @return array
     */
    public function getRuleSet()
    {
        return $this->ruleSet;
    }
} 