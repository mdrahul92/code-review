<?php
/* Template Name: No Delivery Page Template */
get_header();
$banner_title = get_field('banner_title');
$banner_content = get_field('banner_content');
$banner_image = get_field('banner_image');
?>
<section class="delivery-section" style="background: url(<?php echo $banner_image['url'] ?>) no-repeat center center; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-10 m-auto">
                <div class="address-bg-txt">
                    <h2 class="address-bg-heading"><?php echo $banner_title ?></h2>
                    <p class="address-bg-para"><?php echo $banner_content ?></p>
                </div>
                <div class="address-form-wrapper">
                    <div class="address-form-inner">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>