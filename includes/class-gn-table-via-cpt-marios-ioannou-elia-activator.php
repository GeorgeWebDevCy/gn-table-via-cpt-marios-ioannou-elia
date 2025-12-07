<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.georgenicolaou.me
 * @since      1.0.0
 *
 * @package    Gn_Table_Via_Cpt_Marios_Ioannou_Elia
 * @subpackage Gn_Table_Via_Cpt_Marios_Ioannou_Elia/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Gn_Table_Via_Cpt_Marios_Ioannou_Elia
 * @subpackage Gn_Table_Via_Cpt_Marios_Ioannou_Elia/includes
 * @author     George Nicolaou <orionas.elite@gmail.com>
 */
class Gn_Table_Via_Cpt_Marios_Ioannou_Elia_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate( $plugin_basename ) {
		// Check for Advanced Custom Fields PRO
		if ( ! function_exists( 'acf_get_setting' ) || ! acf_get_setting( 'pro' ) ) {
			deactivate_plugins( $plugin_basename );
			wp_die( 'This plugin requires Advanced Custom Fields PRO to be installed and active.' );
		}
	}

}
