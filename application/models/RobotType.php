<?php

/**
 * Created by PhpStorm.
 * User: PeiLei
 * Date: 08/02/2017
 * Time: 3:46 PM
 */
//Model representing the 4 different Robot Type
class RobotType extends CI_Model
{
    var $data = array(
        array('id' => '1', 'name' => 'household'),
        array('id' => '2', 'name' => 'butler'),
        array('id' => '3', 'name' => 'companion'),
        array('id' => '4', 'name' => 'motley')
    );

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

}