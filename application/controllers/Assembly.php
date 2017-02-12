<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assembly extends Application
{

    function __construct()
    {
        parent::__construct();

    }

    /**
     * Assembly robots by parts page 
     */
    public function index()
    {
        // build the list of parts and robots, to pass on to our view
        $parts = $this->parts->all();  // this is a 2D array
        $robots = $this->robots->all();  // this is a 2D array

        //build array of formatted cells for them
        foreach ($parts as $part){
            if($part["piece"] === "top"){
                $cellsForTop[]= $this->parser->parse('_partCell', (array) $part, true);
            }else if($part["piece"] === "torso"){
                $cellsForTorso[]= $this->parser->parse('_partCell', (array) $part, true);
            }else{
                $cellsForBottom[]= $this->parser->parse('_partCell', (array) $part, true);
            }
        }

        foreach ($robots as $robot){
            $cellsForRobots[] = $this->parser->parse('_robotCell', (array)$robot, true);
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
        $this->table->set_caption('Top Pieces');
        $rows = $this->table->make_columns($cellsForTop, 3);
        $this->data['thetableTop'] = $this->table->generate($rows);

        $this->table->set_caption('Torso Pieces');
        $rows = $this->table->make_columns($cellsForTorso, 3);
        $this->data['thetableTorso'] = $this->table->generate($rows);

        $this->table->set_caption('Bottom Pieces');
        $rows = $this->table->make_columns($cellsForBottom, 3);
        $this->data['thetableBottom'] = $this->table->generate($rows);

        $this->table->set_caption('Assembled Robots');
        $rows = $this->table->make_columns($cellsForRobots, 3);
        $this->data['thetableRobots'] = $this->table->generate($rows);

        // this is the view we want shown
        $this->data['pagebody'] = 'Assembly/homepage';
        $this->render();
    }

}