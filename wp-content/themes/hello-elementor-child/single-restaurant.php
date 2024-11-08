<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
@session_start(); 
get_header(); 

if (have_posts()) : 
while (have_posts()) : the_post(); 
$restaurant_page_banner = get_field('restaurant_page_banner');
$restaurant_location_data = '';

$restaurant_location = get_field('restaurant_location');
if (!empty($restaurant_location)) {
    $restaurant_location_data = $restaurant_location;
}

$restaurant_signature_plates = get_specific_restaurant_signature_plates(get_the_ID());
$restaurant_post_id = get_the_ID();

// $cheif = get_field('cheif');
// $cheif_photo = $cheif['photo'];
// $cheif_name = $cheif['name'];
?>
<!-- restaurant banner section -->
<div class="restaurant-banner-main-section">
    <div class="restaurant-banner-section" >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="restaurant-banner-child-section" style="background: url(<?php echo $restaurant_page_banner['url'] ?>) no-repeat center center; background-size: cover;">
                        <a class="window-back-custom" href="javascript:history.back();">
                            <?php echo back_custom_icon_svg();?>
                        </a>
                        <a href="javascript:void(0)" class="custom-sharing" id="CustomSharePage"tabindex="0">
                            <?=mobile_share_icon_svg()?>
                        </a>
                    </div>
                    <!-- <div class="res-banner-contant">

                        <div class="banner-card">
                            <div class="tag-card">
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- restaurant product section -->


