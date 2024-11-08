<?php 
@session_start(); 

if ( is_user_logged_in() )   {
    $user_id = get_current_user_id();
   $address_ar =  get_user_meta( $user_id, 'address_lat_lng' );
   if($address_ar != "" && count($address_ar) != 0) {
    $address_fin= json_decode($address_ar[0])->address;
    $_SESSION['address'] = $address_fin;
   }
}
if(!isset($_SESSION['address']) || $_SESSION['address'] == ''){
    // return wp_redirect("/");
}
if(isset($_SESSION['address']) || $_SESSION['address'] != ''){ 
    $add  = $_SESSION['address'];
} elseif($address_fin != "") {
    $add = $address_fin;
} else {
    $add = "";
}
$restaurant_ids = get_all_delivery_zone_near_address($add );
if(empty($restaurant_ids)){
    wp_redirect("/");
    wp_die();
}
get_header(); ?>
<!-- header link wrapper -->
<section class="partner-wrapper d-flex justify-content-center py-2">
    <a href="javascript:void();" style="pointer-events: none;"><?php dynamic_sidebar('search_top_bar_text') ?></a>
</section>

<section class="product-section home-search-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3">
                <div class="sidebar-filter" style="display:none">
                    
                    <div class="filter-wrapper display-desktop">
                        <h2 class="filter-heading">Price</h2>
                        <div class="selection-card">
                            <?php echo do_shortcode('[facetwp facet="price_sorting"]'); ?>
                            <!-- <label for="Ascending" class="checkbox-label">
                                <input type="checkbox" class="check" id="Ascending">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Ascending</div>
                            </label>
                            <label for="Descending" class="checkbox-label">
                                <input type="checkbox" class="check" id="Descending">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Descending</div>
                            </label> -->
                            <label for="Range" class="checkbox-label">
                                <input type="checkbox" class="check" id="Range">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Custom Range</div>
                            </label>
                            <?php echo do_shortcode('[facetwp facet="price"]'); ?>
                            <!-- <div class="min-max-wrapper">
                                <button class="btn min-max-btn selected">Min</button>
                                <button class="btn min-max-btn ">Max</button>
                            </div> -->
                        </div>
                    </div>

                    <div class="filter-wrapper display-desktop">
                        <h2 class="filter-heading">Feature</h2>
                        <div class="selection-card">
                            <?php echo do_shortcode('[facetwp facet="feature"]'); ?>
                            <!-- <label for="Delivery" class="checkbox-label">
                                <input type="checkbox" class="check" id="Delivery">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Free Delivery</div>
                            </label>
                            <label for="Open" class="checkbox-label">
                                <input type="checkbox" class="check" id="Open">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Open Now</div>
                            </label>
                            <label for="Under" class="checkbox-label">
                                <input type="checkbox" class="check" id="Under">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Under 40 Min</div>
                            </label>
                            
                            <label for="Featured" class="checkbox-label">
                                <input type="checkbox" class="check" id="Featured">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Featured</div>
                            </label> -->
                           
                        </div>
                    </div>

                    <div class="filter-wrapper display-desktop">
                        <h2 class="filter-heading">Diet</h2>
                        <div class="selection-card">
                        <?php echo do_shortcode('[facetwp facet="diet"]'); ?>
                            <!-- <label for="Vegan" class="checkbox-label">
                                <input type="checkbox" class="check" id="Vegan">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Vegan</div>
                            </label>
                            <label for="Vegetarian" class="checkbox-label">
                                <input type="checkbox" class="check" id="Vegetarian">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Vegetarian</div>
                            </label>
                            <label for="Pescatarian" class="checkbox-label">
                                <input type="checkbox" class="check" id="Pescatarian">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Pescatarian</div>
                            </label>
                            <label for="Keto" class="checkbox-label">
                                <input type="checkbox" class="check" id="Keto">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Keto</div>
                            </label> -->
                          
                           
                        </div>
                    </div>

                    <div class="filter-wrapper display-desktop">
                        <h2 class="filter-heading">Cuisine</h2>

                        <div class="selection-card">
                        <?php echo do_shortcode('[facetwp facet="cuisine"]'); ?>
                            <!-- <label for="American" class="checkbox-label">
                                <input type="checkbox" class="check" id="American">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">American</div>
                            </label>
                            <label for="Chinese" class="checkbox-label">
                                <input type="checkbox" class="check" id="Chinese">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Chinese </div>
                            </label>
                            <label for="Ethiopian" class="checkbox-label">
                                <input type="checkbox" class="check" id="Ethiopian">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Ethiopian</div>
                            </label>
                            <label for="French" class="checkbox-label">
                                <input type="checkbox" class="check" id="French">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">French</div>
                            </label>
                            <label for="Indian" class="checkbox-label">
                                <input type="checkbox" class="check" id="Indian">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Indian</div>
                            </label>
                            <label for="Japanese" class="checkbox-label">
                                <input type="checkbox" class="check" id="Japanese">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Japanese</div>
                            </label>
                            <label for="Mexican" class="checkbox-label">
                                <input type="checkbox" class="check" id="Mexican">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Mexican</div>
                            </label>
                            <label for="Mediterranean" class="checkbox-label">
                                <input type="checkbox" class="check" id="Mediterranean">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Mediterranean</div>
                            </label>
                            <label for="Thai" class="checkbox-label">
                                <input type="checkbox" class="check" id="Thai">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Thai</div>
                            </label>
                            <label for="Turkish" class="checkbox-label">
                                <input type="checkbox" class="check" id="Turkish">
                                <div class="blank-box"></div>
                                <div class="checkbox-name">Turkish</div>
                            </label> -->
                           
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-10 col-md-9">
                <?php if(get_query_var('s')){ ?>
                    <h2 class="result-heading">Search Results for “<?php echo get_query_var('s') ?>” (<?php echo count($the_query->posts); ?>)</h2>
                <?php } ?>
                <div class="top-btn-wrapper<?php echo current_user_can('administrator') ? ' admin-top-btn-wrapper' : ''; ?>">
                    <div class="change_delivery_address_outer">
                        <p class="address-text" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Delivering to: <?php echo $_SESSION['address']; ?> <i class="fa-solid fa-chevron-down"></i> </p>
                        <div class="collapse change_delivery_address" id="collapseExample" style="max-width: 400px;">
                          <div class="card card-body">
                            <label>Change Delivery Address</label>
                            <div class="input-group form-wrapper mt-2">
                              <span class="input-group-text" id="basic-addon1"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/Pin.svg" alt=""></span>
                              <input type="text" class="form-control border" placeholder="Enter Delivery Address...." aria-label="Delivery Address" aria-describedby="button-addon2" id="address">
                              <button class="btn btn-outline-success address_validation" type="button"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/Right Up.svg" alt=""></button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <button class="btn btn-box selected-btn ms-sm-auto">Meals</button>
                    <a href="/restaurants" class="btn btn-box">Restaurants</a>
                </div>
                
                <div class="filter-wrapper display-mobile">
                    <?php
                    echo do_shortcode('[facetwp facet="price_sorting_copy"]');
                    echo do_shortcode('[facetwp facet="feature_copy"]');
                    echo do_shortcode('[facetwp facet="diet_copy"]');
                    echo do_shortcode('[facetwp facet="cuisine_copy"]');
                    ?>
                </div>

                <?php

                $s=get_search_query();
                $meta_filters = ['relation' => 'AND'];
                $meta_filters[] = [
                    'key' => 'restaurant',
                    'value' => $restaurant_ids,
                    'compare' => 'in'
                ];


                if(isset($_GET['_cuisine'])){
                    $_cuisines = [];

                    foreach (explode(',',$_GET['_cuisine']) as $key => $value) {
                        $_cuisines[] = [
                            'key'     => 'cuisine',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                    // $_cuisine = [
                    //     'key' => 'cuisine',
                    //     'value' => $_GET['_cuisine'],
                    //     'compare' => '='
                    // ];
                }

                if(isset($_GET['_cuisine_copy'])){
                    $_cuisines = [];

                    foreach (explode(',',$_GET['_cuisine_copy']) as $key => $value) {
                        $_cuisines[] = [
                            'key'     => 'cuisine',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                    // $_cuisine = [
                    //     'key' => 'cuisine',
                    //     'value' => $_GET['_cuisine'],
                    //     'compare' => '='
                    // ];
                }

                if(isset($_GET['_diet'])){

                    $_diets = [];

                    foreach (explode(',',$_GET['_diet']) as $key => $value) {
                        $_diets[] = [
                            'key'     => 'diet',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                
                }

                if(isset($_GET['_diet_copy'])){

                    $_diets = [];

                    foreach (explode(',',$_GET['_diet_copy']) as $key => $value) {
                        $_diets[] = [
                            'key'     => 'diet',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                
                }
                
                if(isset($_GET['_price'])){
                    $price = explode(',', $_GET['_price']);
                    $_price = [
                        'key'     => '_price',
                        'value'   => [$price[0], $price[1]],
                        'compare' => 'BETWEEN',
                        'type'    => 'NUMERIC',
                        // Add a condition to check for whole numbers
                        'query'   => [
                            'key' => '_price',
                            'compare' => '=',
                            'value' => 'CAST(_price AS UNSIGNED)',
                        ]
                    ];
                }

                if(isset($_GET['_feature'])){
                    $_features = [];
                    foreach (explode(',',$_GET['_feature']) as $key => $value) {
                        $_features[] = [
                            'key'     => 'features',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                    
                }

                if(isset($_GET['_feature_copy'])){
                    $_features = [];
                    foreach (explode(',',$_GET['_feature_copy']) as $key => $value) {
                        $_features[] = [
                            'key'     => 'features',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                    
                }

                if(isset($_GET['_price_sorting'])){
                    $sorting = '';
                    if($_GET['_price_sorting'] == 'descending'){
                        $sorting = 'DESC'; 
                    }else{
                        $sorting = 'ASC';
                    }
                }else{
                    $sorting = 'ASC';
                }
                
                if(isset($_GET['_price_sorting_copy'])){
                    $sorting = '';
                    if($_GET['_price_sorting_copy'] == 'descending'){
                        $sorting = 'DESC'; 
                    }else{
                        $sorting = 'ASC';
                    }
                }else{
                    $sorting = 'ASC';
                }

                if(isset($_diets) && !empty($_diets)){
                    foreach ($_diets as $key => $_diet) {
                        $meta_filters[] = $_diet;
                    }
                }

                if(isset($_cuisines) && !empty($_cuisines)){
                    foreach ($_cuisines as $key => $_cuisine) {
                        $meta_filters[] = $_cuisine;
                    }
                }

                if(isset($_price) && !empty($_price)){
                    $meta_filters[] = $_price;
                }

                if(isset($_features) && !empty($_features)){
                    foreach ($_features as $key => $_feature) {
                        $meta_filters[] = $_feature;
                    }
                }



                $args = array(
                    's' =>$s,
                    'post_type' => 'product',
                    'facetwp' => true,
                    'meta_query' => $meta_filters,
                    'posts_per_page' => -1,
                    'meta_key'       => '_price',       // Meta key for WooCommerce price
                    'orderby'        => 'meta_value_num', // Order by numeric meta value
                    'order'          => $sorting,          // ASC for lowest to highest price
                    // 'meta_query' => array(
                    //     'relation' => 'AND', // Ensures all conditions must be true
                    //     array(
                    //         'key'     => 'meta_key_1', // Replace with your first custom field key
                    //         'value'   => 'value_1',    // Replace with your first custom field value
                    //         'compare' => '='           // Comparison operator (e.g., '=', '!=', 'LIKE', etc.)
                    //     ),
                    //     array(
                    //         'key'     => 'meta_key_2', // Replace with your second custom field key
                    //         'value'   => 'value_2',    // Replace with your second custom field value
                    //         'compare' => '='           // Comparison operator
                    //     ),
                    // )
                );
                // The Query
                $the_query = new WP_Query( $args );
                // echo "<pre>";
                // print_r($the_query);
                // echo "</pre>";
                if ( $the_query->have_posts() ) { ?>

                    <div class="product-grid meal-result-grid mt-5">
                    <?php
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                
                            global $product;
                            // Get the regular price
                            $regular_price = $product->get_regular_price();
                
                            // Get the sale price (if available)
                            $sale_price = $product->get_sale_price();
                
                            // Get a specific meta field by key (replace '_meta_key' with your actual meta key)
                            $restaurant_id = get_post_meta( $product->get_id(), 'restaurant', true );
                            // print_r($restaurant_id);
                            // Get the post link (permalink)
                            $post_link = get_permalink( $restaurant_id );
                            // Get the final price (this will be the sale price if the product is on sale, otherwise it will be the regular price)
                            $price = $product->get_price();
                        ?>
                        <div class="plate-card">
                            <div class="plate-card-inner">
                                <a href="<?php echo $post_link ?>?p_id=<?php echo $product->get_id() ?>">
                                    <?php 
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'woocommerce_thumbnail' );
                                    } else {
                                        echo '<img src="' . wc_placeholder_img_src() . '" alt="' . esc_attr__( 'Placeholder', 'woocommerce' ) . '" />'; 
                                    }
                                    ?>
                                </a>
                                <div class="plate-contant">
                                    <a href="<?php echo $post_link ?>?p_id=<?php echo $product->get_id() ?>"><h5><?php the_title(); ?></h5></a>
                                    <?php the_excerpt(); ?>
                                    <div class="plate-cart">
                                        <?php
                                        if ( $product->is_purchasable() && $product->is_in_stock() ) {
                                            echo '<a href="' . esc_url( $product->add_to_cart_url() ) . '" class="ajax_add_to_cart btn add-to-cart" data-product_id="' . esc_attr( $product->get_id() ) . '" data-product_sku="' . esc_attr( $product->get_sku() ) . '" aria-label="' . esc_attr( $product->add_to_cart_description() ) . '" rel="nofollow">' . esc_html( $product->add_to_cart_text() ) . '</a>';
                                        }
                                        ?>
                                        <p class="price"><?php echo  wc_price($price) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                    </div> <!-- end of product-grid meal-result-grid mt-5 -->
                
                    <?php
                } else { ?>
                    <div class="meal-result-grid mt-5">
                        <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
                        <div class="alert alert-info">
                            <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
                        </div>
                    </div>
                <?php } ?>                
            </div>
        </div>
    </div>
 </section>
<script type="text/javascript">
jQuery(function($) {
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, button) {
        // Update mini-cart
        if (fragments) {
            $.each(fragments, function(key, value) {
                $(key).replaceWith(value);
            });
        }
    });
});

jQuery(document).on('click', '.facetwp-sort-radio', function(){
  setTimeout(function() {
    setInterval(function() {
      if (!jQuery(".facetwp-facet-date.facetwp-type-sort").hasClass("is-loading")) {
        let e = jQuery(".facetwp-radio.sort-radio.checked").attr("data-value");
        if (e == "in_house") {
          if (!jQuery(".fwpl-result").hasClass("custom-jobs-in-house")) {
            jQuery(".fwpl-result").removeClass("custom-jobs-in-date");
            jQuery(".fwpl-result").addClass("custom-jobs-in-house")
          }
        } else if (e == "date") {
          if (!jQuery(".fwpl-result").hasClass("custom-jobs-in-date")) {
            jQuery(".fwpl-result").removeClass("custom-jobs-in-house");
            jQuery(".fwpl-result").addClass("custom-jobs-in-date")
          }
        }
      }
    }, 100)
  }, 1200)
});


</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>