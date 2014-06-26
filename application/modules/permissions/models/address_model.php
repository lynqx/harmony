<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/25/14
 * Time: 10:36 AM
 */

class Address_model extends CI_Model
{
    private $id;
    private $addressLine1;
    private $addressLine2;
    private $city;
    private $state;
    private $country;

    function __construct()
    {
        parent::__construct();
    }

    function get_address($address_id)
    {
        //return the requested address
        //TODO: Return the requested address
    }

    function get_user_address($user)
    {
        //TODO:return the user address requested
    }

} 