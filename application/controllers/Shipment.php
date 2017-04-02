<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment extends Application
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * ship robots by parts page
     */
    public function index()
    {
        // build the list of robots, to pass on to our view
        $robots = array();
        foreach($this->robots->all() as $robot){
            if($robot->status == 1){
                $robots[] = $robot;
            }
        }
        // show roles
        $role = $this->session->userdata('userrole');
        $this->data['pagetitle'] = 'CuteRobot ('. $role . ')';

        //prime the table class
        $this->load->library('table');
        $prams = array(
            'table_open' => '<table class="gallaryTable">',
            'cell_start' => '<td class="oneCell">',
            'cell_alt_start' => '<td class="oneCell">'
        );
        $this->table->set_template($prams);

        //robot table
        $cellsForRobots=  array();
        foreach ($robots as $robot){
            if($role == ROLE_BOSS){
                $robot->disabled = "";
            }else{
                $robot->disabled = "disabled";
            }
            $robot->part1Pic = $this->parts->get($robot->part1CA)->pic;
            $robot->part2Pic = $this->parts->get($robot->part2CA)->pic;
            $robot->part3Pic = $this->parts->get($robot->part3CA)->pic;
            $cellsForRobots[] = $this->parser->parse('_robotCell', (array)$robot, true);
        }

        $this->table->set_caption('Assembled Robots');
        if(count($cellsForRobots) != 0){
            $rows = $this->table->make_columns($cellsForRobots, 3);
            $tableHtml = $this->table->generate($rows);
        }else{
            $tableHtml = "<h4 style='text-align:center;'><span style='color:red;'>No Assembled Robot</span>: you need choose parts to assembly a robot.</h4>";
        }
        if($role == ROLE_BOSS){
            $tableHtml .= $this->parser->parse('_shipButton',[], true);
        }
        $this->data['thetableRobots'] = $tableHtml;
        $this->data['robotFormAction'] = ($role == ROLE_BOSS) ? '/shipment/shipRobot' : '#';

        // this is the view we want shown
        $this->data['pagebody'] = 'Shipment/homepage';
        $this->render();
    }

    //when click ship robots button, handle posted info
    public function shipRobot(){
        $role = $this->session->userdata('userrole');
        if ($role != ROLE_BOSS) {
            redirect('/assembly');
        }
        if(!isset($_POST['shipRobot'])){
            //doesn't click ship button
            redirect('/assembly');
        }
        //when ship button click
        $robotIds = array();
        foreach ($this->input->post() as $key => $value) {
            if (substr($key,0,5) == 'robot') {
                $robotIds[] = substr($key,5);
            }
        }
        $error_msgs = array();
        if(count($robotIds) < 1 ){
            //Error: of no checkbox is chosen, show error msg
            $error_msgs[] = "You must choose at lease one robot to ship to head office!";
            $this->alert('<strong>Validation errors!<strong><br>'.$error_msgs[0], 'danger');
        } else {
            //validation successful:
            $tokenArray = $this->token->head(1);
            $token = $tokenArray[0]->token_session;
            $url = BASE_URL . "/work/buymybot";
            $account = $this->account->head(1);
            $baseEarn = $account[0]->money_earned;
            $earn = 0;
            foreach ($robotIds as $robotId) {
                $robot = $this->robots->get($robotId);
                $allUrl = $url."/" . $robot->part1CA . "/" . $robot->part2CA . "/" . $robot->part3CA;
                $response = file_get_contents($allUrl . '?key='.$token);
                $responseArray = explode(" ", $response);
                if ($responseArray[0] == "Ok") {
                    $earn += $responseArray[1];

                    //insert ship info into transaction table on db
                    $transaction_history = $this->transactions->create();
                    $transaction_history->transacType = "ship robot";
                    $transaction_history->transacMoney = $responseArray[1];
                    $transaction_history->transacDateTime = date('Y-m-d H:i:s',time());
                    $this->transactions->add($transaction_history);

                    //insert shipment record into shipmentrecord table on db
                    $shipmentrecord = $this->shipmentrecords->create();
                    $shipmentrecord->shipmentDateTime	=date('Y-m-d H:i:s',time());
                    $shipmentrecord->shipmentProfit = $responseArray[1];
                    $shipmentrecord->robotID = $robotId;
                    $transactionArray = $this->transactions->tail(1);
                    $shipmentrecord->transactionID = $transactionArray[0]->transactionID;
                    $this->shipmentrecords->add($shipmentrecord);

                    //update robot table status on db
                    $robot->status = 0; // ship robot
                    $this->robots->update($robot);
                } else {
                    $error_msgs = explode(" Hmmm - ", $response);
                    $messages = "";
                    foreach ($error_msgs as $error_msg) {
                        $messages .= $error_msg . '<br>';
                    }
                    $this->alert('<strong>Validation errors!<strong><br>' . $messages, 'danger');
                    break;
                }
            }
            if(count($error_msgs) == 0){
                //update account table
                $account[0]->money_earned = $baseEarn + $earn;
                $this->account->update($account[0]);
                $this->alert('Ship Robots Successful!<br>You have earned $'.$earn);
            }
        }
        $this->index();
    }
}