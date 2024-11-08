<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
?>
<!-- contant section -->
<section class="contant-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-heading">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                    <div class="col-lg-4 col-sm-6 col-sm-12">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="restaurant-thumbnail">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>
                            <h2><?php the_title(); ?></h2>
                        </a>
                    </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No restaurants found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php
get_footer();
