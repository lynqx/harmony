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
	
	function getAllPermissions($id = FALSE)
    {
        $query = $this->db->select('*')
			->from('permissions');
			$result['rows'] = $query->get()->result();	
			

// count query
									$query = $this->db->select('COUNT(*) as count', FALSE)
									->from('permissions');
									$tmp = $query->get()->result();
									$result['perm_rows'] = $tmp[0]->count;

									
			$query = $this->db->select('*')
			->from('roles_permissions')
			->join('permissions', 'permissions.id = roles_permissions.permission_id')
			->where('role_id', $id);
			$result['realrow'] = $query->get()->result();	
			
			return $result;
    }
	
	
	    function CreateRoles()
	{
		$role = $this->input->post('rolename');
        // create date and time for last login
        $datetime = date("d-m-Y");
        //TODO: Capture and store the role information
        $role_insert_data = array(
		            'title' => $role,
					'date_created' => $datetime,
					);
					
        $result = $this->db->insert('roles', $role_insert_data);
		        return $result;

	}
	
	
	    function AddPerm($role, $perm)
	{
		$this->db->select('*')
		->from('roles_permissions')
		->where('role_id', $role)
		->where('permission_id', $perm);
		$query = $this->db->get();
		
        $row = $query->result(); //Since we are expecting a  single result
        if (empty($row)) 
		{
        
        // create date and time for last login
        //TODO: Capture and store the role information
        $role_perm_insert_data = array(
		            'role_id' => $role,
					'permission_id' => $perm,
					);
					
        $result = $this->db->insert('roles_permissions', $role_perm_insert_data);
		        return $result;

		}
	}
	
} 