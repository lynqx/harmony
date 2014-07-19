<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 7/19/14
 * Time: 12:47 AM
 */

class Sms_model extends CI_Model {
public  function __construct()
{
    parent::__construct();
}
    public function send($recipient,$message,$sender)
    {
        //This method handles all the curl requests et al

        //temporary hack for post data. Should be handled by a function
        $postData='user='.SMS_ADMIN_USERNAME.'&pass='.SMS_ADMIN_PASS.'&from='.$sender.'&to='.$recipient.'&msg='.$message; //initialize the request variable
        //culled from Akin's implementation
        $ch = curl_init(); //initialize curl handle
        curl_setopt($ch, CURLOPT_URL, SMS_URL); //set the url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
        curl_setopt($ch, CURLOPT_POST, 1); //set POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); //set the POST variables
        $response = curl_exec($ch); // grab URL and pass it to the browser. Run the whole process and return the response
        curl_close($ch); //close the curl handle

        return $response;
    }

} 