<?php

/**
 * Created by PhpStorm.
 * User: rachel
 * Date: 2/8/2017
 * Time: 1:01 PM
 */
//Model for robot's parts
class Parts extends CI_Model {

    public $data;

    // Constructor
    public function __construct()
    {
        parent::__construct();

        $this->data = array(
            array('partID' => '1', 'partCode' => 'A1', 'pic' => 'a1.jpeg', 'CACode' => '45AF89FS',
                'plantID' => '1', 'dateTime'=> '2016-06-18', 'cost'=>'36'),
            array('partID' => '2', 'partCode' => 'A2', 'pic' => 'a2.jpeg', 'CACode' => '4SD5V5AS',
                'plantID' => '2', 'dateTime'=> '2016-06-19','cost'=>'37'),
            array('partID' => '3', 'partCode' => 'A3', 'pic' => 'a3.jpeg', 'CACode' => '1D234FDC',
                'plantID' => '3','dateTime'=> '2016-06-20','cost'=>'38'),

            array('partID' => '4', 'partCode' => 'B1', 'pic' => 'b1.jpeg', 'CACode' => 'H3KS897Y',
                'plantID' => '1','dateTime'=> '2016-06-21','cost'=>'39'),
            array('partID' => '5', 'partCode' => 'B2', 'pic' => 'b2.jpeg', 'CACode' => '798HFD8G',
                'plantID' => '2','dateTime'=> '2016-06-22','cost'=>'40'),
            array('partID' => '6', 'partCode' => 'B3', 'pic' => 'b3.jpeg', 'CACode' => 'GDC678SC',
                'plantID' => '3','dateTime'=> '2016-06-23','cost'=>'41'),

            array('partID' => '7', 'partCode' => 'C1', 'pic' => 'c1.jpeg', 'CACode' => 'JAXC8765',
                    'plantID' => '1','dateTime'=> '2016-06-24','cost'=>'39'),
            array('partID' => '8', 'partCode' => 'C2', 'pic' => 'c2.jpeg', 'CACode' => 'GXIOS753',
                'plantID' => '2', 'dateTime'=> '2016-06-25', 'cost'=>'40'),
            array('partID' => '9', 'partCode' => 'C3', 'pic' => 'c3.jpeg', 'CACode' => 'HDS786GF',
                'plantID' => '3','dateTime'=> '2016-06-26','cost'=>'41'),

            array('partID' => '10', 'partCode' => 'M1', 'pic' => 'm1.jpeg', 'CACode' => 'FD56SD89',
                'plantID' => '1','dateTime'=> '2016-06-24','cost'=>'39'),
            array('partID' => '11', 'partCode' => 'M2', 'pic' => 'm2.jpeg', 'CACode' => 'SOKU762S',
                'plantID' => '2', 'dateTime'=> '2016-06-25', 'cost'=>'40'),
            array('partID' => '12', 'partCode' => 'M3', 'pic' => 'm3.jpeg', 'CACode' => 'DIGF453S',
                'plantID' => '3','dateTime'=> '2016-06-26','cost'=>'41'),

            array('partID' => '13', 'partCode' => 'R1', 'pic' => 'r1.jpeg', 'CACode' => 'FS234SRT',
                'plantID' => '1','dateTime'=> '2016-06-24','cost'=>'39'),
            array('partID' => '14', 'partCode' => 'R2', 'pic' => 'r2.jpeg', 'CACode' => 'SD3456SD',
                'plantID' => '2', 'dateTime'=> '2016-06-25', 'cost'=>'40'),
            array('partID' => '15', 'partCode' => 'R3', 'pic' => 'r3.jpeg', 'CACode' => 'SDFVYY87',
                'plantID' => '3','dateTime'=> '2016-06-26','cost'=>'41'),

            array('partID' => '16', 'partCode' => 'W1', 'pic' => 'w1.jpeg', 'CACode' => '6723DF7F',
                'plantID' => '1','dateTime'=> '2016-06-24','cost'=>'39'),
            array('partID' => '17', 'partCode' => 'W2', 'pic' => 'w2.jpeg', 'CACode' => '34HF4D67',
                'plantID' => '2', 'dateTime'=> '2016-06-25', 'cost'=>'40'),
            array('partID' => '18', 'partCode' => 'W3', 'pic' => 'w3.jpeg', 'CACode' => 'HSDL754G',
                'plantID' => '3','dateTime'=> '2016-06-26','cost'=>'41')
        );

        $this->_addMoreInfoToData();
    }

    //after get basic data, add more part info base on partCode
    private function _addMoreInfoToData(){
        foreach($this->data as $record){
            $model = $record['partCode'][0];
            $piece = $record['partCode'][1];
            $record['model'] = $model;

            $householdRegEx = "/^[A-L]$/i";
            $butlerRegE = "/^[M-V]$/i";
            $companionRegE = "/^[W-Z]$/i";
            if(preg_match($householdRegEx, $model)){
                $record['line'] = "household";
            }else if (preg_match($butlerRegE, $model)){
                $record['line'] = "butler";
            }else if (preg_match($companionRegE, $model)){
                $record['line'] = "companion";
            }

            if($piece === '1'){
                $record['piece'] = "top";
            }else if($piece === '2'){
                $record['piece'] = "torso";
            }else if($piece === '3'){
                $record['piece'] = "bottom";
            }

            $dataArray[] = $record;
        }

        $this->data = $dataArray;
    }

    //generate a certificate of Authenticity(CA) code for each part
    private function _generateHashNum()
    {
        return substr(md5(rand()), 0, 8);
    }

    // retrieve a single part
    public function get($which)
    {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
            if ($record['partID'] == $which)
                return $record;
        return null;
    }

    // retrieve all of the parts
    public function all()
    {
        return $this->data;
    }

}