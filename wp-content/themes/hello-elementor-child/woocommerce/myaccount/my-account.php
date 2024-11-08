<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
global $wp_query;

if ( is_account_page() ) {
	// Get the current WooCommerce endpoint slug (internal page slug)
	$current_endpoint = WC()->query->get_current_endpoint();
	$menu_items = wc_get_account_menu_items();

	if($current_endpoint == '' && isset($wp_query->query_vars['help'])){
		$current_endpoint = 'help';
	}

	if(isset($menu_items[$current_endpoint])){
		$breadcrumb = ' > '.$menu_items[$current_endpoint];
	}
}
?>
<div class="col-md-8 m-auto">
	<div class="account-setting">
	    <h1>
	    	<?php 
			$my_account_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); 
			if(isset($breadcrumb)){
	    	?>
	    	<a href="<?php echo esc_url( $my_account_url ); ?>" class="display-mobile my-account-back-button"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
				  <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2524 18.2092C12.9726 18.2092 12.6947 18.0874 12.5049 17.8517L7.87809 12.1017C7.59251 11.7462 7.59634 11.2382 7.88863 10.8875L12.6803 5.13749C13.0186 4.73115 13.6233 4.67653 14.0306 5.01482C14.4369 5.35311 14.4915 5.95782 14.1523 6.36415L9.86376 11.5114L13.999 16.6499C14.3305 17.062 14.2654 17.6658 13.8523 17.9974C13.676 18.1402 13.4633 18.2092 13.2524 18.2092Z" fill="#212121"/>
				</svg></a>
			<?php } ?>
		    Account Settings  
		    <span class="my-account-page-title display-mobile">
		    	<?php 
				if(isset($breadcrumb)){
			    	echo $breadcrumb;
			    }
				 ?>
		    </span>
		</h1>
	</div>
	<div class="main-wrapper-info ">
		<div class="row">
			<?php
			/**
			 * My Account navigation.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_navigation' ); 
			?>
			<div class="col-md-8">
				<div class="account-profile right-side-wrapper">
				    <div class="profile-form-wrapper">
				        <div class="address-wrapper">
							<div class="woocommerce-MyAccount-content">
								<?=payment_info_suggestion_html()?>
								<?php
									/**
									 * My Account content.
									 *
									 * @since 2.6.0
									 */
									do_action( 'woocommerce_account_content' );
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
