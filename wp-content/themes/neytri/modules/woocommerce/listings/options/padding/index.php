<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'Neytri_Woo_Listing_Option_Padding' ) ) {

    class Neytri_Woo_Listing_Option_Padding extends Neytri_Woo_Listing_Option_Core {

        private static $_instance = null;

        public $option_slug;

        public $option_name;

        public $option_type;

        public $option_default_value;

        public $option_value_prefix;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

            $this->option_slug          = 'product-padding';
            $this->option_name          = esc_html__('Padding', 'neytri');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = 'product-padding-default';
            $this->option_value_prefix  = 'product-padding-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'neytri_woo_custom_product_template_common_options', array( $this, 'woo_custom_product_template_common_options'), 20, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_common_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'common';
        }

        /**
         * Setting Args
         */
        function setting_args() {
            $settings            =  array ();
            $settings['id']      =  $this->option_slug;
            $settings['type']    =  'select';
            $settings['title']   =  $this->option_name;
            $settings['options'] =  array (
                'product-padding-default' => esc_html__('Default', 'neytri'),
                'product-padding-overall' => esc_html__('Product', 'neytri'),
                'product-padding-thumb'   => esc_html__('Thumb', 'neytri'),
                'product-padding-content' => esc_html__('Content', 'neytri'),
            );
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('neytri_woo_listing_option_padding') ) {
	function neytri_woo_listing_option_padding() {
		return Neytri_Woo_Listing_Option_Padding::instance();
	}
}

neytri_woo_listing_option_padding();