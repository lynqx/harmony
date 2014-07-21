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
// this is dejjys API but i cant rem aw i configured it then again
    public function send23($recipient,$message,$sender)
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
	
	
	//this is my own SMS API account, pls use with discretion. Na my money we dey use test o
	public function send($recipient, $message, $sender)
    {
	
		$username='doubleakins';
		$password='admin';
		$sender=$sender;
		$destination=$recipient;
		$longSms = 0;

 
			//This code block can be customised. 
			//The $data array contains data that must be modified as per the API documentation. The array contains data that you will post to the server
			$data= array(
			"Type"=> "sendparam", 
			"Username" => $username,
			"Password" => $password,
			"senderid" => $sender,
			"live" => "true",
			"numto" => $destination,
			"data1" => $message
			);

			//This contains data that you will send to the server.
			$data = http_build_query($data); //builds the post string ready for posting
			echo $this->do_post_request('http://www.mymobileapi.com/api5/http5.aspx', $data);  //Sends the post, and returns the result from the server.
			}
			
			
	function do_post_request($url, $data, $optional_headers = null)
	{
     $params = array('http' => array(
                  'method' => 'POST',
                  'content' => $data
               ));
     if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
     }
     $ctx = stream_context_create($params);
     $fp = @fopen($url, 'rb', false, $ctx);
     if (!$fp) {
        throw new Exception("Problem with $url, $php_errormsg");
     }
     $response = @stream_get_contents($fp);
     if ($response === false) {
        throw new Exception("Problem reading data from $url, $php_errormsg");
     }
     $response;
     return $this->formatXmlString($response);
     
  }
  
  //takes the XML output from the server and makes it into a readable xml file layout
//DO NOT EDIT unless you are sure of your changes
function formatXmlString($xml) 
{  
  
  // add marker linefeeds to aid the pretty-tokeniser (adds a linefeed between all tag-end boundaries)
  $xml = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $xml);
  
  // now indent the tags
  $token      = strtok($xml, "\n");
  $result     = ''; // holds formatted version as it is built
  $pad        = 0; // initial indent
  $matches    = array(); // returns from preg_matches()
  
  // scan each line and adjust indent based on opening/closing tags
  while ($token !== false) : 
  
    // test for the various tag states
    
    // 1. open and closing tags on same line - no change
    if (preg_match('/.+<\/\w[^>]*>$/', $token, $matches)) : 
      $indent=0;
    // 2. closing tag - outdent now
    elseif (preg_match('/^<\/\w/', $token, $matches)) :
      $pad--;
    // 3. opening tag - don't pad this one, only subsequent tags
    elseif (preg_match('/^<\w[^>]*[^\/]>.*$/', $token, $matches)) :
      $indent=1;
    // 4. no indentation needed
    else :
      $indent = 0; 
    endif;
    
    // pad the line with the required number of leading spaces
    $line    = str_pad($token, strlen($token)+$pad, ' ', STR_PAD_LEFT);
    $result .= $line . "\n"; // add to the cumulative result, with linefeed
    $token   = strtok("\n"); // get the next token
    $pad    += $indent; // update the pad size for subsequent lines    
  endwhile; 
  
  return $result;
}

} 