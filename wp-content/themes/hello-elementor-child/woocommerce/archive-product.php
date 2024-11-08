<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>
<!-- slick slider cdn -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- slick slider cdn end -->
<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
// do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
// do_action( 'woocommerce_shop_loop_header' );

if ( woocommerce_product_loop() ) {

  /**
   * Hook: woocommerce_before_shop_loop.
   *
   * @hooked woocommerce_output_all_notices - 10
   * @hooked woocommerce_result_count - 20
   * @hooked woocommerce_catalog_ordering - 30
   */
  // do_action( 'woocommerce_before_shop_loop' );

  woocommerce_product_loop_start();

  if ( wc_get_loop_prop( 'total' ) ) {
    while ( have_posts() ) {
      the_post();

      /**
       * Hook: woocommerce_shop_loop.
       */
      do_action( 'woocommerce_shop_loop' );

      //wc_get_template_part( 'content', 'product' );
    }
  }

  woocommerce_product_loop_end();

  /**
   * Hook: woocommerce_after_shop_loop.
   *
   * @hooked woocommerce_pagination - 10
   */
  do_action( 'woocommerce_after_shop_loop' );
} else {
  /**
   * Hook: woocommerce_no_products_found.
   *
   * @hooked wc_no_products_found - 10
   */
  do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>
<!-- product section -->
         <section class="product-section">
            <div class="container">
                <div class="row">
                  <div class="col-lg-2 col-md-3">
                    <div class="sidebar-filter">
                        <div class="filter-wrapper">
                            <h2 class="filter-heading">Price</h2>
                            <?php echo do_shortcode('[facetwp facet="price"]'); ?>
                            <div class="selection-card">
                                <!-- [facetwp facet="price"] -->
                                <label for="Ascending" class="checkbox-label">
                                    <input type="checkbox" class="check" id="Ascending">
                                    <div class="blank-box"></div>
                                    <div class="checkbox-name">Ascending</div>
                                </label>
                                <label for="Descending" class="checkbox-label">
                                    <input type="checkbox" class="check" id="Descending">
                                    <div class="blank-box"></div>
                                    <div class="checkbox-name">Descending</div>
                                </label>
                                <label for="Range" class="checkbox-label">
                                    <input type="checkbox" class="check" id="Range">
                                    <div class="blank-box"></div>
                                    <div class="checkbox-name">Custom Range</div>
                                </label>
                                <div class="min-max-wrapper">
                                    <button class="btn min-max-btn selected">Min</button>
                                    <button class="btn min-max-btn ">Max</button>
                                </div>
                            </div>
                        </div>

                        <div class="filter-wrapper">
                            <h2 class="filter-heading">Feature</h2>
                            <?php echo do_shortcode('[facetwp facet="feature"]'); ?>
                        </div>

                        <div class="filter-wrapper">
                            <h2 class="filter-heading">Diet</h2>
                            <?php echo do_shortcode('[facetwp facet="diet"]'); ?>
                        </div>

                        <div class="filter-wrapper">
                            <h2 class="filter-heading">Cuisine</h2>
                            <?php echo do_shortcode('[facetwp facet="cuisine"]'); ?>
                        </div>
                    </div>

                </div>
                    <div class="col-lg-10 col-md-9">
                        <div class="top-btn-wrapper mb-5">
                            <p class="address-text">Delivering to: 123 Neighborhood Drive </p>
                            <a href="/shop" class="btn btn-box selected-btn ms-auto">Meals</a>
                            <a href="/restaurant" class="btn btn-box">Restaurants</a>
                        </div>
                        <?php 
                        // Display WooCommerce categories
						$args = array(
						    'taxonomy'   => 'product_cat',
						    'orderby'    => 'name',
						    'order'      => 'ASC',
						    'hide_empty' => true,
						);

						$product_categories = get_terms( $args );

						if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {
						?>
						<div class="slider-wrapper mb-5">
                            <div class="Product-slider">
                            	<?php
                            	foreach ( $product_categories as $category ) {
						        $category_link = get_term_link( $category ); ?>
	                                <div class="product-card">
	                                  <a href="<?php the_permalink(); ?>">
                                        <?php 
                                        // Get the thumbnail ID
                                        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );

                                        // Get the image URL
                                        $image_url = wp_get_attachment_url( $thumbnail_id );
                                        echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $category->name ) . '" />';
                                        ?>
                                        </a>
	                                  <h5><?php echo esc_html( $category->name ); ?></h5>
	                                </div>

							    <?php } ?>
                        </div>
                      </div>

						<?php } 
                        wp_reset_postdata();
                        ?>
                        

                        <?php
                        // Display Featured Products
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => 12, // Number of featured products to display
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                    'operator' => 'IN',
                                ),
                            ),
                        );

                        $featured_query = new WP_Query( $args );

                        if ( $featured_query->have_posts() ) : ?>
                        <div class="plate-wrapper mb-5">
                          <h3 class="product-heading"><?php esc_html_e( 'Featured Plates', 'your-theme' ); ?> </h3>
                          <div class="plate-slider">
                            <?php 
                                while ( $featured_query->have_posts() ) : $featured_query->the_post(); 
                                global $product;
                                // Get the regular price
                                $regular_price = $product->get_regular_price();

                                // Get the sale price (if available)
                                $sale_price = $product->get_sale_price();

                                // Get the final price (this will be the sale price if the product is on sale, otherwise it will be the regular price)
                                $price = $product->get_price();
                            ?>
                              <div class="plate-card">
                                    <div class="plate-card-inner">
                                        <a href="<?php the_permalink(); ?>">
                                        <?php 
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'woocommerce_thumbnail' );
                                        } else {
                                            echo '<img src="' . wc_placeholder_img_src() . '" alt="' . esc_attr__( 'Placeholder', 'woocommerce' ) . '" />'; 
                                        }
                                        ?>
                                        </a>
                                        <div class="plate-contant">
                                            <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                                            <div class="plate-cart">
                                                <!-- <button class="btn add-to-cart">Add</button> -->
                                                <?php
                                                if ( $product->is_purchasable() && $product->is_in_stock() ) {
                                                    echo '<a href="' . esc_url( $product->add_to_cart_url() ) . '" class=" ajax_add_to_cart btn add-to-cart" data-product_id="' . esc_attr( $product->get_id() ) . '" data-product_sku="' . esc_attr( $product->get_sku() ) . '" aria-label="' . esc_attr( $product->add_to_cart_description() ) . '" rel="nofollow">' . esc_html( $product->add_to_cart_text() ) . '</a>';
                                                }
                                                ?>
                                                <p class="price"><?php echo  wc_price($price) ?></p>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                          <?php endwhile; ?>
                            </div>
                        </div>

                        <?php endif;

                        // Reset post data
                        wp_reset_postdata();


                        // Your custom query for top-rated restaurants
                        $top_rated_restaurants = new WP_Query( array(
                            'post_type'      => 'restaurant',
                            'posts_per_page' => 15, // Adjust the number of restaurants to display
                            'meta_key'       => 'restaurant_ratings', // Replace with your rating meta key
                            'orderby'        => 'meta_value_num',
                            'order'          => 'DESC',
                        ) );

                        if ( $top_rated_restaurants->have_posts() ) : 
                        ?>
                      <div class="restaurant-slider-wrapper mb-5">
                        <h3 class="product-heading">Top Rated Restaurants</h3>
                        <div class="plate-slider">
                          <?php while ( $top_rated_restaurants->have_posts() ) : $top_rated_restaurants->the_post(); ?>
                            <div class="plate-card">
                              <a href="<?php the_permalink(); ?>">
                                <div class="plate-card-inner">
                                  <?php if (has_post_thumbnail()) : ?>
                                    <div class="restaurant-thumbnail">
                                      <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                  <?php endif; ?>
                                  <div class="plate-contant">
                                    <h5><?php the_title(); ?></h5>
                                    <p><?php
                                      $description = get_the_content(); // or get_the_content()
                                      $short_description = substr( $description, 0, 15 ); // Limit to 15 characters
                                      echo esc_html( $short_description ) . '...';
                                      ?>
                                    </p>
                                    <div class="restaurant-star">
                                      <?php
                                      $total_count = get_total_ratings_count( get_the_ID() );
                                      $average_rating = get_average_rating( get_the_ID() );

                                      ?>
                                      <p class="rating"><span class="rating-point"><?php echo $average_rating ?> </span>⭐ <span class="total-rating">(<?php echo $total_count; ?>)</span></p>
                                    </div>
                                  </div>
                                </div>
                              </a>
                            </div>
                          <?php endwhile; ?>

                          </div>
                    </div>
                    <?php 
                    endif;
                    wp_reset_postdata(); // Reset the post data
                    ?>

                    <div class="order-again-wrapper mb-5">
                      <h3 class="product-heading">Order Again</h3>
                      <div class="order-slider">
                          <div class="plate-card">
                            <div class="plate-card-inner">
                              <img src="./images/product-page/feature-plates.png" alt="">
                            <div class="plate-contant">
                              <h5>Title of Food</h5>
                              <p>Lorem ipsum dolor sit amet consectetur.</p>
                            <div class="plate-cart">
                              <button class="btn add-to-cart">Add</button>
                              <p class="price">$14.99</p>
                            </div>
                            </div>
                            </div>
                          </div>

                          <div class="plate-card">
                            <div class="plate-card-inner">
                              <img src="./images/product-page/feature-plates.png" alt="">
                            <div class="plate-contant">
                              <h5>Title of Food</h5>
                              <p>Lorem ipsum dolor sit amet consectetur.</p>
                            <div class="plate-cart">
                              <button class="btn add-to-cart">Add</button>
                              <p class="price">$14.99</p>
                            </div>
                            </div>
                            </div>
                          </div>

                          <div class="plate-card">
                            <div class="plate-card-inner">
                              <img src="./images/product-page/feature-plates.png" alt="">
                            <div class="plate-contant">
                              <h5>Title of Food</h5>
                              <p>Lorem ipsum dolor sit amet consectetur.</p>
                            <div class="plate-cart">
                              <button class="btn add-to-cart">Add</button>
                              <p class="price">$14.99</p>
                            </div>
                            </div>
                            </div>
                          </div>

                          <div class="plate-card">
                            <div class="plate-card-inner">
                              <img src="./images/product-page/feature-plates.png" alt="">
                            <div class="plate-contant">
                              <h5>Title of Food</h5>
                              <p>Lorem ipsum dolor sit amet consectetur.</p>
                            <div class="plate-cart">
                              <button class="btn add-to-cart">Add</button>
                              <p class="price">$14.99</p>
                            </div>
                            </div>
                            </div>
                          </div>

                          <div class="plate-card">
                            <div class="plate-card-inner">
                              <img src="./images/product-page/feature-plates.png" alt="">
                            <div class="plate-contant">
                              <h5>Title of Food</h5>
                              <p>Lorem ipsum dolor sit amet consectetur.</p>
                            <div class="plate-cart">
                              <button class="btn add-to-cart">Add</button>
                              <p class="price">$14.99</p>
                            </div>
                            </div>
                            </div>
                          </div>

                          <div class="plate-card">
                            <div class="plate-card-inner">
                              <img src="./images/product-page/feature-plates.png" alt="">
                            <div class="plate-contant">
                              <h5>Title of Food</h5>
                              <p>Lorem ipsum dolor sit amet consectetur.</p>
                            <div class="plate-cart">
                              <button class="btn add-to-cart">Add</button>
                              <p class="price">$14.99</p>
                            </div>
                            </div>
                            </div>
                          </div>

                          

                          
                        </div>
                  </div>
                      
                    </div>
                </div>
            </div>
         </section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script>
jQuery('.Product-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 6,
            draggable:true,
            slidesToScroll: 1,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                    
                }
                },
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            });

            jQuery('.plate-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 1,
            focusOnSelect: true,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                    
                }
                },
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            });


            // order-slider
            
            jQuery('.order-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                    
                }
                },
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            });
</script>
<?php
get_footer( 'shop' );
