<?php

class Retrievepartsrecords extends MY_Model
{
    public $data;

    // Constructor
    public function __construct()
    {
        parent::__construct('purchasepartsrecords','id');
    }
}