<?php

/**
 * User: To Olympus
 * Date: 2017-02-11
 * Time: 6:03 PM
 */
class Returnpartrecords extends MY_Model
{
    public $data;

    // Constructor
    public function __construct()
    {
        parent::__construct('returnpartrecords','id');
    }
}