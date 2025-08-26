=== WooCommerce Key Redirect ===
Contributors: yourname
Tags: woocommerce, checkout, redirect, payment
Requires at least: 5.8
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds an admin page to store Public/Private keys and shows a button on the WooCommerce checkout that redirects to an external URL with those keys.

== Description ==

This plugin lets you configure:
- Public Key
- Private Key (warning: exposed client-side in current implementation)
- Redirect URL
- Button text
- Whether to include cart totals

It then renders a button on the WooCommerce Checkout page that links to your external URL with those query parameters.

== Installation ==

1. Upload the `wc-key-redirect` folder to `/wp-content/plugins/`.
2. Activate the plugin from **Plugins**.
3. Go to **Key Redirect** in the WP Admin menu.
4. Enter Public Key, Private Key, Redirect URL, and save.
5. Visit your WooCommerce checkout: you’ll see the custom button.

== Changelog ==
= 1.0.0 =
* Initial release
