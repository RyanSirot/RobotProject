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

    private $sort = "timestamp";
    private $filterModel = 'all';
    private $filterLine = 'all';

    private $true = false;

    function __construct()
    {
        parent::__construct();
    }

    // Presents all the robot parts we have in a grid view
    public function index()
    {
        $this->page(1);
    }

    private function renderHistory(){
        $this->data['pagebody'] = 'History/homepage';
        $this->render();
    }


    /////////////////////////////////////////////////////

    // Extract & handle a page of items, defaulting to the beginning
    function page($num = 1)
    {
        //---------------------SORT---------------------
        $sort = $this->input->post('order');
        if($this->session->userdata('sort') == null) {
            $this->session->set_userdata('sort', $this->sort);
        } else if($sort != null) {
            $this->session->set_userdata('sort', $sort);
        }
        $this->sort = $this->session->userdata('sort');

        //---------------------FILTER---------------------
        $filterModel = $this->input->post('filterModel');
        if($this->session->userdata('filterModel') == null) {
            $this->session->set_userdata('filterModel', $this->filterModel);
        } else if($filterModel != null) {
            $this->session->set_userdata('filterModel', $filterModel);
        }
        $this->filterModel = $this->session->userdata('filterModel');
        $filterLine = $this->input->post('filterLine');
        if($this->session->userdata('filterLine') == null) {
            $this->session->set_userdata('filterLine', $this->filterLine);
        } else if($filterLine != null) {
            $this->session->set_userdata('filterLine', $filterLine);
        }
        $this->filterLine = $this->session->userdata('filterLine');

        //------------------PULLPAGE---------------------
        //$records = $this->transactions->all($this->sort, $this->filterModel, $this->filterLine);
        $records = $this->transactions->all(); // get all the tasks


        $recordArray = array(); // start with an empty extract
        // use a foreach loop, because the record indices may not be sequential
        $index = 0; // where are we in the tasks list
        $count = 0; // how many items have we added to the extract
        $start = ($num - 1) * $this->items_per_section;
        foreach($records as $record) {
            if ($index++ >= $start) {
                $recordArray[] = $record;
                $count++;
            }
            if ($count >= $this->items_per_section) break;
        }
        $this->data['pagination'] = $this->pagenav($num);

        //------------------FILTERSORTSCRIPTS---------------------
        $this->data['sort_script'] = '
        <script>
        window.onload = function () {
            var textToFind = "' . $this->sort . '";
    
            var dd = document.getElementById("order");
            dd.selectedIndex = 0;
            for (var i = 0; i < dd.options.length; i++) {
                if (dd.options[i].value === textToFind) {
                    dd.selectedIndex = i;
                    break;
                }
            }
        ';
        $this->data['filterModel_script'] = '
            var textToFind = "' . $this->filterModel . '";
        
            var dd = document.getElementById("filterModel");
            dd.selectedIndex = 0;
            for (var i = 0; i < dd.options.length; i++) {
                if (dd.options[i].value === textToFind) {
                    dd.selectedIndex = i;
                    break;
                }
        }';
        $this->data['filterLine_script'] = '
            var textToFind = "' . $this->filterLine . '";
    
            var dd = document.getElementById("filterLine");
            dd.selectedIndex = 0;
            for (var i = 0; i < dd.options.length; i++) {
                if (dd.options[i].value === textToFind) {
                    dd.selectedIndex = i;
                    break;
                }
            }
        };
        </script>';

        $this->show_page($recordArray);
    }

// Build the pagination navbar
    private function pagenav($num) {
        $lastpage = ceil($this->transactions->size() / $this->items_per_section);
        $parms = array(
            'first' => 1,
            'previous' => (max($num-1,1)),
            'next' => min($num+1,$lastpage),
            'last' => $lastpage
        );
        return $this->parser->parse('History/_itemNav',$parms,true);
    }


    ///////////////////////////////////////////////////////

//    // retrieve all of the transaction history entries
//    public function all($column = 'transacDateTime', $filterModel = 'all', $filterLine = 'all')
//    {
//        $this->db->order_by($column, 'asc');
//        $this->db->from('transactions');
//
//        if($filterLine != 'all') {
//            //$this->db->where('line', $filterLine);
//        }
//        if($filterModel != 'all') {
//            //$this->db->where('model', $filterModel);
//        }
//
//        $query = $this->db->get();
//        return $query->result();
//    }
//
//    public function filter($filter, $column = 'timestamp') {
//        $this->db->order_by($column, 'asc');
//        $this->db->from('history');
//        $this->db->where('line', "Household");
//        $query = $this->db->get();
//        return $query->result();
//    }



    // Show a single page of todo items
    private function show_page($recordArray)
    {
        $result = ''; // start with an empty array
        foreach ($recordArray as $record)
        {
            if (!empty($record->status))
                $record->status = $this->statuses->get($record->status)->name;

            $parts = $this->getParts($record->transacType, $record->transactionID);

            $filterThisRecord = false;
            if($this->filterLine != 'all') {
                echo $this->filterLine. "|";
                echo $parts['partLines'];
                if (strpos($parts['partLines'], $this->filterLine) === false) {
                    $filterThisRecord = true;
                }
            }
            if($this->filterModel != 'all') {
                echo $this->filterModel;
                if (strpos($parts['partModels'], $this->filterModel) === false) {
                    $filterThisRecord = true;
                }
            }
            if($filterThisRecord == false){
                $finishedRecord['transactionID'] = $record->transactionID;
                $finishedRecord['transacType'] = $record->transacType;
                $finishedRecord['parts'] = $parts['partNames'];
                $finishedRecord['transacMoney'] = $record->transacMoney;
                $finishedRecord['transacDateTime'] = $record->transacDateTime;
                $result .= $this->parser->parse('History/_history', (array) $finishedRecord, true);
            }

        }
        $this->data['history'] = $result;
        $this->renderHistory();
    }

