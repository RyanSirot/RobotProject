<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// prepare for data
        $numPartsOnHand = sizeof($this->parts->all());
        $numRobotsOnHand = sizeof($this->robots->all());
        $spent = 100000;
        $earned = 9999999999;

        $arrayToShow = array('numPartsOnHand' => $numPartsOnHand, 'numRobotsOnHand' => $numRobotsOnHand, 'spent' => $spent,
            'earned' => $earned);

        $cellsForData[] = $this->parser->parse('_welcomeCell', $arrayToShow, true);

        //prime the table class
        $this->load->library('table');
        $prams = array(
            'table_open' => '<table class="gallaryTable">',
            'cell_start' => '<td class="oneCell">',
            'cell_alt_start' => '<td class="oneCell">'
        );

        $this->table->set_template($prams);
        $this->table->set_caption('Central Data');
        $rows = $this->table->make_columns($cellsForData, 1);
        $this->data['tableData'] = $this->table->generate($rows);

        $this->data['pagebody'] = 'welcome_message';
		$this->render(); 
	}

}
