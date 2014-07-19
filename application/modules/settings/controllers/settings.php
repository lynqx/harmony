<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 7/17/14
 * Time: 5:34 PM
 */

class Settings extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model');
    }

    /**
     * @param $settingKey
     * @return mixed
     */
    public function getSetting($settingKey)
    {
        return $this->Settings_model->getSetting($settingKey);
    }

    /**
     * @param $moduleKey
     * @return mixed
     */
    public function isModuleOn($moduleKey)
    {
        return $this->Settings_model->checkModuleIsOn($moduleKey);
    }

    /**
     * @return mixed
     */
    public function getActiveModules()
    {
        return $this->Settings_model->getActiveModules();
    }
} 