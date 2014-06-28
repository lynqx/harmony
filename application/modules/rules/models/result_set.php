<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 6/25/14
 * Time: 5:33 AM
 */

class Result_set extends CI_Model
{
    private $results = [];

    public function getResults()
    {
        return $this->results;
    }

    /** Add Result To Set simply adds a new result entry to the instantiated resultSet object's results array
     * @param $result
     */
    public function addResultToSet($result)
    {
        $this->results[] = $result;
    }
    public function __construct()
    {
        parent::__construct();
    }
} 