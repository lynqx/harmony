<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_select_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }


    public function fetch_members($q){

    	$sql = sprintf("SELECT member_id, member_id as id,  lastname, firstname, concat(lastname, ' ', firstname) as name, picture FROM members WHERE concat(lastname, ' ', firstname) LIKE '%%%s%%' LIMIT 100", mysql_real_escape_string($q));

    	// echo $sql;

    	$query = $this->db->query($sql);

    	return $query->result();


    }



}