<section class="restaurant product-section custom-prod-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 cuisne-tags-info">
            <?php 
                $tags = get_the_terms(get_the_ID(), 'tag');
                
                if ($tags && !is_wp_error($tags)) :
                    $tag_count = count($tags);
                    $i = 0;
                    
                    foreach ($tags as $tag) {
                        echo '<span class="cusine-tags">' . esc_html($tag->name) . '</span>';
                        
                        // Add a comma after each tag except the last one
                        if (++$i < $tag_count) {
                            echo ', ';
                        }
                    }
                endif;
            ?>
            </div>

            <div class="col-md-12 single-restr-information">
                <div class="restra-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="restra-addr-info">
                    <?php foreach (get_restra_addr_info($restaurant_post_id) as $key => $rest_addr_info): ?>
                        <?php if ($key === 'restaurant_location' && !empty($rest_addr_info)): ?>
                            <span class="rest_addr_info_address"><?= esc_html($rest_addr_info); ?></span>
                        <?php endif; ?>

                        <?php if ($key === 'restaurant_phone_number' && !empty($rest_addr_info)): ?>
                            <span class="rest_addr_info_address">
                                <span class="restr_add_info_bull">&#8226;</span>
                                <?= esc_html($rest_addr_info); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($key === 'restaurant_website_url' && !empty($rest_addr_info)): ?>
                            <span class="rest_addr_info_address">
                                <span class="restr_add_info_bull">&#8226;</span>
                                <?= $rest_addr_info; // Already contains HTML, no need for escaping ?>
                            </span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="col-md-6">
                <?php 
                    $products_grouped_by_signature_plate = get_products_grouped_by_signature_plate($restaurant_post_id);
                    if(count($products_grouped_by_signature_plate)):?>

                    <?php $first_loop = true; foreach($products_grouped_by_signature_plate as $plate_key=>$plate_wise_product): // Loop through plates?>
                    <div class="address-wrapper <?php echo $first_loop ? '' : ' customized-adress-wrapper'; ?>">
                        <?php
                            $first_loop = false; // Set the flag to false after the first iteration
                        ?>
                        <h2 class="order-heading"><?=$plate_key?></h2>
                        <div class="order-wrapper">
                            <div class="row gap-3 align-items-center">
                                
                                <?php foreach ($plate_wise_product as $product): // Loop through each product ?>
                                <div class="col-12">
                                    <div class="order-info">
                                        <div class="order-img">
                                            <a href="javascript:void(0)" data-product-id="<?php echo esc_attr($product['product_post_data']->ID); ?>" class="quick-view">
                                                <?php 
                                                // Check if the product has a thumbnail
                                                if (has_post_thumbnail($product['product_post_data']->ID)) {
                                                    echo wp_get_attachment_image(get_post_thumbnail_id($product['product_post_data']->ID), 'woocommerce_thumbnail');
                                                } else {
                                                    echo '<img src="' . esc_url(wc_placeholder_img_src()) . '" alt="' . esc_attr__('Placeholder', 'woocommerce') . '" />'; 
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <a href="javascript:void(0)" data-product-id="<?php echo esc_attr($product['product_post_data']->ID); ?>" class="quick-view">
                                            <div class="order-data">
                                                <h3><?php echo esc_html($product['product_post_data']->post_title); ?></h3>
                                                <?php echo apply_filters('the_excerpt', $product['product_post_data']->post_excerpt);  // Get description safely ?>
                                            </div>
                                        </a>
                                        <div class="order-price">
                                            <h6><?php echo  wc_price($product['prod_information']['price']) ?></h6>
                                            <?php if ( ($product['prod_information']['is_purchasable']==1) && ($product['prod_information']['is_in_stock']==1) ):?>
                                               <?php echo '<a href="' . esc_url( $product['prod_information']['add_to_cart_url'] ) . '" class=" ajax_add_to_cart btn add-to-cart" data-product_id="' . esc_attr( $product['product_post_data']->ID ) . '" data-product_sku="' . esc_attr( $product['prod_information']['sku'] ) . '" aria-label="' . esc_attr( $product['prod_information']['add_to_cart_description'] ) . '" rel="nofollow">' . esc_html( $product['prod_information']['add_to_cart_text'] ) . '</a>'; ?>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>

                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="col-md-6">
                <div class="empty-product-view-outer">
                    <div class="empty-product-view display-desktop">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/mdi_food.png ?>" />
                        <p>Select an Item to Start!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>

<?php endwhile; ?>
<?php else : ?>
    <p>Selected restaurant not found.</p>
<?php endif; ?>


<script>
    jQuery(document).ready(function($) {
        <?php if(isset($_GET['p_id']) && $_GET['p_id'] != ''){ ?>
            if ($(window).width() < 768) {
                $('body').addClass('overflow_hidden');
            }
        $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'woocommerce_quick_view',
                    product_id: <?php echo $_GET['p_id']; ?>,
                    screen: ($(window).width() < 768) ? 'mobile' : 'desktop' // Corrected conditional logic
                },
                success: function(response) {
                    $('.empty-product-view-outer').html(response);
                    var qty = 1;
                }
            });
        <?php } ?>
        $('.quick-view').on('click', function() {
            var productId = $(this).data('product-id');
            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'woocommerce_quick_view',
                    product_id: productId,
                    screen: ($(window).width() < 768) ? 'mobile' : 'desktop' // Corrected conditional logic
                },
                success: function(response) {
                    if ($(window).width() < 768) {
                        let rhtml = response
                        $('body').addClass('overflow_hidden');
                        $('.empty-product-view-outer').html(rhtml);
                    }
                    else{
                        $('.empty-product-view-outer').html(response);
                    }

                    var qty = 1;
                }
            });
        });

        $(document).on('click','.close-product',function(e){
            e.preventDefault();
            $('body').removeClass('overflow_hidden');
            if(jQuery(window).width()<=768)
            {
                if($('.empty-product-view-outer').find('.dish-wrapper').length)
                {
                    $('.empty-product-view-outer').find('.dish-wrapper').css('top','100%')
                }
                else{
                    $('.empty-product-view-outer').html('');
                }

            }
            else{
                $('.empty-product-view-outer').html('');
            }
        });
    });

</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Increment and Decrement quantity buttons
        $(document).on('click', '.cart .number .plus', function() {
            var qty = $(document).find('form.cart .quantity');
            var currentVal = parseInt(qty.val());
            if (!isNaN(currentVal)) {
                qty.val(currentVal + 1); // Increment by 1
            }
        });

        $(document).on('click', '.minus', function() {
            var qty = $(document).find('form.cart .quantity');
            var currentVal = parseInt(qty.val());
            if (!isNaN(currentVal) && currentVal > 1) {
                qty.val(currentVal - 1); // Decrement by 1, but not below 1
            }
        });
        // AJAX Add to Cart functionality
        $(document).on('click', '.single_add_to_cart_button_ajax', function(e) {
            e.preventDefault();
            
            var product_id = $('form.cart').find('input[name="add-to-cart"]').val();
            var quantity = $(document).find('form.cart .quantity').val() || 1; // Get quantity, default to 1

            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'add_product_to_cart',
                    product_id: product_id,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.success) {
                        // alert('Product added to cart successfully!');
                        // Optionally update cart widget here
                        $(document.body).trigger('wc_fragment_refresh');
                    } else {
                        alert('There was an error adding the product to the cart.');
                    }
                }
            });
        });
    });
</script>



<?php
get_footer();
