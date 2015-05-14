<?php

global $sc_getweather_version;
$sc_getweather_version = '1.0';

function sc_getweather_create() {
	global $wpdb;
	global $sc_getweather_version;

	$table_name = $wpdb->prefix . 'liveshoutbox';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS `city_weather` (
		  `city_slug` varchar(100) CHARACTER SET latin1 NOT NULL,
		  `search_for` varchar(100) CHARACTER SET latin1 NOT NULL,
		  `name_display` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
		  `temp_min` int(11) DEFAULT NULL,
		  `temp_max` int(11) DEFAULT NULL,
		  `observation_date` datetime DEFAULT NULL,
		  `icon_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
		  `current_temp` int(11) DEFAULT NULL,
		  `updated_at` datetime DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'sc_getweather_version', $sc_getweather_version );
}

function sc_getweather_insert() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'liveshoutbox';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
}

register_activation_hook( __FILE__, 'sc_getweather_create' );
register_activation_hook( __FILE__, 'sc_getweather_insert' );