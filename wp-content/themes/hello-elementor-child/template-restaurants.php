<?php 

/* Template Name: Restaurants*/

@session_start(); 

if(!isset($_SESSION['address'])){

    return wp_redirect("/");

}

$restaurant_ids = get_all_delivery_zone_near_address($_SESSION['address']);
$get_all_meals_products_restraunt_list = get_all_meals_products_restraunt_list();
// Filter $restaurant_ids to only include those in $get_all_meals_products_restraunt_list
$restaurant_ids = array_intersect($restaurant_ids, $get_all_meals_products_restraunt_list);

// Optional: Re-index the array if you need sequential numeric keys
$restaurant_ids = array_values($restaurant_ids);

if(empty($restaurant_ids)){

    wp_redirect("/");

    wp_die();

}

get_header(); ?>



<section class="product-section custom-restaurants-section">

    <div class="container">

        <div class="row">

            <div class="col-lg-2 col-md-3">

                <div class="sidebar-filter" style="display:none">

                    <div class="filter-wrapper display-desktop">

                        <!-- <h2 class="filter-heading">Price</h2> -->

                        <div class="selection-card">

                            <?php // echo do_shortcode('[facetwp facet="price_sorting"]'); ?>

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

                            <!-- <label for="Range" class="checkbox-label">

                                <input type="checkbox" class="check" id="Range">

                                <div class="blank-box"></div>

                                <div class="checkbox-name">Custom Range</div>

                            </label> -->

                            <?php //echo do_shortcode('[facetwp facet="price"]'); ?>

                            <!-- <div class="min-max-wrapper">

                                <button class="btn min-max-btn selected">Min</button>

                                <button class="btn min-max-btn ">Max</button>

                            </div> -->

                        </div>

                    </div>



                    <div class="filter-wrapper display-desktop">

                        <h2 class="filter-heading">Feature</h2>

                        <div class="selection-card">

                            <?php echo do_shortcode('[facetwp facet="restaurant_features"]'); ?>

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

                        <?php echo do_shortcode('[facetwp facet="restaurant_diets"]'); ?>

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

                        <?php echo do_shortcode('[facetwp facet="restaurant_cuisine"]'); ?>

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

                <div class="top-btn-wrapper">



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

                    <a href="/?s=" class="btn btn-box ms-sm-auto">Meals</a>

                    <a href="/restaurants" class="btn btn-box selected-btn">Restaurants</a>

                </div>

                

                <div class="filter-wrapper display-mobile">

                    <?php

                    // echo do_shortcode('[facetwp facet="price_sorting_copy"]');

                    echo do_shortcode('[facetwp facet="restaurant_feature_copy"]');

                    echo do_shortcode('[facetwp facet="restaurant_diet_copy"]');

                    echo do_shortcode('[facetwp facet="restaurant_cuisine_copy"]');

                    ?>

                </div>



                <?php

                $s=get_search_query();

                $meta_filters = ['relation' => 'AND'];

                // echo "<pre>";

                // print_r($restaurant_ids);

                // echo "</pre>";

                // $meta_filters[] = [
                //     'key' => 'restaurant',
                //     'value' => $restaurant_ids,
                //     'compare' => 'in'
                // ];

                if(isset($_GET['_restaurant_cuisine'])){
                    $_cuisines = [];

                    foreach (explode(',',$_GET['_restaurant_cuisine']) as $key => $value) {
                        $_cuisines[] = [
                            'key'     => 'restaurant_cuisine',
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

                if(isset($_GET['_restaurant_cuisine_copy'])){
                    $_cuisines = [];

                    foreach (explode(',',$_GET['_restaurant_cuisine_copy']) as $key => $value) {
                        $_cuisines[] = [
                            'key'     => 'restaurant_cuisine',
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

                if(isset($_GET['_restaurant_diets'])){

                    $_diets = [];

                    foreach (explode(',',$_GET['_restaurant_diets']) as $key => $value) {
                        $_diets[] = [
                            'key'     => 'restaurant_diets  ',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                
                }

                if(isset($_GET['_restaurant_diet_copy'])){

                    $_diets = [];

                    foreach (explode(',',$_GET['_restaurant_diet_copy']) as $key => $value) {
                        $_diets[] = [
                            'key'     => 'restaurant_diets  ',
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
                    ];
                }

                if(isset($_GET['_restaurant_features'])){
                    $_features = [];
                    foreach (explode(',',$_GET['_restaurant_features']) as $key => $value) {
                        $_features[] = [
                            'key'     => 'restaurant_features',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                    
                }

                if(isset($_GET['_restaurant_feature_copy'])){
                    $_features = [];
                    foreach (explode(',',$_GET['_restaurant_feature_copy']) as $key => $value) {
                        $_features[] = [
                            'key'     => 'restaurant_features',
                            'value'   => $value,
                            'compare' => 'like',
                        ];
                    }
                    
                }

                
                if(isset($_diet) && !empty($_diet)){
                    $meta_filters[] = $_diet;
                }

                if(isset($_cuisine) && !empty($_cuisine)){
                    $meta_filters[] = $_cuisine;
                }

                if(isset($_price) && !empty($_price)){
                    $meta_filters[] = $_price;
                }

                if(isset($_features) && !empty($_features)){
                    foreach ($_features as $key => $_feature) {
                        $meta_filters[] = $_feature;
                    }
                }


                // $args = array(
                //     's' =>$s,
                //     'post_type' => 'product',
                //     'facetwp' => true,
                //     'meta_query' => $meta_filters,
                //     'posts_per_page' => -1

                // );

                // // The Query

                // $the_query = new WP_Query( $args );
                // $post_ids = array();

                // if ( $the_query->have_posts() ) {
                //     while ( $the_query->have_posts() ) {
                //         $the_query->the_post();
                //         $post_ids[] = get_post_meta( get_the_ID(), 'restaurant', true ); // Collect post IDs
                //     }
                // }


                $args = array(
                    'post_type' => 'restaurant',
                    'facetwp' => true,
                    'meta_query' => $meta_filters,
                    'post__in' => $restaurant_ids,
                    'posts_per_page' => -1
                );

                // The Query

                $the_query = new WP_Query( $args );

                if ( $the_query->have_posts() ) { ?>
                    <div class="product-grid meal-result-grid mt-5">
                        <?php
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            ?>
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
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div> <!-- end of product-grid meal-result-grid mt-5 -->
                <?php
                } else {
                ?>
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

        // Example: Update mini-cart

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