<?php

/**
 * Created by PhpStorm.
 * User: rache
 * Date: 2/8/2017
 * Time: 1:01 PM
 */
//Model for Plant
class Plants extends CI_Model {
// The data comes from http://www.quotery.com/top-100-funny-quotes-of-all-time/?PageSpeed=noscript

    public $data;

    // Constructor
    public function __construct()
    {
        parent::__construct();

        $this->data = array(
            array('plantID' => '1', 'plantName'=>'companyA'),
            array('plantID' => '2', 'plantName'=>'companyB'),
            array('plantID' => '3', 'plantName'=>'companyC'),
        );

    }

    // retrieve a single part
    public function get($which)
    {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
            if ($record['plantID'] == $which)
                return $record;
        return null;
    }

    // retrieve all of the parts
    public function all()
    {
        return $this->data;
    }

}