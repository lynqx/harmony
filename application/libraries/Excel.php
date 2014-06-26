<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 2/21/14
 * Time: 7:13 AM
 */

require_once APPPATH . "/third_party/PHPExcel.php";

class Excel extends PHPExcel
{

    public function __construct()
    {
        parent::__construct();
    }
} 