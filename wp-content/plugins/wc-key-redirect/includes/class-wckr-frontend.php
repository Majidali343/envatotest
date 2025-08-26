<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WCKR_Frontend {

    public function __construct() {
        // Only add the button if WooCommerce is active.
        add_action( 'wp', array( $this, 'maybe_hook_checkout' ) );
        add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'render_product_button' ) );
    }

    public function render_product_button() {
    $s = wckr_get_settings();

    if ( empty( $s['redirect_url'] ) || empty( $s['public_key'] ) || empty( $s['private_key'] ) ) {
        return;
    }

    $params = array(
        'public_key'  => $s['public_key'],
        'private_key' => $s['private_key'],
        'site'        => home_url(),
    );

    global $product;
    if ( $product ) {
        $params['product_id'] = $product->get_id();
        $params['price']      = $product->get_price();
        $params['currency']   = get_woocommerce_currency();
    }

    $redirect_url = esc_url( add_query_arg( array_map( 'rawurlencode', $params ), $s['redirect_url'] ) );
    $button_text  = ! empty( $s['button_text'] ) ? $s['button_text'] : __( 'Pay via External Gateway', 'wc-key-redirect' );

    echo '<div class="wckr-product-btn" style="margin-top:10px;">';
    printf(
        '<a class="button alt" href="%1$s" target="_top" rel="noopener">%2$s</a>',
        $redirect_url,
        esc_html( $button_text )
    );
    echo '</div>';
}


    public function maybe_hook_checkout() {
        if ( ! class_exists( 'WooCommerce' ) ) {
            return;
        }
        $settings = wckr_get_settings();
        if ( is_checkout() && ! is_order_received_page() && ! is_wc_endpoint_url() && ! empty( $settings['enable_on_checkout'] ) ) {
            // Add the button below the "Place order" button area.
            add_action( 'woocommerce_review_order_after_submit', array( $this, 'render_checkout_button' ), 9 );
        }
    }

    public function render_checkout_button() {
        $s = wckr_get_settings();

        // Basic guard
        if ( empty( $s['redirect_url'] ) || empty( $s['public_key'] ) || empty( $s['private_key'] ) ) {
            echo '<p style="margin-top:10px;color:#b32d2e;">' . esc_html__( 'Key Redirect button is not available: plugin settings incomplete.', 'wc-key-redirect' ) . '</p>';
            return;
        }

        // Build query params
        $params = array(
            'public_key'  => $s['public_key'],
            'private_key' => $s['private_key'], // NOTE: This exposes the private key client-side. Consider server-side signing for production security.
            'site'        => home_url(),
        );

        if ( ! empty( $s['include_totals'] ) && function_exists( 'WC' ) && WC()->cart ) {
            $currency = get_woocommerce_currency();
            $total    = WC()->cart->get_total( 'edit' ); // numeric string
            $params['amount']   = $total;
            $params['currency'] = $currency;
        }

        $redirect_url = esc_url( add_query_arg( array_map( 'rawurlencode', $params ), $s['redirect_url'] ) );

        $button_text = ! empty( $s['button_text'] ) ? $s['button_text'] : __( 'Pay via External Gateway', 'wc-key-redirect' );

        // Output a safe button. Use target="_top" to ensure it replaces the checkout page.
        echo '<div class="wckr-wrapper" style="margin-top:14px;">';
        printf(
            '<a class="button alt" href="%1$s" target="_top" rel="noopener">%2$s</a>',
            $redirect_url,
            esc_html( $button_text )
        );
        echo '</div>';
    }
}
