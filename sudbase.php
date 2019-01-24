<?php

global $sur_db_version;
$sur_db_version = '1.0';

function sur_install() {
	global $wpdb;
	global $sur_db_version;

	$table_name = $wpdb->prefix . 'contactUs';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTOINCREMENT,
		name varchar(40) NOT NULL,
		email varchar(40) NOT NULL,
		subject varchar(100) NOT NULL,
		message varchar(1000) NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'sur_db_version', $sur_db_version );
}






?>