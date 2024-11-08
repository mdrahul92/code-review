<?php
/**
 * Template Name: Checkout page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<!-- contant section -->
<section class="contant-section">
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-lg-10 col-md-10">
	            <div class="section-heading">
	                <?php the_content(); ?>
	            </div>
	        </div>
	    </div>
	</div>
</section>

<?php
get_footer();
