<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$vendor_items_count = array();

// Loop through each item in the cart
foreach ( WC()->cart->get_cart() as $cart_item ) {
    // Get the product ID
    $product_id = $cart_item['product_id'];
    
    // Get the vendor ID (replace with your actual method to retrieve the vendor)
    $vendor_id = get_post_meta( $product_id, '_vendor_id', true ); // Adjust this line as needed
    
    // Initialize count for this vendor if it doesn't exist
    if ( ! isset( $vendor_items_count[ $vendor_id ] ) ) {
        $vendor_items_count[ $vendor_id ] = 0;
    }

    // Increase count for this vendor
    $vendor_items_count[ $vendor_id ] += $cart_item['quantity'];
}

$cart_threshold_value = get_option('cart_threshold_value');
$checkout_button_view = true;
// Check if any vendor has less than 4 items
foreach ( $vendor_items_count as $vendor_id => $item_count ) {
    if ( $item_count < $cart_threshold_value ) {
    	$checkout_button_view = false;
    }
}

if($checkout_button_view){
?>
<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
	<?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
</a>
<?php } ?>
