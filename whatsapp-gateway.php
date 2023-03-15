<?php

/**
 * @wordpress-plugin
 * @lokuswp-integration
 *
 * Plugin Name:       ⚏ LokusWP - Whatsapp Gateway
 * Plugin URI:        lokuswp.id/plugins/lokuswp/whatsapp-gateway
 * Description:       Integrasi Notifikasi Whatsapp Gateway dengan LokusWP
 * Version:           0.2.4
 * Author:            LokusWP
 * Author URI:        https://lokuswp.id/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Languages:         id_ID
 */

// Checking Test Env and Direct Access File
if ( ! defined( 'WPTEST' ) ) {
	defined( 'ABSPATH' ) or die( "Direct access to files is prohibited" );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 * Define Constant
 */
defined( 'LOKUSWP_WA_GATEWAY_VERSION' ) or define( 'LOKUSWP_WA_GATEWAY_VERSION', '0.2.4' );
defined( 'LOKUSWP_WA_GATEWAY_REQUIRED_VERSION' ) or define( 'LOKUSWP_WA_GATEWAY_REQUIRED_VERSION', '0.2.0' );
defined( 'LOKUSWP_WA_GATEWAY_BASE' ) or define( 'LOKUSWP_WA_GATEWAY_BASE', plugin_basename( __FILE__ ) );
defined( 'LOKUSWP_WA_GATEWAY_PATH' ) or define( 'LOKUSWP_WA_GATEWAY_PATH', plugin_dir_path( __FILE__ ) );
defined( 'LOKUSWP_WA_GATEWAY_URI' ) or define( 'LOKUSWP_WA_GATEWAY_URI', plugin_dir_url( __FILE__ ) );

/**
 *-----------------------*
 * Minimum Requirement System
 * PHP : 7.4
 * WordPress : 5.9
 * LokusWP : 0.1.8
 *
 * @since 0.1.0
 *-----------------------*
 **/
$is_backbone_exist = file_exists( WP_PLUGIN_DIR . '/lokuswp/lokuswp.php' );
$backbone_version  = $is_backbone_exist ? get_file_data( WP_PLUGIN_DIR . '/lokuswp/lokuswp.php', array( 'Version' ), false )[0] : false;

if ( $is_backbone_exist && version_compare( $backbone_version, LOKUSWP_WA_GATEWAY_REQUIRED_VERSION, '<' ) ) {
	add_action( 'admin_notices', 'lwp_wa_gateway_fail_lokuswp_version' );
} else {
	// Come On, Let's Goo !!! 🦾
	if ( ! file_exists( LOKUSWP_WA_GATEWAY_PATH . '/src/autoload.php' ) ) {
		add_action( 'admin_notices', function () {
			$message      = sprintf( esc_html__( 'LokusWP WA_Gateway :: Nama folder slug anda tidak sesuai dengan nama slug plugin, pastikan nama folder plugin anda %s', 'lokuswp-wa_gateway' ), 'whatsapp-gateway/whatsapp-gateway.php' );
			$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
			echo wp_kses_post( $html_message );
		} );
	} else {

		// Run LokusWP WA_Gateway
		if ( in_array( 'lokuswp/lokuswp.php', (array) apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			require_once LOKUSWP_WA_GATEWAY_PATH . '/src/autoload.php';
		}
	}
}

/**
 * Admin notice for minimum LokusWP version.
 * Warning when the site doesn't have the minimum required LokusWP version.
 *
 * @return void
 * @since 0.1.0
 */
function lwp_wa_gateway_fail_lokuswp_version() {
	/* translators: %s: WordPress version */
	$message      = sprintf( esc_html__( '[Addon] Whatsapp Gateway active but not working. required LokusWP %s+ to be active', 'whatsapp-gateway' ), LOKUSWP_WA_GATEWAY_REQUIRED_VERSION );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	deactivate_plugins( WP_PLUGIN_DIR . '/lokuswp/lokuswp.php' );
	echo wp_kses_post( $html_message );
}