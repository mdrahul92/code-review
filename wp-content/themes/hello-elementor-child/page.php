<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package HelloElementor
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
	        <div class="col-lg-8 col-md-10">
	            <div class="section-heading">
	                <?php the_content(); ?>
	            </div>
	        </div>
	    </div>
	</div>
</section>

<?php
get_footer();
