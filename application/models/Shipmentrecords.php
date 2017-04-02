<?php

/**
 * User: To Olympus
 * Date: 2017-02-11
 * Time: 6:02 PM
 */
class ShipmentRecords extends MY_Model
{
    public $data;

    // Constructor
    public function __construct()
    {
        parent::__construct('shipmentrecords', 'shipmentID');
    }
}