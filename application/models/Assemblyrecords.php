<?php

/**
 * User: To Olympus
 * Date: 2017-02-11
 * Time: 6:05 PM
 */
class AssemblyRecords extends MY_Model
{
    public $data;
    
    // Constructor
    public function __construct()
    {        
        parent::__construct('assemblyrecords','assemblyID');
    }
}