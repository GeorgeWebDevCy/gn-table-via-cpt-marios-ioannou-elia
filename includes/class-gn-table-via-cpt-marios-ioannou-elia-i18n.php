<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.georgenicolaou.me
 * @since      1.0.0
 *
 * @package    Gn_Table_Via_Cpt_Marios_Ioannou_Elia
 * @subpackage Gn_Table_Via_Cpt_Marios_Ioannou_Elia/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Gn_Table_Via_Cpt_Marios_Ioannou_Elia
 * @subpackage Gn_Table_Via_Cpt_Marios_Ioannou_Elia/includes
 * @author     George Nicolaou <orionas.elite@gmail.com>
 */
class Gn_Table_Via_Cpt_Marios_Ioannou_Elia_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'gn-table-via-cpt-marios-ioannou-elia',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
