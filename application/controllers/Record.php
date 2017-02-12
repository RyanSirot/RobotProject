<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: To Olympus
 * Date: 2017-02-11
 * Time: 6:39 PM
 */




class Record extends Application
{
    function __construct()
    {
    parent::__construct();
    }

    // Presents all the robot parts we have in a grid view
    public function index()
    {

        $this->load->model('AssemblyRecords');
        $this->load->model('ShipmentRecords');
        $this->load->model('PurchasePartsRecords');
        $this->load->model('ReturnPartsRecords');

    // show the parts in grid view
        $this->data['pagebody'] = 'History/homepage';


        $this->data['assembly'] = $this->assemblyrecords->all();
        $this->data['shipment'] = $this->shipmentrecords->all();
        $this->data['purchase'] = $this->purchasepartsrecords->all();
        $this->data['return'] = $this->returnpartsrecords->all();

        $this->render();
    }




}