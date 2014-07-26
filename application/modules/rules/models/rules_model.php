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

    public function checkRuleExists($ruleTitle)
    {//check if a rule exists using the id
        $this->db->select('title')
            ->from('rules')
            ->where('rules.title',$ruleTitle);
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            return true;
        }
        else return false;
    }

    public function loadRuleSet($category, $id)//deals with loans and contributions
    {
        switch ($category) {

            case LOAN_CATEGORY:

                $this->db->select('rules.id,loans_rules.rule_title,rules.title,rule_definitions.rules_def,rule_definitions.require_settings,rules.description')
                    ->from('loans_rules')
                    ->join('rules', 'rules.title=loans_rules.rule_title')
                    ->join('rule_definitions', 'rule_definitions.rule_title=loans_rules.rule_title')
                    ->where('loans_rules.loan_id', $id);
                $query = $this->db->get();
                return $this->_populateRuleSet($category,$query->result());

                break;

            case CONTRIBUTION_CATEGORY:
                $this->db->select('contributions_rules.rule_title,rule_definitions.rules_def,rule_definitions.require_settings,rules.description,rules.id')
                    ->from('contributions_rules')
                    ->join('rules', 'rules.title=contributions_rules.rule_title')
                    ->join('rule_definitions', 'rule_definitions.rule_title=contributions_rules.rule_title')
                    ->where('contributions_rules.contribution_id', $id);
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

                $category=$rule->getCategory();

                if (is_null($this->_checkRuleSettings($category,$rule->getRuleID()))) {
                    echo 'no setings';
                    $query=$this->db->query($rule->getDefinition(),$user->Id);
                    $result=$query->row(); //expect to return a true or false value from script execution
                    $resultSet->addResultToSet($result);
                }
                else if(!is_null($this->_checkRuleSettings($category,$rule->getRuleID())))
                {
                    //echo 'settings';
                    $settings=$this->_checkRuleSettings($category,$rule->getRuleID());
                    $query=$this->db->query($rule->getDefinition(),$settings);
                    $result=$query->row(); //returns true or false
                    $resultSet->addResultToSet($result);
                }
            }
            return $resultSet;
        }
        else return null;

    }

    private function _checkRuleSettings($category,$id)
    {
        /**
         * Checks to see if a rule has settings using the category as a guide. If it does it returns the settings as a collection in the order in which the strings are tokenized
         * If it doesn't exist it returns an empty collection.
         * It uses codeigniter query bindings
         */

        switch($category)
        {
            case LOAN_CATEGORY:
                //TODO: Check the require_settings value
                $this->db->select('value')
                    ->from(LOANS_SETTINGS_TABLE)
                    ->where('loan_id',$id);
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
                    $settings[]=1;//$user->Id; TODO: Remember to reactivate before deployment
                    return $settings;
                }
                else return null;
                break;
            case CONTRIBUTION_CATEGORY:
                $this->db->select('value')
                    ->from(CONTRIBUTIONS_SETTINGS_TABLE)
                    ->where('contribution_id',$id);
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
                    $settings[]=1;//$user->Id;
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
                $rule->setTitle($singleRule->rule_title);
                $rule->setDefinition($singleRule->rules_def);
                $rule->setRuleID($singleRule->id);
                $rule->setDescription($singleRule->description);
                $rule->setRequireSettings($singleRule->require_settings);
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
    private function _tokenizeByComma($settingsEntry)
    {
        return explode(COMMA_DELIMITER,$settingsEntry);
    }
    public function saveSelectedRules($Id,$category,$rules)
    {
        //TODO: Sort the supplied array IDs in ascending order
        //Rules format from the UI => $arr=array(rule_id=>settings_value,rule_id=>settings_value);
        //check if the rule requires settings, if yes, combine the settings using the delimiter for separating settings
        //each setting entry should be saved in the db like so id,contribution_id,rule_id
        //key would be the contribution_id while value would be the settings like so
        //(id,contribution_id,value,date)as(1,1,[1,25000:::3,50000::7,70],02-07-2014)

        if($Id>0 && count($rules)>0)
        {//Assume a format like this: array(rule_id=>settings_value,rule_id=>settings_value)
            /**
             * How about say we have something like this:
             * [rule_id=>array(settingsValue1,settingsValue2),rule_id=>array(settingsValue1,settingsValue2)]
             *
             */
            //sort the array and run through the array of rule=>settings to merge them
            ksort($rules);
            $mergedTotal='';
            foreach($rules as $key=>$val)
            {
                //call the merger
                $mergedTotal.=$this->_mergeBy3Colons($key,$val);
            }
            //shook it in the db table
            switch($category){
                case CONTRIBUTION_CATEGORY:
            $insertData=array("contribution_id"=>$Id,"value"=>$mergedTotal);
            $this->db->insert(CONTRIBUTIONS_SETTINGS_TABLE,$insertData);
                    if($this->db->insert_id() > 0)
                    {
                        return true;
                    }
                    else return false;
        }
        }

    }
    private function _mergeBy3Colons($ruleId,$settingValue)
    {
        //checks
        if($ruleId>0 && !is_null($settingValue))
        {
            //peform merge
            $merged=$ruleId.RULE_SETTINGS_DELIMITER.$settingValue;
            return $merged;
        }
        else return '';
    }
    public function fetchRules($category)
    {
        //Fetch rules by the categories
        $this->db->select('rules.id as rule_id,rules.title,rule_definitions.rules_def,rule_definitions.require_settings,rules.description');
        $this->db->from('rules');
        $this->db->join('rule_definitions','rules.title=rule_definitions.rule_title');
        $this->db->join('rules_categories','rules.title=rules_categories.rule_title');
        $this->db->where('rules_categories.category_code',$category);
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            return $this->_populateRuleSet('',$query->result());
        }

    }
}