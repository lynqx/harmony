<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 7/17/14
 * Time: 5:33 PM
 */

class Settings_model extends CI_Model
{

    /**
     * Settings model is responsible for getting and returning settings values
     * Some areas of concentration should be in the modules that have been turned on or off
     *
     */
    var $modules = ['self-service', 'admin', 'groups','notifications']; //module keys

    public function checkModuleIsOn($moduleName) //The module name is basically the key to be searched
    {
        $result = $this->getSetting($moduleName); //calls the get settings methods
        //Check the result to see if the module is on or off

        if (!is_null($result) && $result->value == 1) {
            return true;
        } else return false;

    }

    public function getSetting($key)
    {
        //This basically returns the value using the key to locate it
        $this->db->select(VALUE_COLUMN)
            ->from(SETTINGS_TABLE)
            ->where(KEY_COLUMN, $key);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else return null;
    }

    public function getActiveModules()
    {
        //Run through the settings entries and fetch the modules present in the moduleKeys array
        $this->db->select(KEY_COLUMN, VALUE_COLUMN)
            ->from(SETTINGS_TABLE)
            ->where_in(KEY_COLUMN, $this->modules);
        $query = $this->db->get();
        $activeModules = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if ($row->value == MODULES_ON) {
                    $activeModules[] = $row->key;
                }
            }
        }
        return $activeModules;

    }
} 