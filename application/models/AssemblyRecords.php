<?php

/**
 * Created by PhpStorm.
 * User: To Olympus
 * Date: 2017-02-11
 * Time: 6:05 PM
 */
class AssemblyRecords extends CI_Model
{

    public $data;

    // Constructor
    public function __construct()
    {
        parent::__construct();

        $this->data = array(
            array('assemblyID' => '1', 'date' => '2016-09-10', 'robotID' => '1'),
            array('assemblyID' => '2', 'date' => '2016-10-01', 'robotID' => '2'),
            array('assemblyID' => '3', 'date' => '2016-05-01', 'robotID' => '3'),
            array('assemblyID' => '4', 'date' => '2016-02-14', 'robotID' => '4'),
            array('assemblyID' => '5', 'date' => '2016-04-01', 'robotID' => '5'),
            array('assemblyID' => '6', 'date' => '2016-11-11', 'robotID' => '6')
        );

    }

    // retrieve a single shipment record
    public function get($which)
    {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
            if ($record['assemblyID'] == $which)
                return $record;
        return null;
    }


    // retrieve all of the shipment records
    public function all()
    {
        return $this->data;
    }

}