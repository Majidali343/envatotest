<?php
/**
 * Plugin Name: WooCommerce Key Redirect
 * Plugin URI:  https://example.com/
 * Description: Adds a settings page for Public/Private keys and shows a custom button on WooCommerce checkout that redirects to an external URL with those keys.
 * Version:     1.0.0
 * Author:      Your Name
 * License:     GPLv2 or later
 * Text Domain: wc-key-redirect
 * Requires PHP: 7.4
 * Requires at least: 5.8
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WCKR_VERSION', '1.0.0' );
define( 'WCKR_PLUGIN_FILE', __FILE__ );
define( 'WCKR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WCKR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Activation: set defaults if not present.
 */
function wckr_activate() {
    $defaults = array(
        'public_key'       => '',
        'private_key'      => '',
        'redirect_url'     => '',
        'button_text'      => 'Pay via External Gateway',
        'enable_on_checkout' => 1,
        'include_totals'   => 1,
    );
    $existing = get_option( 'wckr_settings', array() );
    update_option( 'wckr_settings', wp_parse_args( $existing, $defaults ) );
}
register_activation_hook( __FILE__, 'wckr_activate' );

/**
 * Autoload simple classes.
 */
spl_autoload_register( function( $class ) {
    if ( strpos( $class, 'WCKR_' ) === 0 ) {
        $file = WCKR_PLUGIN_DIR . 'includes/' . 'class-' . strtolower( str_replace( '_', '-', $class ) ) . '.php';
        if ( file_exists( $file ) ) {
            require_once $file;
        }
    }
} );

/**
 * Bootstrap.
 */
add_action( 'plugins_loaded', function() {
    // Admin (settings page)
    if ( is_admin() ) {
        new WCKR_Admin();
    }
    // Frontend integrations (WooCommerce checkout button)
    new WCKR_Frontend();
} );

/**
 * Helper: get settings (always returns array).
 */
function wckr_get_settings() {
    $settings = get_option( 'wckr_settings', array() );
    $defaults = array(
        'public_key'       => '',
        'private_key'      => '',
        'redirect_url'     => '',
        'button_text'      => 'Pay via External Gateway',
        'enable_on_checkout' => 1,
        'include_totals'   => 1,
    );
    return wp_parse_args( $settings, $defaults );
}
