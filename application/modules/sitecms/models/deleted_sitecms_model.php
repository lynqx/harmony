<?php
/**
 * Created by PhpStorm.
 * User: Samuel Okoroafor
 * Date: 1/25/14
 * Time: 7:05 AM
 */
class SiteCMS_Model extends CI_Model
{
    var $author_id=0;
    var $title='';
    var $content='';
    function __construct()
    {
        parent::__construct();
    }
    public function save($page_title,$page_content)
    {
        //accept the posted data and persist to the database
        $this->author_id=3;//I'm using this as a place holder since I have a user_id of 3 in my db
        $this->content=$page_content; //purify the contents
        $this->title=$page_title;
        $result=$this->db->insert('site_content',$this);
        return $result;
    }
}