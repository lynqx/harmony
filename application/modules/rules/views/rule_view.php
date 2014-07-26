<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 7/25/14
 * Time: 8:15 PM
 */

//var_dump($data);
//var_dump($data->getResults());
foreach($data->getResults() as $entry)
{
    echo 'Result=>'. $entry->vl;
}

//var_dump($data2);