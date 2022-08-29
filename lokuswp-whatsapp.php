<?php

/**
 * @wordpress-plugin
 * @lokuswp-integration
 *
 * Plugin Name:       🪝️ LokusWP - Whatsapp Gateway
 * Plugin URI:        lokuswp.id/plugins/lokuswp/whatsapp-gateway
 * Description:       Kirim Notifikasi via Whatsapp dengan Gateway yang kamu suka
 * Version:           0.1.0
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
defined( 'LOKUSWP_WA_GATEWAY_VERSION' ) or define( 'LOKUSWP_WA_GATEWAY_VERSION', '0.1.0' );
defined( 'LOKUSWP_WA_GATEWAY_BASE' ) or define( 'LOKUSWP_WA_GATEWAY_BASE', plugin_basename( __FILE__ ) );
defined( 'LOKUSWP_WA_GATEWAY_PATH' ) or define( 'LOKUSWP_WA_GATEWAY_PATH', plugin_dir_path( __FILE__ ) );
defined( 'LOKUSWP_WA_GATEWAY_URI' ) or define( 'LOKUSWP_WA_GATEWAY_URI', plugin_dir_url( __FILE__ ) );

/**
 * Dependency Backbone Checking
 *
 * @return void
 */
function lwp_wa_gateway_dependency() {
	$lwp_active  = true;
	$lwp_version = true;

	// is LokusWP Active ??
	if ( is_admin() && current_user_can( 'activate_plugins' ) && ! is_plugin_active( 'lokuswp/lokuswp.php' ) ) {

		add_action( 'admin_notices', function () {
			echo '<div class="error"><p>' . __( 'LokusWP required. please activate plugin first.', 'lokuswp-wa_gateway' ) . '</p></div>';
		} );

		$lwp_active = false;
	}

	// Checking LokusWP Version to Run this Plugin
	$lwp_version = get_plugin_data( dirname( dirname( __FILE__ ) ) . '/lokuswp/lokuswp.php' );
	$lwp_version = $lwp_version['Version'] ?? false;
	if ( ! version_compare( LOKUSWP_WA_GATEWAY_VERSION, $lwp_version, '<' ) ) {

		add_action( 'admin_notices', function () use ( $lwp_version ) {
			$message      = sprintf( esc_html__( 'LokusWP WA_Gateway anda tidak kompatibel dengan versi LokusWP Backbone saat ini, silahkan gunakan LokusWP WA_Gateway v%s atau dibawahnya', 'lokuswp-wa_gateway' ),
				$lwp_version );
			$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
			echo wp_kses_post( $html_message );
		} );

		$lwp_version = false;
	}

	// When not Right -> Deactivate Extension
	if ( ! $lwp_version || ! $lwp_active ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}
}

add_action( 'admin_init', 'lwp_wa_gateway_dependency' );

// Checking : Slug Folder match with Plugin SLug
// Comment this if you want to test directly on your localhost, Uncomment for Production Ready
if ( ! file_exists( LOKUSWP_WA_GATEWAY_PATH . '/src/autoload.php' ) ) {
	add_action( 'admin_notices', function () {
		$message      = sprintf( esc_html__( 'LokusWP WA_Gateway :: Nama folder slug anda tidak sesuai dengan nama slug plugin, harap ganti nama folder plugin anda dengan %s', 'lokuswp-wa_gateway' ), 'lokuswp-wa_gateway' );
		$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
		echo wp_kses_post( $html_message );
	} );
} else {

	// Run LokusWP WA_Gateway
	if ( in_array( 'lokuswp/lokuswp.php', (array) apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		require_once LOKUSWP_WA_GATEWAY_PATH . '/src/autoload.php';
	}
}