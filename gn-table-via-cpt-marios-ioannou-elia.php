<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.georgenicolaou.me
 * @since             1.0.0
 * @package           Gn_Table_Via_Cpt_Marios_Ioannou_Elia
 *
 * @wordpress-plugin
 * Plugin Name:       GN Table Via CPT For Marios Ioannou Ellia
 * Plugin URI:        https://www.georgenicolaou.me/plugins/gn-table-via-cpt-marios-ioannou-elia/
 * Description:       Generates a table based on a specific CPT for this use case
 * Version:           1.0.6
 * Author:            George Nicolaou
 * Author URI:        https://www.georgenicolaou.me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gn-table-via-cpt-marios-ioannou-elia
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GN_TABLE_VIA_CPT_MARIOS_IOANNOU_ELIA_VERSION', '1.0.6' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gn-table-via-cpt-marios-ioannou-elia-activator.php
 */
function activate_gn_table_via_cpt_marios_ioannou_elia() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gn-table-via-cpt-marios-ioannou-elia-activator.php';
	Gn_Table_Via_Cpt_Marios_Ioannou_Elia_Activator::activate( plugin_basename( __FILE__ ) );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gn-table-via-cpt-marios-ioannou-elia-deactivator.php
 */
function deactivate_gn_table_via_cpt_marios_ioannou_elia() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gn-table-via-cpt-marios-ioannou-elia-deactivator.php';
	Gn_Table_Via_Cpt_Marios_Ioannou_Elia_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gn_table_via_cpt_marios_ioannou_elia' );
register_deactivation_hook( __FILE__, 'deactivate_gn_table_via_cpt_marios_ioannou_elia' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gn-table-via-cpt-marios-ioannou-elia.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gn_table_via_cpt_marios_ioannou_elia() {

	$plugin = new Gn_Table_Via_Cpt_Marios_Ioannou_Elia();
	$plugin->run();

}
run_gn_table_via_cpt_marios_ioannou_elia();

/**
 * Initialize Plugin Update Checker
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php' ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
	
	try {
		$myUpdateChecker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
			'https://github.com/GeorgeWebDevCy/gn-table-via-cpt-marios-ioannou-elia',
			__FILE__,
			'gn-table-via-cpt-marios-ioannou-elia'
		);
	
		//Set the branch that contains the stable release.
		$myUpdateChecker->setBranch('main');
	} catch (Exception $e) {
		// Fail silently if PUC cannot be initialized
	}
}
