<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2016, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller
{

	/**
	 * Constructor.
	 * Establish view parameters & load common helpers
	 */

	function __construct()
	{
		parent::__construct();

		//  Set basic view parameters
		$this->data = array ();
		$this->data['pagetitle'] = 'CuteRobot';
		$this->data['ci_version'] = (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : '';
        // error alert
        $this->data['alerts'] = '';
        $this->error_free = TRUE;
	}

	/**
	 * Render this page
	 */
	function render($template = 'template')
	{

        $role = $this->session->userdata('userrole');
        $isAuth = $role == ROLE_BOSS;
        $this->data['menubar'] = "";
        if($isAuth) {
            $this->data['menubar'] = $this->parser->parse('_menubar', $this->config->item('menu_choices'),true);

        } else {
            $this->data['menubar'] = $this->parser->parse('_menubar', $this->config->item('menu_choices2'),true);
        }


        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        // INSERT THE NEXT FOUR LINES
        // integrate any needed CSS framework & components
        $this->data['caboose_styles'] = $this->caboose->styles();
        $this->data['caboose_scripts'] = $this->caboose->scripts();
        $this->data['caboose_trailings'] = $this->caboose->trailings();
        // THE ABOVE FOUR LINES GET INSERTED
		$this->parser->parse('template', $this->data);
	}

    // Add an alert to the rendered page
    function alert($message = '', $context = 'success')
    {
        $parms = ['message' => $message, 'context' => $context];
        $this->data['alerts'] .= $this->parser->parse('_alert', $parms, true);
        $this->error_free = FALSE;
    }
}
