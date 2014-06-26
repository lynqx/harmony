<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/25/14
 * Time: 10:02 AM
 */

class Role_model extends CI_Model
{
    var $permissions;

    function __construct()
    {
        parent::__construct();
        $this->permissions = array();
    }

    function getRolePerms($role_id)
    {
        //TODO: get the permissions that belong to a role
        //TODO: get the codeIgniter instance and use to call the db
        //$CI=&get_instance();
        $role = $this; //new Role();

        //Concept: select permissions title from permissions using the relationship between the role_permissions table and

        $sql = "SELECT t2.title FROM roles_permissions as t1
                JOIN permissions as t2 ON t1.permission_id = t2.id
                WHERE t1.role_id = ?";
        $query = $this->db->query($sql, array('t1.role_id' => $role_id));

        foreach ($query->result() as $row) {
            $role->permissions[$row->title] = true;
        }
        return $role;
    }

    function hasPerm($permission)
    {
        //TODO: check that the role has this permission
        if (isset($this->permissions[$permission])) {
            return true;
        } else return false;
    }

    function getAvailableRoles()
    {
        $query = $this->db->get('roles');
        return $query;
    }
} 