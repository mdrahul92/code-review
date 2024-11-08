<?php
/**
 * Template Name: My Account Page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! is_user_logged_in() ) {
    wp_redirect( "/login" );
    die;
}
get_header();
?>
<section class="main-wrapper">
        <div class="container">
             <div class="row">
            	<?php the_content(); ?>
            </div>
        </div>       
</section>

<?php
get_footer();
