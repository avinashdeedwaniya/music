<?php

/**
 * Fired during plugin activation
 *
 * @link       http://musiccomposer.com
 * @since      1.0.0
 *
 * @package    Music
 * @subpackage Music/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Music
 * @subpackage Music/includes
 * @author     Avinash <avinash.deedwaniya@gmail.com>
 */
class Music_Activator {

    /**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// Insert DB Tables
		Music_Activator::init_db_music_meta();
	}
	
	public static function init_db_music_meta() {

		// WP Globals
		global $table_prefix, $wpdb;

		// Customer Table
		$customerTable = $table_prefix . 'music_meta';
		 
		// Create Customer Table if not exist
		if( $wpdb->get_var( "show tables like '$customerTable'" ) != $customerTable ) {
			
			// Query - Create Table
			$sql = "CREATE TABLE `$customerTable` (";
			$sql .= " `meta_id` int(11) NOT NULL auto_increment, ";
			$sql .= " `music_id` varchar(255) NOT NULL, ";
			$sql .= " `meta_key` varchar(255) NOT NULL, ";
			$sql .= " `meta_value` varchar(255), ";
			$sql .= " PRIMARY KEY (`meta_id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;";

			// Include Upgrade Script
			require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		
			// Create Table
			dbDelta( $sql );
		} 
	}

}
