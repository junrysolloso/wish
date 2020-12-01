<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends MY_Controller 
{

	function __construct() {
		parent:: __construct();
		$this->load->model( 'Model_Wishlist' ); // Load model
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://localhost/wish/
	 *	- or -
	 * 		http://localhost/wish/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://localhost/wish/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {

		/**
		 * Load Form Validation library
		 * @see /config/autoload.php file
		 */
		$this->load->library( 'form_validation' );
		$this->form_validation->set_error_delimiters( '<li>', '</li>' );

		$item_fields  =  array (
			array(
				'field' => 'item_title',
				'label'	=> 'title',
				'rules'	=> 'required|trim',
			),
			array(
				'field' => 'item_url',
				'label'	=> 'url',
				'rules'	=> 'valid_url|required|trim',
				'errors'=> array(
					'valid_url' => 'Please enter a valid url.',
				),
			),
			array(
				'field' => 'item_price',
				'label'	=> 'price',
				'rules'	=> 'max_length[6]|required|trim',
				'errors'=> array(
					'max_length' => 'Please input 6 digits only.',
				),
			),
		);

		$this->form_validation->set_rules( $item_fields );

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			if ( $this->form_validation->run() ) {
				$item_id = $this->input->post( 'item_id' ) ? $this->input->post( 'item_id' ) : NULL;
				$data = array (
					'item_id'    => $item_id,
					'item_title' => $this->input->post( 'item_title' ),
					'item_price' => $this->input->post( 'item_price' ),
					'item_url'	 => $this->input->post( 'item_url' ),
				);

				if( $this->input->post( 'add' ) && ! empty( $this->input->post( 'add' ) ) ) {
					if ( $this->Model_Wishlist->item_insert( $data ) ) {
						unset( $_POST );
						$this->session->set_tempdata( array(
							'msg' 	=> 'Wishlist successfully added.',
							'class' => 'alert-success',
						), NULL, 5 );
					}
				}

				if( $this->input->post( 'update' ) && ! empty( $this->input->post( 'update' ) ) ) {
					if ( $this->Model_Wishlist->item_update( $data ) ) {
						unset( $_POST );
						$this->session->set_tempdata( array(
							'msg' 	=> 'Wishlist successfully updated.',
							'class' => 'alert-success',
						), NULL, 5 );
					}
				}
			}
		}
		
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) && $_GET['id'] ) {
				if( $this->item_remove( $_GET['id'] ) ) {
					return $this;
				}
			} else {
				if( isset( $_GET['iu'] ) && is_numeric( $_GET['iu'] ) && $_GET['iu'] ) {
					$data['item'] = $this->Model_Wishlist->item( $this->input->get( 'iu' ) );
					$data['item'] ? $data['item'] : $data['item'] = [];
				}
			}
		} 

		$data['items'] = $this->Model_Wishlist->items();
		$data['title'] = 'Wishlist Note';

		$this->template->set_master_template( 'layouts/template_site' );
		$this->template->write( 'title',  $data['title'] );
		$this->template->write_view( 'content', 'view_wishlist', $data );
		$this->template->add_css( 'assets/css/bootstrap.min.css' );
		$this->template->add_js( 'assets/js/jquery.js' );
		$this->template->add_js( 'assets/js/bootstrap.min.js' );
		$this->template->add_js( 'assets/js/helper.js' );
		$this->template->render();

	}

	/**
	 * Delete item
	 * @param int $id - item to be deleted
	 * @return bool
	 */
	public function item_remove( $id = 0 ) {
		if( $id && ! empty( $id ) ) {
			if( $this->Model_Wishlist->item_delete( $id ) ) {
				$this->session->set_tempdata( array(
					'msg' 	=> 'Wishlist successfully deleted.',
					'class' => 'alert-danger',
				), NULL, 5 );
			}
		}
	}

	/**
	 * Update item
	 * @param int $id - item to be updated
	 * @return bool
	 */
	public function item_update( $data = [] ) {
		if( $id && ! empty( $data ) ) {
			if( $this->Model_Wishlist->item_update( $data ) ) {
				$this->session->set_tempdata( array(
					'msg' 	=> 'Wishlist successfully updated.',
					'class' => 'alert-success',
				), NULL, 5 );
			}
		}
	}

}
