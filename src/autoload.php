<?php

namespace LokusWP\Notification\WA_Gateway;

class Boot {

	public function __construct() {
		// Activation and Deactivation
		register_activation_hook( LOKUSWP_WA_GATEWAY_BASE, [ $this, 'activate' ] );
		register_deactivation_hook( LOKUSWP_WA_GATEWAY_BASE, [ $this, 'deactivate' ] );

		if ( is_admin() ) {
			require_once dirname( __DIR__ ) . '/src/includes/plugin/updater.php';
		}

		// Only Load in Adminstration
		add_action( "lokuswp/wp-admin/settings", [ $this, "loaded" ] );
		add_action( "lwcommerce/wp-admin/settings", [ $this, "loaded" ] );
		add_action( "lwdonation/wp-admin/settings", [ $this, "loaded" ] );

		add_action( "lokuswp/notification/action", [ $this, "loaded" ] );
	}

	/**
	 * Load Activation Class when Plugin is Active
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function activate() {
		require_once LOKUSWP_WA_GATEWAY_PATH . 'src/includes/common/class-activation.php';
		Activation::activate();
	}

	/**
	 * Load Deactivation Class when Plugin is Active
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function deactivate() {
		require_once LOKUSWP_WA_GATEWAY_PATH . 'src/includes/common/class-deactivation.php';
		Deactivation::deactivate();
	}

	/**
	 * Load Notification Class
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function loaded() {

		require_once dirname( __DIR__ ) . '/src/includes/channel/class-whatsapp-dripsender.php';
		require_once dirname( __DIR__ ) . '/src/includes/channel/class-whatsapp-fonnte.php';
		require_once dirname( __DIR__ ) . '/src/includes/channel/class-whatsapp-onesender.php';
		require_once dirname( __DIR__ ) . '/src/includes/channel/class-whatsapp-starsender.php';
		require_once dirname( __DIR__ ) . '/src/includes/channel/class-whatsapp-wablas.php';

	}

}

new Boot();