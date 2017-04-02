<?php


class Transactions extends MY_Model{
    public function __construct()
    {
        parent::__construct('Transactions', 'transactionID');
    }


}
