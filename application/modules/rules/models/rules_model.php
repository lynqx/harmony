<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 6/24/14
 * Time: 3:36 AM
 */

class Rules_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('Rule_model');
        $this->load->model('Result_set');
        $this->load->model('Rule_set');
        $this->load->model('permissions/User_model');
    }

    public function checkRuleExists($ruleId)
    {//check if a rule exists using the id
        $this->db->select('title')
            ->from('rules')
            ->where('rules.id',$ruleId);
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            return true;
        }
        else return false;
    }

    public function loadRuleSet($category, $id)
    {
        switch ($category) {

            case LOAN_CATEGORY:

                $this->db->select('loans_rules.rule_id,rules.title,rule_definitions.rules_def')
                    ->from('loans_rules')
                    ->join('rules', 'rules.id=loans_rules.rule_id')
                    ->join('rule_definitions', 'rule_definitions.rule_id=loans_rules.rule_id')
                    ->where('loans_rules.loan_id', $id);
                $query = $this->db->get();
                return $this->_populateRuleSet($category,$query->result());

                break;

            case CONTRIBUTION_CATEGORY:
                $this->db->select('contributions_rules.rule_id,rule_definitions.rules_def')
                    ->from('contributions_rules')
                    ->join('rules', 'rules.id=contributions_rules.rule_id')
                    ->join('rule_definitions', 'rule_definitions.rule_id=contributions_rules.rule_id')
                    ->where('contributions_rules.loan_id', $id);
                $query = $this->db->get();
                return $this->_populateRuleSet($category,$query->result());
                break;
        }
    }

    public function executeRuleSet(Rule_set $ruleSet)
    {
        /**This function checks that the supplied ruleSet isn't null or empty before executing.
         *It executes each SQL query in the rule definition column and adds the responses to
         *a result set which is returned to another function for processing
         *
         **/
        if ($ruleSet != null && count($ruleSet->getRuleSet()) > 0) {
            //Ok we have a non empty ruleSet
            //Create a resultSet
            $resultSet = new Result_set();
            $rule_set=$ruleSet->getRuleSet(); //get all the queried rules
            //Get the current user because the following query would require userId irrespective of the absence of settings
            $user_model=new User_model();
            $user=$user_model->getCurrentUser(); //TODO: Seek alternate means to suppose admin powered operations
            foreach ($rule_set as $rule) {

                $category=$rule->getCategory;

                if (is_null($this->_checkRuleSettings($category,$rule->getRuleID))) {
                    $query=$this->db->query($rule->rules_def,$user->Id);
                    $result=$query->row(); //expect to return a true or false value from script execution
                    $resultSet->addResultToSet($result);
                }
                else if(!is_null($this->_checkRuleSettings($category,$rule->getRuleID)))
                {
                    $settings=$this->_checkRuleSettings($category,$rule->getRuleID);
                    $query=$this->db->query($rule->rules_def,$settings);
                    $result=$query->row(); //returns true or false
                    $resultSet->addResultToSet($result);
                }
            }
            return $resultSet;
        }
        else return null;

    }

    private function _checkRuleSettings($category,$rule_id)
    {
        /**
         * Checks to see if a rule has settings using the category as a guide. If it does it returns the settings as a collection in the order in which the strings are tokenized
         * If it doesn't exist it returns an empty collection.
         * It uses codeigniter query bindings
         */

        switch($category)
        {
            case LOAN_CATEGORY:
                $this->db->select('key,value')
                    ->from(LOANS_SETTINGS_TABLE)
                    ->where('loans_settings.br_id',$rule_id);
                $query=$this->db->get();
                if($query->num_rows() > 0)
                {
                    //retrieve the first row of data
                    $result=$query->row();
                    //tokenize the resulting value data
                    $settings=$this->_tokenizeBy3Colons($result->value);
                    //push the id parameter to the end of the array. This means I need the currently signed in user
                    //gets the currentUser - Currently works for just self service
                    //TODO: Add implementation for when self service is turned off
                    $user_model=new User_model();
                    $user=$user_model->getCurrentUser();
                    $settings[]=$user->Id;
                    return $settings;
                }
                else return null;
                break;
            case CONTRIBUTION_CATEGORY:
                $this->db->select('key,value')
                    ->from(CONTRIBUTIONS_SETTINGS_TABLE)
                    ->where('contributions_settings.rule_id',$rule_id);
                $query=$this->db->get();
                if($query->num_rows() > 0)
                {
                    //retrieve the first row of data
                    $result=$query->row();
                    //tokenize the resulting value data
                    $settings=$this->_tokenizeBy3Colons($result->value);
                    //push the id parameter to the end of the array. This means I need the currently signed in user
                    //gets the currentUser - Currently works for just self service
                    //TODO: Add implementation for when self service is turned off
                    $user_model=new User_model();
                    $user=$user_model->getCurrentUser();
                    $settings[]=$user->Id;
                    return $settings;
                }
                 else return null;
                break;

        }

        return null;
    }

    private function _populateRuleSet($ruletype, $ruleArray)
    {
        if (is_array($ruleArray) && count($ruleArray) > 0) {
            $ruleSet=new Rule_set();
            foreach ($ruleArray as $singleRule) {
                $rule = new Rule_model();
                $rule->setCategory($ruletype);
                $rule->setTitle($singleRule->title);
                $rule->setDefinition($singleRule->rules_def);
                $rule->setRuleID($singleRule->rule_id);
                $ruleSet->addRuleToSet($rule);
            }
            return $ruleSet;
        }
        else return null;
    }
    private function _tokenizeBy3Colons($ruleSettings)
    {
        //check that the string isn't empty
        if($ruleSettings!='')
        {
            return explode(RULE_SETTINGS_DELIMITER,$ruleSettings);
        }
        else return [];
    }
}