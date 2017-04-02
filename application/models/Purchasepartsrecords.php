<?php

/**
 * Description of PurchaseParts
 *
 * @author Jing
 */
class Purchasepartsrecords extends MY_Model
{
    public $data;

    // Constructor
    public function __construct()
    {
        parent::__construct('purchasepartsrecords','id');
    }
}