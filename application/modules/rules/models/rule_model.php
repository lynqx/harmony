<?php
/** Rule Set Class
 * Created by PhpStorm.
 * User: Samuel
 * Date: 6/25/14
 * Time: 5:24 AM
 */

class Rule_model extends CI_Model {
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $definition;
    /**
     * @var
     */
    private $category;
    private $description;

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param mixed $requireSettings
     */
    public function setRequireSettings($requireSettings)
    {
        $this->requireSettings = $requireSettings;
    }

    /**
     * @return mixed
     */
    public function getRequireSettings()
    {
        return $this->requireSettings;
    }
    /**
     * @param mixed $category
     */
    private $ruleID;

    /**
     * @param mixed $ruleID
     */
    private $requireSettings;

    /**
     * @param $ruleID
     */
    public function setRuleID($ruleID)
    {
        $this->ruleID = $ruleID;
    }

    /**
     * @return mixed
     */
    public function getRuleID()
    {
        return $this->ruleID;
    }

    /**
     * @param $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $definition
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    }

    /**
     * @return mixed
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }
} 