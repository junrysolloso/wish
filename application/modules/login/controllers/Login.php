<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->view( 'view_login' );
	}

}

/* End of file Setup.php */
/* Location: ./application/controllers/Setup.php */
