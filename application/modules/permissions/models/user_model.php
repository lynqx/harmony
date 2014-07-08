<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/25/14
 * Time: 10:27 AM
 */

class User_model extends CI_Model
{

    //The fields present in the database for a user
    /**
     * @var
     */
    var $Id;
    /**
     * @var
     */
    var $email;
    /**
     * @var
     */
    var $username;
    /**
     * @var
     */
    var $passwd;
    /**
     * @var
     */
    var $state;
    /**
     * @var
     */
    var $firstname;
    /**
     * @var
     */
    var $lastname;
    /**
     * @var
     */
    var $datecreated;
    /**
     * @var
     */
    var $addressIndex;
    /**
     * @var
     */
    var $rolename;
    //the roles the user belongs to
    /**
     * @var
     */
    var $roles;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
     * @param $username
     * @return bool|User_model
     */
    function get_by_username($username)
    {
        //TODO: use the username to search for a user and load additional information about that user
       // $query = $this->db->get_where('users', array('username' => $username), 1);
	   
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('cooperators', 'cooperators.user_id = users.id');
        $this->db->where(array('username' => $username), 1);
		$query = $this->db->get();
		
        $row = $query->result(); //Since we are expecting a  single result
        if (!empty($row)) {
            foreach ($query->result() as $row) {
                $user = new User_model();
                $user->Id = $row->id;
                $user->email = $row->email;
                $user->firstname = $row->firstname;
                $user->lastname = $row->lastname;
                $user->datecreated = $row->date_created;
                $user->state = $row->active;
               // $user->addressIndex = $row->address;
                $user->username = $row->username;
                $user->roles = $this->_initializeRoles($row->id); //Initialize the role with all permissions
                $temp=$this->get_user_role($username);//Store this value temporarily
               // $user->rolename = $temp[0]->title; // grab the user's role name! Coolness!

                /* //TODO: Get the current user and log this read action
                 $this->load->library('session');

                 //TODO: Get the Id
                 $userId=$this->session->userdata('id');

                 $action='viewed Member '+$username;

                 //TODO: set the action
                 $this->Log_model->log($action,$userId); //I autoloaded this since we would be using it everywhere*/
                return $user;
            }
        } else return false;
    }
 
    /**
     * @param $username
     * @return bool
     */
    function get_user_role($username)
    {
        //TODO:fetch the user role using the provided username
        $this->db->select('users.id');
        $this->db->from('users');
        $this->db->where('username', $username);
        $result = $this->db->get();
        $userId = null;
        foreach ($result->result() as $row) {
            $userId = $row->id;
        }
        //Now that I've gotten User Id, I'll the find the role name from User_Roles Table
        if (!is_null($userId)) {
            //Query for the role
            $this->db->select("roles.id,roles.title");
            $this->db->from('roles');
            $this->db->join('user_roles', 'roles.id=user_roles.role_id');
            $this->db->where('user_roles.user_id', $userId);
            $query = $this->db->get();
            return $query->result(); //returns an object with fields id and title
        } else return false;
    }

    /**
     * @param $id
     * @return array
     */
    function _initializeRoles($id)
    {
        $this->load->model('Role_model', 'Role');
        //TODO: Initialize the roles here
        $this->roles = array();
        $this->db->select("*");
        $this->db->from('user_roles');
        $this->db->join('roles', 'roles.id=user_roles.role_id');
        $this->db->where('user_roles.user_id', $id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $this->roles[$row->title] = $this->Role->getRolePerms($row->role_id);
            //$this->rolename = $row->title;
            return $this->roles;
            //print_r($this->roles);
        }
    }

    /* function has_permission($permission, $username)
     {
         //TODO: find out if the current user has the permission to do perform an action
         $this->load->model('Role_model', 'Role');
         $result = $this->get_user_role($username);
         //echo $role;

         return $result;

     }*/

    
    /**
     * @param string $role
     * @return array | User_model
     */
    public function getUsers($role = 'admin')
    {
        $user_array = array();
        $query = 'SELECT users.id,users.username FROM users JOIN user_roles ON users.id=user_roles.user_id JOIN roles ON user_roles.role_id=roles.id WHERE roles.title=?';
        $data = array($role);
        $result = $this->db->query($query, $data);
        /*$this->db->select('users.id,users.username,roles.title');
        $this->db->from('users');
        $this->db->join('user_roles','user_roles.user_id=users.id');
        $this->db->join('roles','roles.id=user_roles.id');
        $this->db->where('roles.title',$role);
        $result=$this->db->get()->result();*/
        //TODO: Loop through and create User_models from the collected results
        $index = 0;
        foreach ($result->result() as $row) {
            $user = new User_model();
            $user->Id = $row->id;
            $user->username = $row->username;
            $user_array[$index] = $user;
            $index++;
        }
        return $user_array;
    }

    /**
     * @param $old
     * @param $new
     * @param $userId
     * @return bool
     */
    public function changePassword($old, $new, $userId)
    {
        try {
            //TODO: Accept old pass, new password and user ID
        //TODO: get the old password
        $this->db->select('passwd');
        $this->db->where('id', $userId);
        $result = $this->db->get('users');
        //TODO: Get the returned password
            foreach ($result->result() as $row) {
                $password = $row->passwd;
            }

            if (sha1($old) == $password) {
                //TODO: Means the supplied password is correct. Do the magic
                $newPassword = sha1($new);
                //TODO: Replace the previous password in the db
                $data = array('passwd' => $newPassword);
                $this->db->where('id', $userId);
                $this->db->update('users', $data);
                return true;
            } else return false;
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * @return bool|null|User_model
     */
    public function getCurrentUser()
    {
        if($this->session->userdata('username'))
        {
            $username=$this->session->userdata('username');
            return $this->get_by_username($username);
        }
        else return null;
    }
}
