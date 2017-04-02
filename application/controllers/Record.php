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
    private $items_per_section = 5;
    function __construct()
    {
    parent::__construct();
    }

    // Presents all the robot parts we have in a grid view
    public function index()
    {
        $this->data['pagebody'] = 'History/homepage';

        // assemblyID
        //partTopCACode
        //partBodyCACode
        //partBtmCACode
        //assemblyDateTime
        //assemblyPrice
        //robotID
        $this->data['assembly'] = $this->assemblyrecords->all();

        //shipmentID
        //shipmentDateTime
        //shipmentProfit
        //robotID
        $this->data['shipment'] = $this->shipmentrecords->all();

        //id
        //partonecacode
        //parttwocacode
        //partthreecacode
        //partfourcacode
        //partfivecacode
        //partsixcacode
        //partsevencacode
        //parteightcacode
        //partninecacode
        //parttencacode
        //cost
        //datetime
        $this->data['purchase'] = $this->purchasepartsrecords->all();

        //id
        //partcacode
        //earning
        //datetime
        $this->data['return'] = $this->returnpartrecords->all();

        $this->render();
    }

}