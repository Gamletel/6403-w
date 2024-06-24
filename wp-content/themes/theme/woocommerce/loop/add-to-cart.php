<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M2.5 2.5H2.72362C3.11844 2.5 3.31602 2.5 3.47705 2.57123C3.61903 2.63403 3.74059 2.73525 3.82813 2.86346C3.92741 3.00889 3.96315 3.20305 4.03483 3.59131L5.83337 13.3334L14.5162 13.3333C14.895 13.3333 15.0847 13.3333 15.2413 13.2665C15.3795 13.2076 15.4991 13.1123 15.5876 12.9909C15.6879 12.8533 15.7303 12.6688 15.8154 12.2998L17.1231 6.6331C17.2519 6.0752 17.3163 5.79634 17.2455 5.57719C17.1835 5.38505 17.0533 5.22195 16.88 5.11827C16.6824 5 16.3965 5 15.8239 5H4.58333M15 17.5C14.5398 17.5 14.1667 17.1269 14.1667 16.6667C14.1667 16.2064 14.5398 15.8333 15 15.8333C15.4602 15.8333 15.8333 16.2064 15.8333 16.6667C15.8333 17.1269 15.4602 17.5 15 17.5ZM6.66667 17.5C6.20643 17.5 5.83333 17.1269 5.83333 16.6667C5.83333 16.2064 6.20643 15.8333 6.66667 15.8333C7.1269 15.8333 7.5 16.2064 7.5 16.6667C7.5 17.1269 7.1269 17.5 6.66667 17.5Z" stroke="#00BAD4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
//		esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
);