//    private function getHistory($record){
//        $result = '';
//        $parts = $this->getParts($record->transacType, $record->transactionID);
//
//        $filterThisRecord = false;
//        if($this->filterLine != 'all') {
//            if (strpos($parts['partLines'], $this->filterLine) === false) {
//                $filterThisRecord = true;
//            }
//        }
//        if($this->filterModel != 'all') {
//            if (strpos($parts['partModels'], $this->filterModel) === false) {
//                $filterThisRecord = true;
//            }
//        }
//        if($filterThisRecord == false){
//            $finishedRecord['transactionID'] = $record->transactionID;
//            $finishedRecord['transacType'] = $record->transacType;
//            $finishedRecord['parts'] = $parts['partNames'];
//            $finishedRecord['transacMoney'] = $record->transacMoney;
//            $finishedRecord['transacDateTime'] = $record->transacDateTime;
//            $result .= $this->parser->parse('History/_history', (array) $finishedRecord, true);
//        }
//        return $result;
//    }

    private function getParts($transacType, $transacID){
        $partsData = array();
        if($transacType=='assembly'){
            $PartsRecords = $this->assemblyrecords->some('transactionID',$transacID);
            if (sizeof($PartsRecords) == 1) {
//            NAMES
            $partsData['partNames'] = $this->parts->get($PartsRecords[0]->partTopCACode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partBodyCACode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partBtmCACode)->partName;
                //echo $partsData['partNames'];
//            MODELS
            $partsData['partModels'] = $this->parts->get($PartsRecords[0]->partTopCACode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partBodyCACode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partBtmCACode)->model;
//            LINES
            $partsData['partLines'] = $this->parts->get($PartsRecords[0]->partTopCACode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partBodyCACode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partBtmCACode)->line;
            }
        }
        else if($transacType=='purchase'){
            $PartsRecords = $this->purchasepartsrecords->some('transactionID',$transacID);
            if (sizeof($PartsRecords) == 1) {
//            NAMES
            $partsData['partNames'] = $this->parts->get($PartsRecords[0]->partonecacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->parttwocacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partthreecacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partfourcacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partfivecacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partsixcacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partsevencacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->parteightcacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partninecacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->parttencacode)->partName;
//            MODELS
            $partsData['partModels'] = $this->parts->get($PartsRecords[0]->partonecacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->parttwocacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partthreecacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partfourcacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partfivecacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partsixcacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partsevencacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->parteightcacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partninecacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->parttencacode)->model. ", ";
//            LINES
            $partsData['partLines'] = $this->parts->get($PartsRecords[0]->partonecacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->parttwocacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partthreecacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partfourcacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partfivecacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partsixcacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partsevencacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->parteightcacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partninecacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->parttencacode)->line. ", ";
            }
        }
        else if($transacType=='shipment'){
            $PartsRecords = $this->shipmentrecords->some('transactionID',$transacID);
            if (sizeof($PartsRecords) == 1) {
//            NAMES
            $partsData['partNames'] = $this->parts->get($PartsRecords[0]->partTopCACode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partBodyCACode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partBtmCACode)->partName. ", ";
//            MODELS
            $partsData['partModels'] = $this->parts->get($PartsRecords[0]->partTopCACode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partBodyCACode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partBtmCACode)->model. ", ";
//            LINES
            $partsData['partLines'] = $this->parts->get($PartsRecords[0]->partTopCACode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partBodyCACode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partBtmCACode)->line. ", ";
            }
        }
        else if($transacType=='return'){
            $PartsRecords = $this->returnpartrecords->some('transactionID',$transacID);
            if (sizeof($PartsRecords) == 1) {
                //            NAMES
                $partsData['partNames'] = $this->parts->get($PartsRecords[0]->partcacode)->partName;
//            MODELS
                $partsData['partModels'] = $this->parts->get($PartsRecords[0]->partcacode)->model;
//            LINES
                $partsData['partLines'] = $this->parts->get($PartsRecords[0]->partcacode)->line;
            }
        }
        else if($transacType=='build'){
            $PartsRecords = $this->buildpartsrecords->some('transactionID',$transacID);
            if (sizeof($PartsRecords) == 1) {
//            NAMES
            $partsData['partNames'] = $this->parts->get($PartsRecords[0]->partonecacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->parttwocacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partthreecacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partfourcacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partfivecacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partsixcacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partsevencacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->parteightcacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->partninecacode)->partName. ", ".
                $this->parts->get($PartsRecords[0]->parttencacode)->partName. ", ";
//            MODELS
            $partsData['partModels'] = $this->parts->get($PartsRecords[0]->partonecacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->parttwocacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partthreecacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partfourcacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partfivecacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partsixcacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partsevencacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->parteightcacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->partninecacode)->model. ", ".
                $this->parts->get($PartsRecords[0]->parttencacode)->model. ", ";
//            LINES
            $partsData['partLines'] = $this->parts->get($PartsRecords[0]->partonecacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->parttwocacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partthreecacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partfourcacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partfivecacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partsixcacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partsevencacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->parteightcacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->partninecacode)->line. ", ".
                $this->parts->get($PartsRecords[0]->parttencacode)->line. ", ";
            }
        }
//        echo $partsData['partNames'] . "|";
//        echo $partsData['partLines'] . "|";
//        echo $partsData['partModels'] . "| |";
        return $partsData;
    }


}