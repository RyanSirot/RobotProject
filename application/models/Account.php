<?php

/**
 * Created by PhpStorm.
 * User: PeiLei
 * Date: 29/03/2017
 * Time: 10:26 PM
 */
class Account extends MY_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct('Account', 'id');
    }
}