<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package Neytri WordPress theme
 */

function neytri_tgmpa_plugins_register() {


 
	// Get array of recommended plugins.
	$plugins_list = array(
        array(
            'name'               => esc_html__('Neytri Plus', 'neytri'),
            'slug'               => 'neytri-plus',
            'source'             => NEYTRI_MODULE_DIR . '/plugins/neytri-plus.zip',
            'required'           => true,
            'version'            => '1.0.6',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('Neytri Pro', 'neytri'),
            'slug'               => 'neytri-pro',
            'source'             => NEYTRI_MODULE_DIR . '/plugins/neytri-pro.zip',
            'required'           => true,
            'version'            => '1.0.4',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Elementor', 'neytri'),
            'slug'     => 'elementor',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Elementor Addon', 'neytri'),
            'slug'               => 'wedesigntech-elementor-addon',
            'source'             => NEYTRI_MODULE_DIR . '/plugins/wedesigntech-elementor-addon.zip',
            'required'           => true,
            'version'            => '1.0.6',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('WooCommerce', 'neytri'),
            'slug'     => 'woocommerce',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('Neytri Shop', 'neytri'),
            'slug'               => 'neytri-shop',
            'source'             => NEYTRI_MODULE_DIR . '/plugins/neytri-shop.zip',
            'required'           => false,
            'version'            => '1.0.2',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Variation Swatches for WooCommerce', 'neytri'),
            'slug'     => 'woo-variation-swatches',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Wishlist', 'neytri'),
            'slug'     => 'yith-woocommerce-wishlist',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Compare', 'neytri'),
            'slug'     => 'yith-woocommerce-compare',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Quick View', 'neytri'),
            'slug'     => 'yith-woocommerce-quick-view',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('Contact Form 7', 'neytri'),
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('Currency Switcher Professional for WooCommerce', 'neytri'),
            'slug'     => 'woocommerce-currency-switcher',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('One click Demo Import', 'neytri'),
            'slug'     => 'one-click-demo-import',
            'required' => true,
        ),
	);

    $plugins = apply_filters('neytri_required_plugins_list',$plugins_list);

	
  

	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'neytri_theme',
		'domain'       => 'neytri',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );

}
add_action( 'tgmpa_register', 'neytri_tgmpa_plugins_register' );