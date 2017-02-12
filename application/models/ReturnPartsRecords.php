<?php

/**
 * Created by PhpStorm.
 * User: To Olympus
 * Date: 2017-02-11
 * Time: 6:03 PM
 */
class ReturnPartsRecords extends CI_Model
{
    public $data;

    // Constructor
    public function __construct()
    {
        parent::__construct();

        $this->data = array(
            array('returnID' => '1', 'date' => '2016-09-10', 'partID' => '1'),
            array('returnID' => '2', 'date' => '2016-10-01', 'partID' => '2'),
            array('returnID' => '3', 'date' => '2016-05-01', 'partID' => '3'),
            array('returnID' => '4', 'date' => '2016-02-14', 'partID' => '4'),
            array('returnID' => '5', 'date' => '2016-04-01', 'partID' => '5'),
            array('returnID' => '6', 'date' => '2016-11-11', 'partID' => '6')
        );

    }

    // retrieve a single parts purchase record
    public function get($which)
    {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
            if ($record['returnID'] == $which)
                return $record;
        return null;
    }


    // retrieve all of the parts purchase record
    public function all()
    {
        return $this->data;
    }

}