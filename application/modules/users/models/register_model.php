<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/25/14
 * Time: 10:27 AM
 */

class Register_model extends CI_Model
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
     * @return bool
     */
    function create_user()
    {
        //TODO: use the supplied data to create a new user
        //TODO: remember to set the default user's status to inactive and also a default cooperator role if none was specified  on the UI
        $role = $this->input->post('role');
        // create date and time for last login
        $datetime = date("d-m-Y");
        //TODO: Capture and store Address Info first
        $user_insert_data = array(
		            'username' => $this->input->post('username'),
					'passwd' => SHA1($this->input->post('passwd')),
					'date_created' => $datetime,
					'active' => 0, //Users are inactive by default
					'last_login' => ''
					);
					
        $this->db->insert('users', $user_insert_data);
        $user = $this->db->insert_id();
        //TODO: Check if address entry was successful then collect and store user data
        if (!$user > 0) {
            return false;
        }
        $new_user_insert_data = array(
            'user_id' => $user,
            'employee_id' => $this->input->post('employee'),
			'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
			'date_created' => $datetime,
			'phone_number' => $this->input->post('mobile'),
            'gender' => $this->input->post('gender'),
            'branch' => $this->input->post('branch'),
            'date_joined_company' => $this->input->post('djc'),
            'home_address' => $this->input->post('homeaddress'),
            'home_town' => $this->input->post('hometown')

        );
        $this->db->insert('cooperators', $new_user_insert_data);
        $insert = $this->db->insert_id();
        //TODO: if insert was successful, add the user to a role before returning results
        if ($insert) {
            $rolesAdded = $this->addUserToRole($user, $role); //The role is gotten from the UI
            if ($rolesAdded)
                //TODO: Get the sender from the session
                $this->load->library('session');
           
		    //TODO: Get the Id
			// log user actions
            Modules::run('contributions/add_new_account', $insert);
            $userId = $this->session->userdata('id');
            $action = 'Created New Member ' . $this->input->post('username'); //TODO: set the action
            $this->Log_model->log($action, $userId);
            return $insert;
        } else return false;


    }

    

    /**
     * @param $userId
     * @param $role
     * @return mixed
     */
    public function addUserToRole($userId, $role)
    {
        //TODO: Just insert the userId and roleId
        $insert_data = array(
            'user_id' => $userId,
            'role_id' => $role
        );
        $result = $this->db->insert('user_roles', $insert_data);
        return $result;
    }

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
    
}
