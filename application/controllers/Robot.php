<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: PeiLei
 * Date: 08/02/2017
 * Time: 3:15 PM
 */
// Robot controller - controls methods manipulating robots
class Robot extends Application
{
    function __construct()
    {
        parent::__construct();
    }

    // Presents all the robots we have in a grid view
    function Index() {
        // show the robots
        $this->data['pagebody'] = 'Robot/homepage';
        $source = $this->robots->all();

        foreach ($source as $robot){
            $cellsForRobots[] = $this->parser->parse('_robotCell2', (array)$robot, true);
        }

        //prime the table class
        $this->load->library('table');
        $prams = array(
            'table_open' => '<table class="gallaryTable">',
            'cell_start' => '<td class="oneCell">',
            'cell_alt_start' => '<td class="oneCell">'
        );
        $this->table->set_template($prams);

        //finally, generate the table
        $this->table->set_caption('Robots');
        $rows = $this->table->make_columns($cellsForRobots, 3);
        $this->data['tableRobots'] = $this->table->generate($rows);

        // $this->data['robots'] = $source;
        $this->render();

    }

    // Presents the detailed information of each robot
    public function gimme($id) {
        $this->data['pagebody'] = 'Robot/oneRobot';
        $record = $this->robots->get($id);

        $this->data = array_merge($this->data, $record);
        $this->render();
    }

}