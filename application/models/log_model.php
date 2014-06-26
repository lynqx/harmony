<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/26/14
 * Time: 9:07 PM
 */

class Log_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function Log($action, $performer)
    {
        $data = array(
            'changed_by' => $performer,
            'action_performed' => $action
        );
        $this->db->insert('user_actions', $data);
    }
} 