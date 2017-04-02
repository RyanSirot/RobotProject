<?php

/**
 * Created by PhpStorm.
 * User: PeiLei
 * Date: 30/03/2017
 * Time: 6:22 PM
 */
class Token extends MY_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct('Token', 'id');
    }

}