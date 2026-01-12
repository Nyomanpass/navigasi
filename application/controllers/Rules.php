<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property M_Rules $M_Rules
 */

class Rules extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Rules');
    }

    public function index() {
        $data['rules'] = $this->M_Rules->get_all_rules();
        $this->load->view('v_rules', $data);
    }
}