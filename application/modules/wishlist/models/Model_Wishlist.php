<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Wishlist extends MY_Model 
{

  protected $_table  = 'tbl_items';
  protected $_id     = 'item_id';
  protected $_title  = 'item_title';
  protected $_price  = 'item_price';
  protected $_url    = 'item_url';

  function __construct() {
    parent:: __construct();
  }

  /**
   * Insert item
   * @param array $data - array of data to be inserted on database
   * @return bool
   */
  public function item_insert( $data = [] ) {
    if( isset( $data ) && ! empty( $data ) ) {
      $this->_remove_empty_key( $data );
      if ( $this->db->insert( $this->_table, $data )  ) {
        return true;
      } else {
        return false;
      }
    } 
  }

  /**
   * Updated item
   * @param int $id - id of the item to be updated
   * @return bool
   */
  public function item_update( $data = [] ) {
    if( isset( $data ) && ! empty( $data ) && is_array( $data ) ) {
      $this->_remove_empty_key( $data );
      $this->db->where( $this->_id, $data['item_id'] );
      if ( $this->db->update( $this->_table, $data ) ) {
        return true;
      } else {
        return false;
      }
    } 
  }

  /**
   * Delete item
   * @param int $id - id of the item to be deleted
   * @return bool
   */
  public function item_delete( $id = 0 ) {
    if( isset( $id ) && $id ) {
      $this->db->where( $this->_id, $id );
      if ( $this->db->delete( $this->_table ) ) {
        return true;
      } else {
        return false;
      }
    } 
  }

  /**
   * Get single item
   * @param int $id - get single item
   * @return array $result 
   */
  public function item( $id = 0 ) {
    if( $id && ! empty( $id ) ) {
      $this->db->select( '*' );
      $this->db->where( $this->_id, $id );
      $query = $this->db->get( $this->_table  );
      if( $query ) {
        return $query->result();
      } else {
        return false;
      }
    }
  }

  /**
   * Get all items
   * @return array $result - all items
   */
  public function items() {
    $this->db->select( '*' );
    $this->db->order_by( $this->_id, 'DESC' );
    $this->db->from( $this->_table );
    $query = $this->db->get();
    if( $query ) {
      return $query->result();
    } else {
      return false;
    }
  }

  /**
   * Clean array
   * @param array $array - array to be clean
   * @return array $array
   */
  private function _remove_empty_key( $array ) {
    if( $array ) {
      foreach ( $array as $key => $val ) {
        if ( empty(  $val ) ||  $val == NULL ) {
          unset( $array[ $key ] );
        }
      }
      return $array;
    }
  }

}
