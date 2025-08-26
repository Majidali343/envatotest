<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'Neytri_Woo_Listing_Option_Content_Button_Element_Secondary_button' ) ) {

    class Neytri_Woo_Listing_Option_Content_Button_Element_Secondary_button extends Neytri_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-content-buttonelement-secondary-button';
            $this->option_name          = esc_html__('Button Element - Secondary Button', 'neytri');
            $this->option_type          = array ( 'html', 'value-css' );
            $this->option_default_value = '';
            $this->option_value_prefix  = '';

            $this->render_backend();

        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'neytri_woo_custom_product_template_content_options', array( $this, 'woo_custom_product_template_content_options'), 35, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_content_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'content';
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
                ''                   => esc_html__('None', 'neytri'),
                'cart'               => esc_html__('Cart', 'neytri'),
                'cart-with-quantity' => esc_html__('Cart With Quantity', 'neytri'),
                'wishlist'           => esc_html__('Wishlist', 'neytri'),
                'compare'            => esc_html__('Compare', 'neytri'),
                'quickview'          => esc_html__('Quick View', 'neytri')
            );
            $settings['default']    =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('neytri_woo_listing_option_content_buttonelement_secondary_button') ) {
	function neytri_woo_listing_option_content_buttonelement_secondary_button() {
		return Neytri_Woo_Listing_Option_Content_Button_Element_Secondary_button::instance();
	}
}

neytri_woo_listing_option_content_buttonelement_secondary_button();