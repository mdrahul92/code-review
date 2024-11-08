<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<p><strong>Previous Orders</strong></p>
<?php if ( $has_orders ) : ?>

<div class="order-wrapper">
    <div class="row gap-4 align-items-center">
			<?php
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				// echo "<pre>";
				// print_r($order);
				// echo "</pre>";
            	$order_id = $order->get_id();
            	$order_date = $order->get_date_created();
            	$order_item_total = $item_count;
            	$order_price = $order->get_formatted_order_total();
            	$order_first_product = get_first_product_from_order( $order ); // we will get only first product name and image.
				?>
				<div class="col-12">
	                <div class="order-info account-order">
						<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
	                        <div class="order-img">
	                            <!-- <img src="./images/delicious.png" alt="food"> -->
	                            <?php echo $order_first_product['thumbnail']; ?>
	                        </div>
	                        <div class="order-data">
	                            <h3><?php echo $order_first_product['name']; ?></h3>
	                            <p><?php echo $order_date->format('M d')?> | <?php echo $order_item_total ?> items | <?php echo $order_date->format('h:i A') ?></p>
	                        </div>
		            	</a>
                        <div class="order-price">
                            <h6><?php echo $order_price ?></h6>
                            <?php
							$actions = wc_get_account_orders_actions( $order );

							if ( ! empty( $actions ) ) {
								foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
									echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button' . esc_attr( $wp_button_class ) . ' button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
								}
							}
							?>
                        </div>
	                </div>
	            </div>
	        <?php } ?>
	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button<?php echo esc_attr( $wp_button_class ); ?>" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button<?php echo esc_attr( $wp_button_class ); ?>" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	</div>
</div>
<?php else : ?>

	<?php wc_print_notice( esc_html__( 'No order has been made yet.', 'woocommerce' )) //. ' <a class="woocommerce-Button wc-forward button' . esc_attr( $wp_button_class ) . '" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . esc_html__( 'Browse products', 'woocommerce' ) . '</a>', 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
