<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'Neytri_Shop_Metabox_Single_Upsell_Related' ) ) {
    class Neytri_Shop_Metabox_Single_Upsell_Related {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

			add_filter( 'neytri_shop_product_custom_settings', array( $this, 'neytri_shop_product_custom_settings' ), 10 );

		}

        function neytri_shop_product_custom_settings( $options ) {

			$ct_dependency      = array ();
			$upsell_dependency  = array ( 'show-upsell', '==', 'true');
			$related_dependency = array ( 'show-related', '==', 'true');
			if( function_exists('neytri_shop_single_module_custom_template') ) {
				$ct_dependency['dependency'] 	= array ( 'product-template', '!=', 'custom-template');
				$upsell_dependency 				= array ( 'product-template|show-upsell', '!=|==', 'custom-template|true');
				$related_dependency 			= array ( 'product-template|show-related', '!=|==', 'custom-template|true');
			}

			$product_options = array (

				array_merge (
					array(
						'id'         => 'show-upsell',
						'type'       => 'select',
						'title'      => esc_html__('Show Upsell Products', 'neytri'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-upsell' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'neytri' ),
							'true'         => esc_html__( 'Show', 'neytri'),
							null           => esc_html__( 'Hide', 'neytri'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'upsell-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Column', 'neytri'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'neytri' ),
						1              => esc_html__( 'One Column', 'neytri' ),
						2              => esc_html__( 'Two Columns', 'neytri' ),
						3              => esc_html__( 'Three Columns', 'neytri' ),
						4              => esc_html__( 'Four Columns', 'neytri' ),
					),
					'dependency' => $upsell_dependency
				),

				array(
					'id'         => 'upsell-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Limit', 'neytri'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'neytri' ),
						1              => esc_html__( 'One', 'neytri' ),
						2              => esc_html__( 'Two', 'neytri' ),
						3              => esc_html__( 'Three', 'neytri' ),
						4              => esc_html__( 'Four', 'neytri' ),
						5              => esc_html__( 'Five', 'neytri' ),
						6              => esc_html__( 'Six', 'neytri' ),
						7              => esc_html__( 'Seven', 'neytri' ),
						8              => esc_html__( 'Eight', 'neytri' ),
						9              => esc_html__( 'Nine', 'neytri' ),
						10              => esc_html__( 'Ten', 'neytri' ),
					),
					'dependency' => $upsell_dependency
				),

				array_merge (
					array(
						'id'         => 'show-related',
						'type'       => 'select',
						'title'      => esc_html__('Show Related Products', 'neytri'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-related' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'neytri' ),
							'true'         => esc_html__( 'Show', 'neytri'),
							null           => esc_html__( 'Hide', 'neytri'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'related-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Column', 'neytri'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'neytri' ),
						2              => esc_html__( 'Two Columns', 'neytri' ),
						3              => esc_html__( 'Three Columns', 'neytri' ),
						4              => esc_html__( 'Four Columns', 'neytri' ),
					),
					'dependency' => $related_dependency
				),

				array(
					'id'         => 'related-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Limit', 'neytri'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'neytri' ),
						1              => esc_html__( 'One', 'neytri' ),
						2              => esc_html__( 'Two', 'neytri' ),
						3              => esc_html__( 'Three', 'neytri' ),
						4              => esc_html__( 'Four', 'neytri' ),
						5              => esc_html__( 'Five', 'neytri' ),
						6              => esc_html__( 'Six', 'neytri' ),
						7              => esc_html__( 'Seven', 'neytri' ),
						8              => esc_html__( 'Eight', 'neytri' ),
						9              => esc_html__( 'Nine', 'neytri' ),
						10              => esc_html__( 'Ten', 'neytri' ),
					),
					'dependency' => $related_dependency
				)

			);

			$options = array_merge( $options, $product_options );

			return $options;

		}

    }
}

Neytri_Shop_Metabox_Single_Upsell_Related::instance();