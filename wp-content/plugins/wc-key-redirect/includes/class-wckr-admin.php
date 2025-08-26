<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WCKR_Admin {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'menu' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );
    }

    public function menu() {
        add_menu_page(
            __( 'Key Redirect', 'wc-key-redirect' ),
            __( 'Key Redirect', 'wc-key-redirect' ),
            'manage_options',
            'wckr-settings',
            array( $this, 'render_page' ),
            'dashicons-shield-alt',
            56
        );
    }

    public function assets( $hook ) {
        if ( $hook === 'toplevel_page_wckr-settings' ) {
            wp_enqueue_style( 'wckr-admin', WCKR_PLUGIN_URL . 'assets/css/admin.css', array(), WCKR_VERSION );
        }
    }

    public function register_settings() {
        register_setting(
            'wckr_settings_group',
            'wckr_settings',
            array( $this, 'sanitize' )
        );

        add_settings_section(
            'wckr_main',
            __( 'External Redirect Configuration', 'wc-key-redirect' ),
            function() {
                echo '<p>' . esc_html__( 'Set the keys and target URL used by the checkout button.', 'wc-key-redirect' ) . '</p>';
            },
            'wckr-settings'
        );

        add_settings_field(
            'public_key',
            __( 'Public Key', 'wc-key-redirect' ),
            array( $this, 'field_public_key' ),
            'wckr-settings',
            'wckr_main'
        );

        add_settings_field(
            'private_key',
            __( 'Private Key', 'wc-key-redirect' ),
            array( $this, 'field_private_key' ),
            'wckr-settings',
            'wckr_main'
        );

        add_settings_field(
            'redirect_url',
            __( 'Redirect URL', 'wc-key-redirect' ),
            array( $this, 'field_redirect_url' ),
            'wckr-settings',
            'wckr_main'
        );

        add_settings_field(
            'button_text',
            __( 'Button Text', 'wc-key-redirect' ),
            array( $this, 'field_button_text' ),
            'wckr-settings',
            'wckr_main'
        );

        add_settings_field(
            'enable_on_checkout',
            __( 'Enable on Checkout', 'wc-key-redirect' ),
            array( $this, 'field_enable_on_checkout' ),
            'wckr-settings',
            'wckr_main'
        );

        add_settings_field(
            'include_totals',
            __( 'Include Cart Totals in Redirect', 'wc-key-redirect' ),
            array( $this, 'field_include_totals' ),
            'wckr-settings',
            'wckr_main'
        );
    }

    public function sanitize( $input ) {
        $out = array();
        $out['public_key']         = isset( $input['public_key'] ) ? sanitize_text_field( $input['public_key'] ) : '';
        $out['private_key']        = isset( $input['private_key'] ) ? sanitize_text_field( $input['private_key'] ) : '';
        $out['redirect_url']       = isset( $input['redirect_url'] ) ? esc_url_raw( $input['redirect_url'] ) : '';
        $out['button_text']        = isset( $input['button_text'] ) ? sanitize_text_field( $input['button_text'] ) : 'Pay via External Gateway';
        $out['enable_on_checkout'] = ! empty( $input['enable_on_checkout'] ) ? 1 : 0;
        $out['include_totals']     = ! empty( $input['include_totals'] ) ? 1 : 0;
        return $out;
    }

    public function render_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        $settings = wckr_get_settings();
        ?>
        <div class="wrap wckr-wrap">
            <h1><?php esc_html_e( 'WooCommerce Key Redirect', 'wc-key-redirect' ); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'wckr_settings_group' );
                do_settings_sections( 'wckr-settings' );
                submit_button( __( 'Save Settings', 'wc-key-redirect' ) );
                ?>
            </form>
            <hr />
            <p><strong><?php esc_html_e( 'Tip:', 'wc-key-redirect' ); ?></strong>
            <?php esc_html_e( 'If the button is not visible, ensure WooCommerce is active and you are viewing the checkout page.', 'wc-key-redirect' ); ?></p>
        </div>
        <?php
    }

    public function field_public_key() {
        $v = wckr_get_settings()['public_key'];
        printf(
            '<input type="text" class="regular-text" name="wckr_settings[public_key]" value="%s" placeholder="pk_live_..." />',
            esc_attr( $v )
        );
    }

    public function field_private_key() {
        $v = wckr_get_settings()['private_key'];
        printf(
            '<input type="password" class="regular-text" name="wckr_settings[private_key]" value="%s" placeholder="sk_live_..." />',
            esc_attr( $v )
        );
        echo '<p class="description">' . esc_html__( 'Stored in WordPress options. Treat as sensitive.', 'wc-key-redirect' ) . '</p>';
    }

    public function field_redirect_url() {
        $v = wckr_get_settings()['redirect_url'];
        printf(
            '<input type="url" class="regular-text" name="wckr_settings[redirect_url]" value="%s" placeholder="https://gateway.example.com/checkout" />',
            esc_attr( $v )
        );
    }

    public function field_button_text() {
        $v = wckr_get_settings()['button_text'];
        printf(
            '<input type="text" class="regular-text" name="wckr_settings[button_text]" value="%s" placeholder="Pay via External Gateway" />',
            esc_attr( $v )
        );
    }

    public function field_enable_on_checkout() {
        $v = (int) wckr_get_settings()['enable_on_checkout'];
        printf(
            '<label><input type="checkbox" name="wckr_settings[enable_on_checkout]" value="1" %s /> %s</label>',
            checked( 1, $v, false ),
            esc_html__( 'Show the button on the WooCommerce checkout page', 'wc-key-redirect' )
        );
    }

    public function field_include_totals() {
        $v = (int) wckr_get_settings()['include_totals'];
        printf(
            '<label><input type="checkbox" name="wckr_settings[include_totals]" value="1" %s /> %s</label>',
            checked( 1, $v, false ),
            esc_html__( 'Append cart totals (amount, currency) as query params', 'wc-key-redirect' )
        );
    }
}
