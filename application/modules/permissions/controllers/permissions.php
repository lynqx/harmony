<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/25/14
 * Time: 8:53 AM
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Permissions extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Role_model', 'role');
    }

    /**
     *
     */
    public function index()
    {
        //TODO: Ensure the user is logged in
        Modules::run('login/is_logged_in');
        //TODO: if the user survives this, he/she has been cleared
        /*echo "User Data with Roles for schand<br/><hr/>";
        print_r(modules::run('permissions/getUserRolePermissions',"schand"));
        echo "<hr/>";
        echo "<br/>Is schand permitted to Read a doc?<br/>";
        print_r(modules::run('permissions/isPermitted',"schand","canReadDoc"));
        echo "<br/>Can schand view Admin?<br/>";
        echo modules::run('permissions/isPermitted',"schand","canViewAdmin");*/
        $update_id = $this->uri->segment(3);

        if (!isset($update_id)) {
            $update_id = $this->input->post('update_id', $id);
        }

        if (is_numeric($update_id)) {
            $data = $this->get_data_from_db($update_id);
            $data['update_id'] = $update_id;
        } else {
            $data = $this->get_data_from_post();
        }
		

        $data['page_title'] = 'Add Permission to Roles';
        $data['module'] = 'permissions';
        $data['view_file'] = 'add_permission';

        echo Modules::run('templates/main_site', $data);

    }
	
	
	public function getall($id)
    {
				$id = $this->uri->segment(3);
                $menu = $this->role->getAllPermissions($id);
				
				$data['menus'] = $menu['rows'];
				$data['reals'] = $menu['realrow'];
				$data['perm_menu'] = $menu['perm_rows'];

				
			    $this->load->view('permissions/getall', $data);

			
	}
	
	
	public function addToRole()
    {
			//print_r ($_POST);

        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for creating roles
        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');

        //TODO: Run the validation
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $this->index();
			
        } else {
		
		$role =  $this->input->post('role');
		$total =  $this->input->post('total');

		for ($i = 1; $i<=$total; $i++) {
		//$perm = $this->input->post('perm'.$i);
		if(!empty($_POST['perm'.$i])) {
			echo $perm = $_POST['perm'.$i] . '<br>';

			$permadd = $this->role->AddPerm($role, $perm);
			}
            				
		
		}
				//TODO: This means we are not successful.Let's tell the user the bad news
				$this->session->set_flashdata('result', 'Success : Operation Successful');
				redirect('permissions');
			}
  
    }

	
	

    /**
     * @param $username
     * @param $permission
     * @return string
     */
    public function isPermitted($username, $permission)
    {
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $permission = filter_var($permission, FILTER_SANITIZE_STRING);

        $use = $this->user->get_by_username($username); //Tested Ok
        //TODO: check if the response was empty or NULL
        if (is_null($use) || !get_class($use) == 'User_model') {
            return "notPermitted";
        }
        //TODO: get the user's role

        $role = $use->get_user_role($username); //Tested OK
        //TODO: check if this role has the permissions
        $permitted = $use->roles[$role[0]->title]->hasPerm($permission); // Tested Ok

        //TODO: return the result to the caller
        if ($permitted) {
            return "permitted";
        } else return "notPermitted";

    }

    /**
     * @param $username
     * @return mixed
     */
    public function getUserRolePermissions($username)
    {
        //TODO: purify the supplied username
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        //TODO: get the user details from the user_model
        $user = $this->user->get_by_username($username); //Tested Ok
        return $user;
        //$data['result'] = $user;
        //$this->load->view('test_view', $data);
    }

    /**
     * @param $rolename
     */
    public function Role()
    {
        //TODO: create a new role for the entire system
		$data['page_title'] = 'Create a New Role';
        $data['module'] = 'permissions';
        $data['view_file'] = 'create_role';

        echo Modules::run('templates/main_site', $data);
    }
	
	
	public function createRole()
    {
        //TODO: Run validations
        $this->load->library('form_validation');

        // field name, error message, validation rules
        //TODO: The following are validation rules for creating roles
        $this->form_validation->set_rules('rolename', 'Role Name', 'trim|required|xss_clean');
       
        //TODO: Run the validation
        if ($this->form_validation->run() == FALSE) {
            //TODO: This means it failed
            $this->role();
			
        } else {
            //TODO: call the model
            $rolecreate = $this->role->CreateRoles();
            if ($rolecreate) {
                
				//TODO: This means we were successful.Let's tell the user the good news
				$this->session->set_flashdata('result', 'Success : Role Added Successfully');
				redirect('permissions/role');

            } else {
			
			//TODO: This means we are not successful.Let's tell the user the bad news
				$this->session->set_flashdata('result', 'Error : Role Not Added');
				redirect('permissions/role');
			}

        }


    }
	

    /**
     * @param $roleName
     */
    public function deleteRole($roleName)
    {
        //TODO: Delete a role from the system and all associated permissions
    }


    public function edit()
    {

        $update_id = $this->uri->segment(3);

        if (!isset($update_id)) {
            $update_id = $this->input->post('update_id', $id);
        }

        if (is_numeric($update_id)) {
            $data = $this->get_data_from_db($update_id);
            $data['update_id'] = $update_id;
        } else {
            $data = $this->get_data_from_post();
        }

        $data['page_title'] = 'Membership Account Setup';
        $data['module'] = 'permissions';
        $data['view_file'] = 'create_member';

        echo Modules::run('templates/main_site', $data);

    }
  

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserName($userId)
    {
        return $this->user->getUserName($userId);
    }

    /**
     * @param $role
     * @return mixed
     */
    public function getUsers($role)
    {
        return $this->user->getUsers($role);
        //var_dump($this->user->getUsers($role)); //uncomment this and comment the previous line to test in a browser
    }


    //	to repopulate field in case of error and edit it
    function get_data_from_post()
    {
        $data['firstname'] = $this->input->post('firstname', TRUE);
        $data['lastname'] = $this->input->post('lastname', TRUE);
        $data['mobile'] = $this->input->post('mobile', TRUE);
        $data['email'] = $this->input->post('email', TRUE);
        $data['username'] = $this->input->post('username', TRUE);
        return $data;

    }

    //$query = $this->db->get_where('mytable', array('id' => $id));
    function get_data_from_db($update_id)
    {


        //Query for the db for sticky data
        $this->db->select("*");
        $this->db->from('users');
        //$this->db->join('address', 'users.id=address.id');
        $this->db->where('users.id', $update_id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {

            $data['firstname'] = $row->firstname;
            $data['lastname'] = $row->lastname;
            $data['mobile'] = $row->mobile;
            $data['email'] = $row->email;
            $data['username'] = $row->username;

        }


        return $data;
    }
} 