<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_Setup extends CI_Migration {

	public function up() {
		$attributes = array('ENGINE' => 'MyISAM', 'DEFAULT CHARSET' => 'utf8');

		$fields = array(
			"`id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY",
			"`name` varchar(150) NOT NULL DEFAULT ''"	,
			"`user` varchar(50) NOT NULL",
			"`pass` varchar(100) NOT NULL",
			"`mail` varchar(50) NOT NULL",
			"`active` int(1) NOT NULL DEFAULT '0'",
			"`mail_token` varchar(100) NULL",
			"`mail_expires` datetime NULL",
			"`created` datetime NOT NULL",
			"`updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
			"`access` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP"
		);

		$this->dbforge->add_field( $fields );
		$this->dbforge->create_table( 'users', TRUE, $attributes );
		$this->db->simple_query( "INSERT INTO `tbl_users` (`name`, `user`, `pass`, `mail`, `active`, `created`) VALUES ('Admin', 'admin', '09ae22c2c195d71cca64d461a1603332efb073d9', 'admin@localhost.com', 1, CURRENT_TIMESTAMP)" );

		$fields = array(
			"`ip` varchar(20) NOT NULL PRIMARY KEY",
			"`attempts` tinyint(1) NOT NULL",
			"`blocked` datetime NOT NULL",
		);

		$this->dbforge->add_field( $fields );
		$this->dbforge->create_table( 'auth_attempts', TRUE, $attributes );

		$fields = array(
			"`id` varchar(128) NOT NULL",
			"`ip_address` varchar(45) NOT NULL",
			"`timestamp` int(10) unsigned DEFAULT 0 NOT NULL",
			"`data` blob NOT NULL",
			"PRIMARY KEY (id)",
			"KEY `ci_sessions_timestamp` (`timestamp`)"
		);

		$this->dbforge->add_field( $fields );
		$this->dbforge->create_table( 'sessions', TRUE, $attributes );

		$fields = array(
			"`item_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
  		"`item_title` varchar(60) NOT NULL",
  		"`item_price` int(10) NOT NULL DEFAULT 0",
  		"`item_url` varchar(255) NOT NULL"
		);
		$this->dbforge->add_field( $fields );
		$this->dbforge->create_table( 'items', TRUE, $attributes );
	}

	public function down() {

		$this->dbforge->drop_table( 'users' );
		$this->dbforge->drop_table( 'auth_attempts' );
    $this->dbforge->drop_table( 'sessions' );
    
  }
  
}

/* End of file 001_install_admin.php */
/* Location: ./application/migrations/001_install_admin.php */
