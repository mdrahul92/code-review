<?php 


//Handler code


/* Creating Restaurants Post Type*/

// Register Custom Post Type: Restaurant
function create_restaurant_cpt() {
    $labels = array(
        'name'                  => _x( 'Restaurants', 'Post Type General Name', 'textdomain' ),
        'singular_name'         => _x( 'Restaurant', 'Post Type Singular Name', 'textdomain' ),
        'menu_name'             => __( 'Restaurants', 'textdomain' ),
        'name_admin_bar'        => __( 'Restaurant', 'textdomain' ),
        'archives'              => __( 'Restaurant Archives', 'textdomain' ),
        'attributes'            => __( 'Restaurant Attributes', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Restaurant:', 'textdomain' ),
        'all_items'             => __( 'All Restaurants', 'textdomain' ),
        'add_new_item'          => __( 'Add New Restaurant', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'new_item'              => __( 'New Restaurant', 'textdomain' ),
        'edit_item'             => __( 'Edit Restaurant', 'textdomain' ),
        'update_item'           => __( 'Update Restaurant', 'textdomain' ),
        'view_item'             => __( 'View Restaurant', 'textdomain' ),
        'view_items'            => __( 'View Restaurants', 'textdomain' ),
        'search_items'          => __( 'Search Restaurant', 'textdomain' ),
        'not_found'             => __( 'Not found', 'textdomain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'textdomain' ),
        'featured_image'        => __( 'Restaurant Logo', 'textdomain' ),
        'set_featured_image'    => __( 'Set Restaurant Logo', 'textdomain' ),
        'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
        'use_featured_image'    => __( 'Use as featured image', 'textdomain' ),
        'insert_into_item'      => __( 'Insert into restaurant', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this restaurant', 'textdomain' ),
        'items_list'            => __( 'Restaurants list', 'textdomain' ),
        'items_list_navigation' => __( 'Restaurants list navigation', 'textdomain' ),
        'filter_items_list'     => __( 'Filter restaurants list', 'textdomain' ),
    );
    $args = array(
        'label'                 => __( 'Restaurant', 'textdomain' ),
        'description'           => __( 'Post Type for Restaurants', 'textdomain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'restaurant', $args );
}
add_action( 'init', 'create_restaurant_cpt', 0 );

// Register Custom Taxonomy: Delivery Zone
function create_delivery_zone_taxonomy() {
    $labels = array(
        'name'              => _x( 'Delivery Zones', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Delivery Zone', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Delivery Zones', 'textdomain' ),
        'all_items'         => __( 'All Delivery Zones', 'textdomain' ),
        'parent_item'       => __( 'Parent Delivery Zone', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Delivery Zone:', 'textdomain' ),
        'edit_item'         => __( 'Edit Delivery Zone', 'textdomain' ),
        'update_item'       => __( 'Update Delivery Zone', 'textdomain' ),
        'add_new_item'      => __( 'Add New Delivery Zone', 'textdomain' ),
        'new_item_name'     => __( 'New Delivery Zone Name', 'textdomain' ),
        'menu_name'         => __( 'Delivery Zones', 'textdomain' ),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // Make it hierarchical (like categories)
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
    );
    register_taxonomy( 'delivery_zone', array( 'restaurant' ), $args );
}
add_action( 'init', 'create_delivery_zone_taxonomy', 0 );

function create_restaurant_taxonomy() {
    $labels = array(
        'name'              => _x('Tags', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Tag', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Tags', 'textdomain'),
        'all_items'         => __('All Tags', 'textdomain'),
        'parent_item'       => __('Parent Tag', 'textdomain'),
        'parent_item_colon' => __('Parent Tag:', 'textdomain'),
        'edit_item'         => __('Edit Tag', 'textdomain'),
        'update_item'       => __('Update Tag', 'textdomain'),
        'add_new_item'      => __('Add New Tag', 'textdomain'),
        'new_item_name'     => __('New Tag Name', 'textdomain'),
        'menu_name'         => __('Tags', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tag'),
    );

    register_taxonomy('tag', array('restaurant'), $args);
}
add_action('init', 'create_restaurant_taxonomy', 0);


// Creating a function to update the Delivery Zone and based on the address it will save the Lattitude and Longitude of the address in the term meta.


// add_action('created_delivery_zone', 'my_custom_function', 10, 3);
// add_action('saved_term', 'my_custom_function', 10, 4);

// function my_custom_function($term_id, $tt_id, $taxonomy, $args) {
//     if ($taxonomy === 'delivery_zone') {
//         if($_POST['acf']['field_66c9d12ccfc81'] == "" && $_POST['acf']['field-66c9d147cfc8'] == "" ) {
//             if($_POST['acf']['field_66c9d115cfc80'] != "") {
//                 $address = urlencode($_POST['acf']['field_66c9d115cfc80']);
//                 $apiKey = "6c4e80f8f75542808126942900ffdcbd";
//                 $url = "https://api.opencagedata.com/geocode/v1/json?q={$address}&key={$apiKey}";
//                 $response = file_get_contents($url);
//                 $json = json_decode($response, true);
                
//                 if (isset($json['results'][0])) {
//                    $lat = $json['results'][0]['geometry']['lat'];
//                    $lng = $json['results'][0]['geometry']['lng'];
//                     if($lat != "" && $lng != "") {
//                         update_field('lattitude', $lat, 'delivery_zone_' . $term_id);
//                         update_field('longitude', $lng, 'delivery_zone_' . $term_id);
//                     }
//                 }
//             }
//         }

//         // Your custom logic here
//     }
// }

//changing the Product_cat name to Restaurants

// Change the product_cat label to Restaurants
function rename_product_category_taxonomy( $args, $taxonomy ) {
    if ( 'product_cat' === $taxonomy ) {
        $args['labels']['name'] = 'Restaurants';
        $args['labels']['singular_name'] = 'Restaurant';
        $args['labels']['menu_name'] = 'Restaurants';
        $args['labels']['all_items'] = 'All Restaurants';
        $args['labels']['edit_item'] = 'Edit Restaurant';
        $args['labels']['view_item'] = 'View Restaurant';
        $args['labels']['update_item'] = 'Update Restaurant';
        $args['labels']['add_new_item'] = 'Add New Restaurant';
        $args['labels']['new_item_name'] = 'New Restaurant Name';
        $args['labels']['search_items'] = 'Search Restaurants';
        $args['labels']['popular_items'] = 'Popular Restaurants';
        $args['labels']['separate_items_with_commas'] = 'Separate restaurants with commas';
        $args['labels']['add_or_remove_items'] = 'Add or remove restaurants';
        $args['labels']['choose_from_most_used'] = 'Choose from the most used restaurants';
        $args['labels']['not_found'] = 'No restaurants found';
    }
    return $args;
}
// add_filter( 'woocommerce_taxonomy_args_product_cat', 'rename_product_category_taxonomy', 10, 2 );


// Change WooCommerce Product name to Food Item
function change_woocommerce_product_labels( $args ) {
    $args['labels'] = array(
        'name'                  => 'Food Items',
        'singular_name'         => 'Food Item',
        'add_new'               => 'Add Food Item',
        'add_new_item'          => 'Add New Food Item',
        'edit_item'             => 'Edit Food Item',
        'new_item'              => 'New Food Item',
        'view_item'             => 'View Food Item',
        'view_items'            => 'View Food Items',
        'search_items'          => 'Search Food Items',
        'not_found'             => 'No Food Items found',
        'not_found_in_trash'    => 'No Food Items found in trash',
        'all_items'             => 'All Food Items',
        'archives'              => 'Food Item Archives',
        'insert_into_item'      => 'Insert into Food Item',
        'uploaded_to_this_item' => 'Uploaded to this Food Item',
        'featured_image'        => 'Featured image for this Food Item',
        'set_featured_image'    => 'Set featured image for this Food Item',
        'remove_featured_image' => 'Remove featured image for this Food Item',
        'use_featured_image'    => 'Use as featured image for this Food Item',
        'menu_name'             => 'Food Items',
        'filter_items_list'     => 'Filter Food Items list',
        'items_list_navigation' => 'Food Items list navigation',
        'items_list'            => 'Food Items list',
    );

    return $args;
}
add_filter( 'woocommerce_product_post_type_args', 'change_woocommerce_product_labels' );


// check if we deliver to user address

// wp_send_json_success( $response );wp_send_json_error

function check_delivery_address($address = NULL) {

    $address_save = $address;
    session_start();
    $_SESSION['address'] = $address;
    if($address == NULL) {
        
        $response = array(
            'error' => 1,
            'message' => 'No Address as Input',
        );
        return wp_send_json_error($response);
    }

    $terms = get_terms( array(
        'taxonomy'   => 'delivery_zone',
        'hide_empty' => false, // Set to true to only show terms with posts
    ) );
    
    // Check if terms are found
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        //getting the client lattitude and Longitude
        $address = urlencode($address);
        $apiKey = "6c4e80f8f75542808126942900ffdcbd";
        $url = "https://api.opencagedata.com/geocode/v1/json?q={$address}&key={$apiKey}";
        $response = file_get_contents($url);
        $json = json_decode($response, true);
        
        if (isset($json['results'][0])) {
            $_SESSION['address_components'] = $json['results'][0]['components'];
            $lat = $json['results'][0]['geometry']['lat'];
            $lng = $json['results'][0]['geometry']['lng'];
            if($lat == "" && $lng == "") {
                $response = array(
                    'error' => 1,
                    'message' => 'Invalid Address',
                );
                return wp_send_json_error($response);
            }
            $isInRange = 0;
            foreach ( $terms as $term ) {
                $lattitude = get_field( 'lattitude', 'delivery_zone_' . $term->term_id );
                $longitude = get_field( 'longitude', 'delivery_zone_' . $term->term_id );
                $range = get_field( 'range', 'delivery_zone_' . $term->term_id );
                $distance = calculate_distance_miles($lattitude , $longitude , $lat , $lng);
                if(round($distance, 2) < $range) {
                    $isInRange = 1;
                    $response = array(
                        'error' => 0,
                        'message' => $term->term_id.' is the delivery zone',
                    );

                    if ( is_user_logged_in() )   {
                        $user_id = get_current_user_id();
                        $loc = array("lat"=>$lattitude , "lng" => $longitude , "zone" => $term->term_id , 'address' => $address_save);
                        update_user_meta( $user_id, 'address_lat_lng', json_encode($loc) );
                    }
                    return wp_send_json_success($response);
                } else {
                    $isInRange = 0;
                }
            }
            if($isInRange == 0 ) {
                $response = array(
                    'error' => 1,
                    'message' => 'No Delivery Zoon is near your address',
                );
                return wp_send_json_error($response);
            }
        } else {
            $response = array(
                'error' => 1,
                'message' => 'Invalid Address',
            );
            return wp_send_json_error($response);
        }
    } else {
        $response = array(
            'error' => 1,
            'message' => 'No Delivery Zone Available',
        );
        return wp_send_json_error($response);
    }

}


function check_delivery_address1($address = NULL) {
    $address_save = $address;
    session_start();
    $_SESSION['address'] = $address;
    if($address == NULL) {
        
        $response = array(
            'error' => 1,
            'message' => 'No Address as Input',
        );
        return wp_send_json_error($response);
    }

    $terms = get_terms( array(
        'taxonomy'   => 'delivery_zone',
        'hide_empty' => false, // Set to true to only show terms with posts
    ) );
    
    // Check if terms are found
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        //getting the client lattitude and Longitude
        $address = urlencode($address);
        // $apiKey = " 6c4e80f8f75542808126942900ffdcbd";
        $apiKey = "4e82360b1ae4419680be17bc1f68a19b";
        $url = "https://api.opencagedata.com/geocode/v1/json?q={$address}&key={$apiKey}";
        $response = file_get_contents($url);
        $json = json_decode($response, true);
        
        if (isset($json['results'][0])) {
            $lat = $json['results'][0]['geometry']['lat'];
            $lng = $json['results'][0]['geometry']['lng'];
            if($lat == "" && $lng == "") {
                $response = array(
                    'error' => 1,
                    'message' => 'Invalid Address',
                );
                return wp_send_json_error($response);
            }
            $isInRange = 0;
            $selected_term_ids = [];
            foreach ( $terms as $term ) {
                $lattitude = get_field( 'lattitude', 'delivery_zone_' . $term->term_id );
                $longitude = get_field( 'longitude', 'delivery_zone_' . $term->term_id );
                $range = get_field( 'range', 'delivery_zone_' . $term->term_id );
                $distance = calculate_distance_miles($lattitude , $longitude , $lat , $lng);
                if(round($distance, 2) < $range) {
                    $isInRange = 1;
                    $response = array(
                        'error' => 0,
                        'message' => $term->term_id.' is the delivery zone',
                    );

                    if ( is_user_logged_in() )   {
                        $user_id = get_current_user_id();
                        $loc = array("lat"=>$lattitude , "lng" => $longitude , "zone" => $term->term_id , 'address' => $address_save);
                        update_user_meta( $user_id, 'address_lat_lng', json_encode($loc) );
                    }
                    return wp_send_json_success($response);
                } else {
                    $isInRange = 0;
                }
            }
            if($isInRange == 0 ) {
                $response = array(
                    'error' => 1,
                    'message' => 'No Delivery Zoon is near your address',
                );
                return wp_send_json_error($response);
            }else{

            }
        } else {
            $response = array(
                'error' => 1,
                'message' => 'Invalid Address',
            );
            return wp_send_json_error($response);
        }
    } else {
        $response = array(
            'error' => 1,
            'message' => 'No Delivery Zone Available',
        );
        return wp_send_json_error($response);
    }

}


//Delivery Date Calulation

/**
 * Custom function to run after an order is placed.
 *
 * @param int $order_id The order ID.
 */
function my_custom_function_after_order_placed( $order_id ) {
    // Get the order object
    $order = wc_get_order( $order_id );

    if ( ! $order ) {
        return;
    }

    // Get the order date and time
    $order_date = $order->get_date_created(); // DateTime object
    $order_date_utc = $order_date ? $order_date->format( 'Y-m-d H:i:s' ) : 'No date available';

    // Initialize variable for the first product category
    $first_category = 'No category';

    // Loop through the order items
    foreach ( $order->get_items() as $item_id => $item ) {
        $product_id = $item->get_product_id();
        $product = wc_get_product( $product_id );

        if ( $product ) {
            $categories = get_post_meta( $product_id, 'restaurant' );

            if ( ! empty( $categories ) ) {
                $first_category = $categories[0];
                break; // Stop after finding the first category
            }
        }
    }
    $post_id = $first_category; // Replace with your post ID
$post_title = get_the_title($post_id);


    // Query for the restaurant post with the same name as the first category
    $args = array(
        'post_type'  => 'restaurant',
        'post_status' => 'publish',
        'name'        => sanitize_title($post_title),
        'posts_per_page' => 1,
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        $post = $query->posts[0];
        $post_id = $post->ID;

        // Get the delivery zone terms for the restaurant post
        $delivery_zones = wp_get_post_terms( $post_id, 'delivery_zone' );

        if ( ! empty( $delivery_zones ) ) {
            $term = $delivery_zones[0];
            $term_id = $term->term_id;

            // Get the ACF fields for the delivery zone
            $delivery_zone_name = get_field( 'delivery_time_zone', 'delivery_zone_' . $term_id );
            $latitude = get_field( 'latitude', 'delivery_zone_' . $term_id );
            $longitude = get_field( 'longitude', 'delivery_zone_' . $term_id );
            $range = get_field( 'range', 'delivery_zone_' . $term_id );

            // Dynamic parameters for deadline and delivery
            $order_deadline_day = get_field('order', 'option'); // Dynamic day
            $order_deadline_time = get_field('order_time_deadline', 'option'); // Dynamic time (e.g., 23:59)
            $delivery_day = get_field('order_delivery__date', 'option'); // Dynamic delivery day

            if (!$order_deadline_day) $order_deadline_day = 'Wednesday'; // Fallback
            if (!$order_deadline_time) $order_deadline_time = '23:59'; // Fallback
            if (!$delivery_day) $delivery_day = 'Saturday'; // Fallback

            // Convert the order date to the selected timezone
            if ( $delivery_zone_name ) {
                try {
                    $timezone = new DateTimeZone( $delivery_zone_name );

                    $order_date_utc_obj = new DateTime( $order_date_utc, new DateTimeZone('UTC') );
                    $order_date_local_obj = $order_date_utc_obj->setTimezone( $timezone );

                   $order_date_local = $order_date_local_obj->format( 'Y-m-d H:i:s' );

                    
                    // Dynamic order deadline time
                    $order_deadline = new DateTime('last ' . $order_deadline_day, $timezone);
                    $order_deadline->modify('+1 day')->setTime((int)substr($order_deadline_time, 0, 2), (int)substr($order_deadline_time, 3)); // Set dynamic time

                    if ( $order_date_local_obj < $order_deadline ) {
                        $now_day_name = $order_date->format('l'); // Get current day name

                        $current_week_order_deadline = clone $order_date;
                        $current_week_order_deadline->modify("this week $order_deadline_day"); // Set to this week's deadline
                        // Order deadline has not passed, show this week's delivery date
                        $next_delivery_date = clone $current_week_order_deadline; // Keep this week's order deadline
                        if ($now_day_name === $delivery_day) {
                            $next_delivery_date = $order_date_utc; // If today is delivery day, set to now
                        } else {
                            $next_delivery_date = new DateTime("next $delivery_day + 7 days");
                        }
                    } else {
                        // Order deadline has passed, so set to next week's delivery day
                        $next_delivery_date = new DateTime("next $delivery_day");
                       
                    }
                    // // Check if the order is before or after the deadline
                    // if ( $order_date_local_obj < $order_deadline ) {
                    //     // Order before the deadline, set delivery to this week's specified delivery day
                    //     $delivery_date = new DateTime('next ' . $delivery_day, $timezone);
                    // } else {
                    //     // Order after the deadline, set delivery to next week's specified delivery day
                    //     $delivery_date = new DateTime('next ' . $delivery_day, $timezone);
                    //     $delivery_date->modify('+1 week');
                    // }

                    $delivery_date_formatted = $next_delivery_date->format( 'Y-m-d' );

                    // Update the ACF field for delivery date
                    update_post_meta( $order_id , 'delivery_date', $delivery_date_formatted  );

                } catch ( Exception $e ) {
                    $order_date_local = 'Invalid timezone';
                    $delivery_date_formatted = 'No delivery date available';
                }
            } else {
                $order_date_local = 'No timezone available';
                $delivery_date_formatted = 'No delivery date available';
            }
        } else {
            $delivery_zone = array(
                'name'      => 'No matching delivery zone',
                'latitude'  => 'No latitude available',
                'longitude' => 'No longitude available',
                'range'     => 'No range available',
            );
            $order_date_local = 'No timezone available';
            $delivery_date_formatted = 'No delivery date available';
        }
    } else {
        $delivery_zone = array(
            'name'      => 'No matching restaurant',
            'latitude'  => 'No latitude available',
            'longitude' => 'No longitude available',
            'range'     => 'No range available',
        );
        $order_date_local = 'No timezone available';
        $delivery_date_formatted = 'No delivery date available';
    }

   
}

add_action( 'woocommerce_thankyou', 'my_custom_function_after_order_placed', 10, 1 );


// Display custom field data in admin order page
add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_field_in_admin_order', 10, 1);

function display_custom_field_in_admin_order($order) {
    $delivery_date = get_post_meta($order->get_id(), 'delivery_date', true);
    if ($delivery_date) {
        echo '<p><strong>' . __('Delivery Date') . ':</strong> ' . date('m-d-Y', strtotime($delivery_date)) . '</p>';
    }
}

// Display custom field data in customer order page
add_action('woocommerce_order_details_after_order_table', 'display_custom_field_in_customer_order', 10, 1);

function display_custom_field_in_customer_order($order) {
    $delivery_date = get_post_meta($order->get_id(), 'delivery_date', true);
    if ($delivery_date) {
        echo '<p><strong>' . __('Delivery Date') . ':</strong> ' . date('m-d-Y', strtotime($delivery_date)) . '</p>';
    }
}



// Distance Calculator

function calculate_distance_miles($lat1, $lon1, $lat2, $lon2) {
    $earth_radius_miles = 3958.8; // Radius of the Earth in miles

    // Convert latitude and longitude from degrees to radians
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Haversine formula
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) +
         cos($lat1) * cos($lat2) *
         sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earth_radius_miles * $c;

    return $distance;
}


function get_all_delivery_zone_near_address($address = NULL) {
    @session_start();
    $_SESSION['address'] = $address;

    if($address == NULL) {

    if ( is_user_logged_in() )   {
        $user_id = get_current_user_id();
        $address_ar =  get_user_meta( $user_id, 'address_lat_lng' );
       if($address_ar != "" && count($address_ar) != 0) {
        $address_fin= json_decode($address_ar[0])->address;
        $_SESSION['address'] = $address_fin;
       } else {
        $response = array(
            'error' => 1,
            'message' => 'No Address as Input',
        );
        wp_redirect('/');
       }
    } else {

        $response = array(
            'error' => 1,
            'message' => 'No Address as Input',
        );
        wp_redirect('/');
    }
        
    }

    $terms = get_terms( array(
        'taxonomy'   => 'delivery_zone',
        'hide_empty' => false, // Set to true to only show terms with posts
    ) );
    
    // Check if terms are found
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

        //getting the client lattitude and Longitude
        $address = urlencode($address);
        // echo $address;
        // $apiKey = " 6c4e80f8f75542808126942900ffdcbd";
        $apiKey = "6c4e80f8f75542808126942900ffdcbd";
        $url = "https://api.opencagedata.com/geocode/v1/json?q={$address}&key={$apiKey}";
        $response = file_get_contents($url);
        $json = json_decode($response, true);
        
        if (isset($json['results'][0])) {
           $lat = $json['results'][0]['geometry']['lat'];
          $lng = $json['results'][0]['geometry']['lng'];
            if($lat == "" && $lng == "") {
                $response = array(
                    'error' => 1,
                    'message' => 'Invalid Address',
                );
                return $response;
            }

            $delivery_zone_ids = [];
            foreach ( $terms as $term ) {
                $lattitude = get_field( 'lattitude', 'delivery_zone_' . $term->term_id );
                $longitude = get_field( 'longitude', 'delivery_zone_' . $term->term_id );
                $range = get_field( 'range', 'delivery_zone_' . $term->term_id );
                $distance = calculate_distance_miles($lattitude , $longitude , $lat , $lng);
                if(round($distance, 2) < $range) {
                    $delivery_zone_ids[] = $term->term_id;
                    // wp_send_json_success($response);
                }
            }
            if(empty($delivery_zone_ids)) {
                $response = array(
                    'error' => 1,
                    'message' => 'No Delivery Zoon is near your address',
                );
                return $response;
            }else{
                $args = array(
                    'post_type'   => 'restaurant', // The custom post type
                    'posts_per_page' => -1, // Retrieve all matching posts
                    'fields'      => 'ids', // Only get post IDs
                    'tax_query'   => array(
                        array(
                            'taxonomy' => 'delivery_zone', // The custom taxonomy
                            'field'    => 'term_id', // We are querying by term ID
                            'terms'    => $delivery_zone_ids, // The array of term IDs
                        ),
                    ),
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                   return $query->posts; // Get the array of post IDs
                }
                // return $delivery_zone_ids;
            }
        } else {
            $response = array(
                'error' => 1,
                'message' => 'Invalid Address',
            );
            return $response;
        }
    } else {
        $response = array(
            'error' => 1,
            'message' => 'No Delivery Zone Available',
        );
        return $response;
    }

}



// add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
//     @session_start();
//     $restaurant_ids = get_all_delivery_zone_near_address($_SESSION['address']);
//     if ( is_main_query() && $query->is_main_query() ) {
//         $query->set( 'meta_query', array(
//             array(
//                 'key' => 'restaurant',
//                 'value' => $restaurant_ids,
//                 'compare' => 'in'
//             )
//         ));
//     }
//     return $is_main_query;
// }, 10, 2);


// function custom_pre_get_posts( $query ) {
//     // Avoid running on admin pages and avoid modifying the query multiple times
//     if ( $query->is_main_query() && !isset( $query->query_vars['custom_meta_query_added'] ) ) {
//         @session_start();
//         $restaurant_ids = get_all_delivery_zone_near_address($_SESSION['address']);
//         // Add your custom meta_query condition
//         $query->set( 'meta_query', array(
//             array(
//                 'key' => 'restaurant',
//                 'value' => $restaurant_ids,
//                 'compare' => 'in'
//             )
//         ));

//         // Set a flag to prevent infinite loops
//         $query->set( 'custom_meta_query_added', true );
//     }
// }
// add_action( 'pre_get_posts', 'custom_pre_get_posts' );

add_filter( 'facetwp_query_args', function( $args, $class ) {
    // echo "<pre>";
    // print_r($query);
    // print_r($class);
    // echo "</pre>";
    if ( isset( $class->ajax_params['facets']['dite'] ) || isset( $class->ajax_params['facets']['cuisine'] ) || isset( $class->ajax_params['facets']['feature'] )) {
        @session_start();
        $restaurant_ids = get_all_delivery_zone_near_address($_SESSION['address']);
        $args['meta_query'][] = array(
            'key' => 'restaurant',
            'value' => $restaurant_ids,
            'compare' => 'in'
        );
    }
    
    return $args;
}, 10, 2);


add_filter( 'facetwp_query_args', function( $query_args, $class ) {
    if( is_search() ) {
        @session_start();
        if( isset( $_SESSION['address'] ) ) {
            $restaurant_ids = get_all_delivery_zone_near_address( $_SESSION['address'] );
            
            // Check if $restaurant_ids is set and not empty
            if( !empty( $restaurant_ids ) ) {
                $query_args['meta_query'][] = array(
                    'key' => 'restaurant',
                    'value' => $restaurant_ids,
                    'compare' => 'IN'
                );
            }
        }
    }

    return $query_args;
}, 10, 2 );


add_action('wp_ajax_woocommerce_quick_view', 'woocommerce_quick_view');
add_action('wp_ajax_nopriv_woocommerce_quick_view', 'woocommerce_quick_view');

function woocommerce_quick_view() {
    $product_id = absint($_POST['product_id']);
    $product = wc_get_product($product_id);
    $screen = (isset($_POST['screen']) && !empty($_POST['screen']))?$_POST['screen']:'';

    $product_title = $product->get_name(); // Get the product title$product_title = $product->get_name(); // Get the product title = $product->get_name(); // Get the product title
    $nutrition_label_image ='';
    $nutrition_label_image_meta_data = $product->get_meta('nutrition_label_image');
    if ($nutrition_label_image_meta_data) {
        $nutrition_label_image_obj_data = get_field('nutrition_label_image', $product_id);
        if (is_array($nutrition_label_image_obj_data) && isset($nutrition_label_image_obj_data['url']))
        {
            $nutrition_label_image = wp_get_attachment_image($nutrition_label_image_meta_data, 'full', false, ['class' => 'img-fluid dish-img','data-lity'=>'']);
        }
    }
    if ($product) {
        $product_image_id = $product->get_image_id();

        // Get the full image URL for lightbox
        $product_image_url = wp_get_attachment_url( $product_image_id );
        $produt_label_image = wp_get_attachment_image( $product_image_id, 'full', false, array(
            'class' => 'img-fluid dish-img',
            'data-lity' => '', // Add data-lity attribute here
            'src' => $product_image_url // Optional: ensure the correct image URL is passed
        ));
        ob_start();
        ?>
        <div class="dish-wrapper restaurant-product-detail-mobile" <?php if($screen=="mobile"):?>style="top:65px"<?php endif;?>>
        <!-- <img class="img-fluid dish-img" src="./images/restaurant/image 23.png" alt=""> -->
        <a class="close-product display-mobile" style="cursor:pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7096 22.959C16.3567 22.959 16.0063 22.8056 15.7671 22.5083L9.93323 15.2583C9.57314 14.81 9.57798 14.1696 9.94652 13.7274L15.9882 6.47736C16.4147 5.96503 17.1772 5.89615 17.6907 6.32269C18.2031 6.74923 18.2719 7.51169 17.8442 8.02403L12.4369 14.514L17.6509 20.9931C18.0689 21.5127 17.9868 22.2739 17.466 22.692C17.2436 22.872 16.9754 22.959 16.7096 22.959Z" fill="white"/>
        </svg></a>
        <?php if(!empty($nutrition_label_image)):?>
                <div class="products-images-data">
                    <div class="product-meal-iamge">
                        <?php echo $produt_label_image; ?>
                    </div>
                    <div class="product-meal-nutition-label-image">
                        <?php echo $nutrition_label_image; ?>
                    </div>
                </div>
        <?php else:?>
            <?php echo $produt_label_image; ?>
        <?php endif;?>
                    <div class="dish-txt">
                        <div class="dish-name-wrap">
                            <h2><?php echo $product->get_name() ?></h2>
                            <span class="dis-price"><?php echo $product->get_price_html() ?></span>
                        </div>
                        <p class="dish-discription"><?php echo $product->get_short_description() ?></p>
                            <?php
                            // Add "Add to Cart" form with quantity input
                            echo '<form class="cart" action="' . esc_url( get_permalink($product_id) ) . '" method="post" enctype="multipart/form-data">';
                            ?>
                        <div class="order-quantity-wrapper">
                            <div class="order-tag-wrap">
                                <?php
                                $tags = get_the_terms($product_id, 'tag');
                                // the_tags('<p class="r-tag">', '</p><p class="r-tag">', '</p>'); 
                                if ($tags && !is_wp_error($tags)) :
                                    // echo '<ul>';
                                    foreach ($tags as $tag) {
                                        echo '<span class="order-tag">' . esc_html($tag->name) . '</span>'; // Display tag name
                                    }
                                endif;
                                ?>
                            </div>

                            <div class="number">
                                <span class="minus"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0835 8.08317H2.91683C2.59483 8.08317 2.3335 7.82242 2.3335 7.49984C2.3335 7.17725 2.59483 6.9165 2.91683 6.9165H11.0835C11.4061 6.9165 11.6668 7.17725 11.6668 7.49984C11.6668 7.82242 11.4061 8.08317 11.0835 8.08317Z" fill="white"></path>
                                </svg></span>
                                <?php
                                    // Quantity input field
                                    woocommerce_quantity_input( array(
                                        'min_value'   => apply_filters('woocommerce_quantity_input_min', 1, $product),
                                        'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                                        'input_value' => 1, // Starting value
                                        'classes' => 'quantity',
                                        "type" => "text"
                                    ), $product );
                                ?>
                                <!-- <input class="quantity" type="text" value="1"> -->
                                <span class="plus"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0835 6.91683H7.5835V3.41683C7.5835 3.09425 7.32216 2.8335 7.00016 2.8335C6.67816 2.8335 6.41683 3.09425 6.41683 3.41683V6.91683H2.91683C2.59483 6.91683 2.3335 7.17758 2.3335 7.50016C2.3335 7.82275 2.59483 8.0835 2.91683 8.0835H6.41683V11.5835C6.41683 11.9061 6.67816 12.1668 7.00016 12.1668C7.32216 12.1668 7.5835 11.9061 7.5835 11.5835V8.0835H11.0835C11.4055 8.0835 11.6668 7.82275 11.6668 7.50016C11.6668 7.17758 11.4055 6.91683 11.0835 6.91683Z" fill="white"></path>
                                  </svg></span>
                            </div>
                        </div>
                        <style type="text/css">
                            /* For Chrome, Safari, Edge, Opera */
                            .quantity::-webkit-inner-spin-button,
                            .quantity::-webkit-outer-spin-button {
                                -webkit-appearance: none;
                                margin: 0;
                            }

                            /* For Firefox */
                            .quantity {
                                -moz-appearance: textfield;
                            }
                        </style>
                        <?php echo $product->get_description(); ?>
                        <?php 


                            // Add to Cart button
                        echo '<button type="submit" class="add-to-cart-meal single_add_to_cart_button_ajax button alt"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0832 11.375C11.0832 11.8586 10.6912 12.25 10.2082 12.25C9.72517 12.25 9.33317 11.8586 9.33317 11.375C9.33317 10.8914 9.72517 10.5 10.2082 10.5C10.6912 10.5 11.0832 10.8914 11.0832 11.375V11.375ZM5.24984 11.375C5.24984 11.8586 4.85784 12.25 4.37484 12.25C3.89184 12.25 3.49984 11.8586 3.49984 11.375C3.49984 10.8914 3.89184 10.5 4.37484 10.5C4.85784 10.5 5.24984 10.8914 5.24984 11.375V11.375ZM9.556 8.16667H5.11217L4.15725 4.66667H11.306L9.556 8.16667ZM12.2983 4.053C12.0842 3.7065 11.7132 3.5 11.306 3.5H3.83934L3.47942 2.17992C3.41 1.92617 3.17959 1.75 2.9165 1.75H1.74984C1.42725 1.75 1.1665 2.01133 1.1665 2.33333C1.1665 2.65533 1.42725 2.91667 1.74984 2.91667H2.47084L4.10359 8.90342C4.173 9.15717 4.40342 9.33333 4.6665 9.33333H9.9165C10.1376 9.33333 10.3394 9.2085 10.4386 9.01075L12.3496 5.18817C12.5316 4.82358 12.5123 4.3995 12.2983 4.053V4.053Z" fill="white"></path>
                      </svg> Add to Cart</button>';
                            
                            // Hidden fields required for adding the product to cart
                            echo '<input type="hidden" name="add-to-cart" value="' . esc_attr($product_id) . '">';
                            echo '</form>'; 
                        ?>
                      <p class="cart-suggetion-para">Add (1) more plate from this shop to check out!</p>
                    </div>
                </div>
                    <?php
    }
    wp_die();
}

function add_product_to_cart() {
    $product_id = absint($_POST['product_id']);
    $quantity = absint($_POST['quantity']);

    $added = WC()->cart->add_to_cart($product_id, $quantity);

    if ($added) {
        // If the product was successfully added to the cart
        wp_send_json_success(array(
            'message' => 'Product added to cart',
        ));
    } else {
        // If there was an issue adding the product to the cart
        wp_send_json_error(array(
            'message' => 'Failed to add product to cart',
        ));
    }

    wp_die();
}
add_action('wp_ajax_add_product_to_cart', 'add_product_to_cart');
add_action('wp_ajax_nopriv_add_product_to_cart', 'add_product_to_cart');

function enqueue_quick_view_scripts() {
    wp_localize_script('quick-view-js', 'quick_view_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_quick_view_scripts');


function enqueue_wc_cart_fragments() {
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script( 'wc-cart-fragments', WC()->plugin_url() . '/assets/js/frontend/cart-fragments.min.js', array( 'jquery', 'wp-util' ), WC()->version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_wc_cart_fragments' );



function ts_remove_proceed_to_checkout_button() {
    if (is_cart() || is_checkout()) {
        $vendor_items_count = array();
        $cart_threshold_value = get_option('cart_threshold_value');

        if(empty(WC()->cart->get_cart())){
            return false;
        }

        // Loop through each item in the cart
        foreach ( WC()->cart->get_cart() as $cart_item ) {
            // Get the product ID
            $product_id = $cart_item['product_id'];
            
            // Get the Restaurant ID (replace with your actual method to retrieve the vendor)
            $restaurant_id = get_post_meta( $product_id, 'restaurant', true ); // Adjust this line as needed
            $restaurant_name = get_post_field('post_title', $restaurant_id);
            // Initialize count for this vendor if it doesn't exist
            if ( ! isset( $vendor_items_count[ $restaurant_id ] ) ) {
                $vendor_items_count[ $restaurant_id ] = ['product_count' => 0, 'name' => $restaurant_name];
            }

            // Increase count for this vendor
            $vendor_items_count[ $restaurant_id ]['product_count'] += $cart_item['quantity'];
        }

        // Check if any vendor has less than $cart_threshold_value product count
        foreach ( $vendor_items_count as $restaurant_id => $restaurant ) {
            if ( $restaurant['product_count'] < $cart_threshold_value ) {
                if(is_checkout()){
                    wp_redirect("/cart");
                    die;
                }
                remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 30);
                wc_add_notice( sprintf( 'You must add at least '.$cart_threshold_value.' items from vendor <b>%s</b> to proceed to checkout.', $restaurant['name'] ), 'error' );
            }
        }
    }
}
add_action('template_redirect', 'ts_remove_proceed_to_checkout_button');

function custom_order_again_button( $actions, $order ) {

    // if ( $order->has_status( 'completed' ) ) {
        $order_again_url = add_query_arg( 'order_again', $order->get_id(), wc_get_cart_url() );
        echo '<a href="' . esc_url( $order_again_url ) . '" class="order-again">' . __( 'Order Again', 'woocommerce' ) . '</a>';
    // }
}
add_action( 'woocommerce_my_account_my_orders_actions', 'custom_order_again_button',10,2 );

// Process adding products to the cart
function custom_order_again() {
    if ( isset( $_GET['order_again'] ) ) {
        $order_id = absint( $_GET['order_again'] );
        $order = wc_get_order( $order_id );

        if ( $order ) {
            foreach ( $order->get_items() as $item ) {
                $product_id = $item->get_product_id();
                $quantity = $item->get_quantity();

                // Check if the product is still available
                $product = wc_get_product( $product_id );
                if ( $product && $product->is_purchasable() && $product->is_in_stock() ) {
                    WC()->cart->add_to_cart( $product_id, $quantity );
                }
            }

            // Redirect to cart after adding products
            wp_safe_redirect( wc_get_cart_url() );
            exit;
        }
    }
}
add_action( 'template_redirect', 'custom_order_again' );

function get_first_product_from_order( $order ) {

    if ( ! $order ) {
        return null; // If order doesn't exist, return null
    }

    // Get order items
    $items = $order->get_items();
    
    if ( ! empty( $items ) ) {
        // Get the first item
        $first_item = reset( $items ); // Get the first item in the array
        
        // Get product ID and other details
        $product_id = $first_item->get_product_id();
        $product = wc_get_product( $product_id );
        
        if ( $product ) {
            // Get product name
            $product_name = $product->get_name();
            
            // Get product thumbnail (using WooCommerce function)
            $thumbnail = $product->get_image(); // Returns HTML of the image
            
            return array(
                'name'      => $product_name,
                'thumbnail' => $thumbnail,
            );
        }
    }
    
    return null;
}


function custom_my_account_menu_order( $items ) {
    // Reorder menu items
    $new_order = array(
        // 'dashboard'     => __( 'Dashboard', 'woocommerce' ),
        'edit-account'  => __( 'Profile', 'woocommerce' ),
        'edit-address'    => __( 'Delivery Address', 'woocommerce' ),
        'payment-methods' => __( 'Billing', 'woocommerce' ),
        'orders'        => __( 'Order History', 'woocommerce' ),
        'customer-logout' => __( 'Logout', 'woocommerce' ),
        // 'help' => __('Help', 'woocommerce'),
    );
    return $new_order;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_order' );
// Add new tab
function custom_add_help_tab( $items ) {
    // $items['help'] = __( 'Help', 'woocommerce' );
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_add_help_tab' );


// Add the endpoint for the new tab
function custom_add_help_endpoint() {
    add_rewrite_endpoint( 'help', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'custom_add_help_endpoint' );

// Flush rewrite rules on plugin/theme activation (to make the new endpoint work)
function flush_rewrite_rules_on_activation() {
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'flush_rewrite_rules_on_activation' );

// Add query var for the custom endpoint
function custom_wc_endpoint_query_vars( $vars ) {
    $vars[] = 'help';
    return $vars;
}
add_filter( 'query_vars', 'custom_wc_endpoint_query_vars', 0 );

// Handle the content of the help tab
function custom_help_tab_content() {
    
    ?>
<div class="faq-section help-tab">
    <div class=" faq-content-tab">
        <div class="faq-content">
            <div class="accordion" id="accordionExample">
            <?php
            $args = array(
                'post_type' => 'faqs',
                'posts_per_page' => -1, // Display all FAQs
                'order' => 'ASC' // Order by title or date
            );
            $faq_query = new WP_Query($args);
            if ($faq_query->have_posts()) : 
                $k = 0;
                while ($faq_query->have_posts()) : $faq_query->the_post(); 
            ?>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading<?php echo $k+1 ?>">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $k+1 ?>" aria-expanded="true" aria-controls="collapseOne">
                        <?php the_title(); ?>
                    </button>
                  </h2>
                  <div id="collapse<?php echo $k+1 ?>" class="accordion-collapse collapse <?php echo ($k == 0)?"show":""; ?>" aria-labelledby="heading<?php echo $k+1 ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php the_content(); ?>
                    </div>
                  </div>
                </div>
                    <div class="faq-item">
                        <h2></h2>
                        <div class="faq-content"></div>
                    </div>
            <?php 
                $k++;
                endwhile; 
                wp_reset_postdata(); 
            else : 
            ?>
                <p>No FAQs found.</p>
            <?php endif; ?>

            </div>
            <div style="height: 54px;"></div>
            <?php echo do_shortcode('[contact-form-7 id="d89375f" title="Contact us"]'); ?>
        </div>
    </div>
</div>
    <?php

}
add_action( 'woocommerce_account_help_endpoint', 'custom_help_tab_content' );

// Add custom fields to the Edit Account page
function custom_add_account_fields() {
    $user_id = get_current_user_id();
    $custom_field_value = get_user_meta( $user_id, 'delivery_instructions', true );
    $phone_number = get_user_meta( $user_id, 'billing_phone', true ); // Get the user's phone number
?>
    <!-- <div class="row mb-14px">
        <div class="col">
            <label class="form-label" for="delivery_instructions"><?php _e( 'Delivery instructions', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="text" class="form-control woocommerce-Input woocommerce-Input--text input-text" name="delivery_instructions" id="delivery_instructions" value="<?php echo esc_attr( $custom_field_value ); ?>" />
        </div>
    </div> -->
    <div class="row mb-14px">
        <div class="col">
            <label class="form-label" for="billing_phone"><?php _e( 'Phone Number', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="tel" class="form-control woocommerce-Input woocommerce-Input--text input-text custom_billing_phone_number" name="billing_phone" id="billing_phone" value="<?php echo esc_attr( $phone_number ); ?>" />
        </div>
    </div>
<?php
}
add_action( 'woocommerce_edit_account_form', 'custom_add_account_fields' );

// Save the custom field value
function custom_save_account_fields( $user_id ) {
    if ( isset( $_POST['delivery_instructions'] ) ) {
        update_user_meta( $user_id, 'delivery_instructions', sanitize_text_field( $_POST['delivery_instructions'] ) );
    }

    if ( isset( $_POST['billing_phone'] ) ) {
        update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
}
add_action( 'woocommerce_save_account_details', 'custom_save_account_fields' );

// Prevent login if the account is marked as deleted
function custom_prevent_login_for_deleted_account( $user ) {
    if ( ! is_wp_error( $user ) ) {
        $account_status = get_user_meta( $user->ID, 'account_status', true );
        
        if ( 'deleted' === $account_status ) {
            return new WP_Error( 'account_deleted', __( 'Your account has been deleted. Please contact support.', 'woocommerce' ) );
        }
    }
    
    return $user;
}
add_filter( 'wp_authenticate_user', 'custom_prevent_login_for_deleted_account', 10, 1 );


// Mark the account as deleted and log the user out
function custom_delete_account_and_logout() {
    if ( isset( $_GET['delete_account'] ) && 'true' === $_GET['delete_account'] && is_user_logged_in() ) {
        $user_id = get_current_user_id();
        
        // Mark the user account as deleted by adding a user meta field
        update_user_meta( $user_id, 'account_status', 'deleted' );
        
        // Log the user out
        wp_logout();

        // Redirect to a confirmation page or homepage
        wp_redirect( home_url() );
        exit;
    }
}
add_action( 'template_redirect', 'custom_delete_account_and_logout' );

// Remove product links from the My Account order details page
add_filter('woocommerce_order_item_name', 'remove_product_links_from_order_detail', 10, 2);

function remove_product_links_from_order_detail($product_name, $item) {
    // Remove the link only on the 'view-order' page in the My Account section
    if (is_account_page() && isset($_GET['view-order'])) {
        $product_name = $item->get_name(); // Get only the product name without the link
    }
    return $product_name;
}

add_filter('woocommerce_checkout_fields', 'custom_checkout_fields');

function custom_checkout_fields($fields) {
    @session_start();
   // Set default value for Country (replace 'US' with the desired country code)
    @$fields['billing']['billing_country']['default'] = $_SESSION['address_components']['ISO_3166-1_alpha-2'];
    @$fields['billing']['billing_country']['custom_attributes'] = array('disabled' => 'disabled'); // Disable the country field

    // Set default value for State (replace 'NY' with the desired state code)
    @$fields['billing']['billing_state']['default'] = $_SESSION['address_components']['state_code'];
    @$fields['billing']['billing_state']['custom_attributes'] = array('disabled' => 'disabled'); // Disable the state field

    // Set default value for City (replace 'New York' with the desired city name)
    @$fields['billing']['billing_city']['default'] = $_SESSION['address_components']['city'];;
    @$fields['billing']['billing_city']['custom_attributes'] = array('readonly' => 'readonly'); // Make the city field read-only

    // Add hidden inputs to ensure the values are submitted
    add_action('woocommerce_after_checkout_billing_form', 'add_hidden_fields');

    return $fields;
}

function add_hidden_fields() {
    // Check if the session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Initialize variables
    $country = '';
    $state = '';

    if (!empty($_SESSION) && isset($_SESSION['address']) && !empty($_SESSION['address'])) 
    {
        $address = $_SESSION['address'];
        $add_components_data = getAddressComponents($address);

        $country = $add_components_data['country_short_name'];
        $state = $add_components_data['state_short_name'];
    }

    // Output hidden inputs for country and state
    echo '<input type="hidden" name="billing_country" value="'.esc_attr($country).'">';
    echo '<input type="hidden" name="billing_state" value="'.esc_attr($state).'">';
}


function custom_override_billing_fields( $fields ) {
    // Remove the phone number field from the billing form
    unset($fields['billing_phone']);
    return $fields;
}
add_filter( 'woocommerce_billing_fields', 'custom_override_billing_fields' );


function custom_add_custom_field_billing( $fields ) {
    $fields['billing_delivery_instructions'] = array(
        'type'        => 'text',
        'label'       => __('Delivery Instructions', 'woocommerce'),
        'placeholder' => _x('Enter Delivery Instructions', 'placeholder', 'woocommerce'),
        'required'    => false,  // You can set to false if not required
        'class'       => array('form-row-wide'),
        'clear'       => true,
        'priority'    => 90,  // Adjust priority to change position
    );
    return $fields;
}
add_filter( 'woocommerce_billing_fields', 'custom_add_custom_field_billing' );

function save_custom_billing_address_fields( $customer_id, $load_address ) {
    if ( isset( $_POST['billing_delivery_instructions'] ) ) {
        update_user_meta( $customer_id, 'billing_delivery_instructions', sanitize_text_field( $_POST['billing_delivery_instructions'] ) );
    }
}
add_action( 'woocommerce_customer_save_address', 'save_custom_billing_address_fields', 10, 2 );

function display_custom_field_admin_order( $order ) {
    $custom_field = get_post_meta( $order->get_id(), '_billing_custom_field', true );
    if ( $custom_field ) {
        echo '<p><strong>'.__('Custom Field').':</strong> ' . $custom_field . '</p>';
    }
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_custom_field_admin_order', 10, 1 );





















// Hook into the admin menu to add a new options page
add_action('admin_menu', 'my_custom_settings_page');
function my_custom_settings_page() {
    add_options_page(
        'Website Settings',     // Page title
        'Website Settings',     // Menu title
        'manage_options',      // Capability required
        'website-settings',  // Menu slug
        'website_settings_page_html' // Callback function to display the page
    );
}

// HTML for the options page
function website_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Check if settings were saved
    if (isset($_GET['settings-updated'])) {
        add_settings_error('my_custom_messages', 'my_custom_message', __('Settings Saved', 'Relish'), 'updated');
    }

    // Display messages (errors or success)
    settings_errors('my_custom_messages');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Security fields for the registered setting
            settings_fields('cart_page');
            // Output the sections and fields for the page
            do_settings_sections('my-custom-settings');
            // Save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

// Hook into admin init to register settings
add_action('admin_init', 'my_custom_settings_init');
function my_custom_settings_init() {
    // Register a new setting to store the value in the options table
    register_setting(
        'cart_page',  // Option group
        'cart_threshold_value'           // Option name
    );

    // Add a new section to the settings page
    add_settings_section(
        'my_custom_settings_section', // Section ID
        __('Website Settings Section', 'Relish'), // Section title
        'my_custom_settings_section_cb', // Section callback
        'my-custom-settings' // Page slug
    );

    // Add a new field to the section
    add_settings_field(
        'cart_threshold_value', // Field ID
        __('Set cart threshold value', 'Relish'), // Field title
        'my_custom_option_field_cb', // Field callback
        'my-custom-settings', // Page slug
        'my_custom_settings_section' // Section ID
    );
}

// Section callback function
function my_custom_settings_section_cb() {
    // echo '<p>' . __('Enter your custom setting below:', 'textdomain') . '</p>';
}

// Field callback function
function my_custom_option_field_cb() {
    $option_value = get_option('cart_threshold_value');
    ?>
    <input type="number" name="cart_threshold_value" value="<?php echo esc_attr($option_value); ?>" />
    <?php
}

// Function to convert time and create a shortcode
function convert_time_format_shortcode() {
    // Get the time from the ACF options page
    $order_deadline_time = get_field('order_time_deadline', 'option'); // This should return '23:30' or a similar format

    // Check if time is available
    if ( $order_deadline_time ) {
        // Convert the 24-hour format to 12-hour format
        $time_12hr_format = date("g:i A", strtotime($order_deadline_time)); // This will convert 23:30 to 11:30 PM
        return $time_12hr_format;
    } else {
        return 'No time available';
    }
}

// Register the shortcode [convert_time]
add_shortcode('convert_time', 'convert_time_format_shortcode');


function get_upcoming_day_date_shortcode() {
    // Get the day from the ACF options page
   $order_deadline_day = get_field('order', 'option'); // This should return something like 'Wednesday'

    // Check if a day is available
    if ( $order_deadline_day ) {
        // Calculate the next occurrence of that day
        $now = new DateTime(); // Current date and time
        $next_day = new DateTime("next $order_deadline_day");

        // If today is the given day, set it to today
        if ($now->format('l') === $order_deadline_day) {
            $next_day = $now; // Today is the deadline day
        }

        // Format the date to 'Wednesday August 21'
        $formatted_date = $next_day->format('l F j');

        return $formatted_date;
    } else {
        return 'No day available';
    }
}

// Register the shortcode [upcoming_day]
add_shortcode('upcoming_day', 'get_upcoming_day_date_shortcode');


function calculate_delivery_date_shortcode() {
    // Get the order deadline day and delivery day from the ACF options page
    $order_deadline_day = get_field('order', 'option'); // E.g., 'Wednesday'
    $delivery_day = get_field('order_delivery__date', 'option'); // E.g., 'Saturday'
    $order_deadline_time = get_field('order_time_deadline', 'option'); // Dynamic time (e.g., 23:59)

    // Check if the fields are available
    if (!$order_deadline_day || !$delivery_day) {
        return 'No deadline or delivery day available';
    }

    // Set default values if time is not provided
    if (!$order_deadline_time) {
        $order_deadline_time = '23:59'; // Fallback
    }

    // Get the current date and time
    $now = new DateTime();
    $now_day_name = $now->format('l'); // Get current day name

    // Calculate the next occurrence of the order deadline day
    $current_week_order_deadline = clone $now;
    $current_week_order_deadline->modify("this week $order_deadline_day"); // Set to this week's deadline
    // Modify the current week's order deadline to include the specified time
    $order_deadline_datetime = clone $current_week_order_deadline; // Clone the date object
    $order_deadline_datetime->setTime((int)substr($order_deadline_time, 0, 2), (int)substr($order_deadline_time, 3)); // Set dynamic time
   
    // Check if the order deadline has passed
    if ($now < $order_deadline_datetime) {
        // Order deadline has passed, so set to next week's delivery day
        $next_delivery_date = new DateTime("next $delivery_day");
    } else {
        // Order deadline has not passed, show this week's delivery date
        $next_delivery_date = clone $current_week_order_deadline; // Keep this week's order deadline
        if ($now_day_name === $delivery_day) {
            $next_delivery_date = $now; // If today is delivery day, set to now
        } else {
            $next_delivery_date = new DateTime("next $delivery_day + 7 days");
        }
    }

    // Format the date to 'Saturday August 24'
    $formatted_delivery_date = $next_delivery_date->format('l F j');

    return $formatted_delivery_date;
}

// Register the shortcode [delivery_date]
add_shortcode('delivery_date', 'calculate_delivery_date_shortcode');

// Get restaurant_signature_plates
function get_specific_restaurant_signature_plates($restaurant_id)
{
    // Get the ACF field value for the given restaurant ID
    $signature_plates = get_field('restaurant_signature_plates', $restaurant_id);
    
    // Return the values if present, otherwise return an empty array
    return !empty($signature_plates) ? $signature_plates : [];
}

// Register the Product Signature Plate ACF field programmatically
function register_product_signature_plate_acf_field() {
    if( function_exists('acf_add_local_field_group') ) {
        
        // Add the Product Signature Plate field group
        acf_add_local_field_group(array(
            'key' => 'group_product_signature_plate',
            'title' => 'Product Signature Plate',
            'fields' => array(
                array(
                    'key' => 'field_product_signature_plate',
                    'label' => 'Product Signature Plate',
                    'name' => 'product_signature_plate',
                    'type' => 'select',
                    'instructions' => 'Select the signature plate for this product.',
                    'required' => 0,
                    'multiple' => 0, // Allow multiple selections if 1
                    'ui' => 1, // Use enhanced select UI
                    'choices' => array(), // Choices will be populated dynamically
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product', // Ensure it's for the 'product' post type
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'register_product_signature_plate_acf_field');

// Populate fields programatically in restaurant_signature_plates
function populate_product_signature_plate_field($field) {
    // Reset choices
    $field['choices'] = [];

    // Get the current post ID (product post)
    $product_id = get_the_ID();

    // Get the associated restaurant from the post object/relationship field in the product
    $restaurant_id = get_field('restaurant', $product_id); // Assuming 'restaurant' is the ACF field name for the selected restaurant

    // If a restaurant is selected
    if ($restaurant_id) {
        // Get the 'restaurant_signature_plates' field for the selected restaurant
        $signature_plates = get_field('restaurant_signature_plates', $restaurant_id);

        // If there are plates, populate them in the product field options
        if (!empty($signature_plates)) {
            foreach ($signature_plates as $plate) {
                // Add the plate to the choices of the 'product_signature_plate' field
                $field['choices'][$plate] = $plate;
            }
        }
    }

    return $field;
}
add_filter('acf/load_field/name=product_signature_plate', 'populate_product_signature_plate_field');


// Handle AJAX request to get restaurant signature plates
function ajax_get_signature_plates() {
    // Check if restaurant ID is provided
    if (isset($_POST['restaurant_id'])) {
        $restaurant_id = intval($_POST['restaurant_id']);

        // Get the 'restaurant_signature_plates' field for the selected restaurant
        $signature_plates = get_field('restaurant_signature_plates', $restaurant_id);

        // If plates exist, return them as JSON
        if (!empty($signature_plates)) {
            wp_send_json_success($signature_plates);
            wp_die();
        } else {
            wp_send_json_error('No signature plates found.');
            wp_die();
        }
    }

    // If something goes wrong
    wp_send_json_error('Invalid request.');
    wp_die();
}

add_action('wp_ajax_get_signature_plates', 'ajax_get_signature_plates');
add_action('wp_ajax_nopriv_get_signature_plates', 'ajax_get_signature_plates'); // Allow for non-logged-in users if needed

// Enque the JS Admin Side
function enqueue_admin_custom_js() {
    // Enqueue the custom JS for admin pages
    wp_enqueue_script(
        'admin-custom-js', // Handle for the script
        get_stylesheet_directory_uri() . '/restaurants/assets/js/admin-custom.js', // Path to your custom JS file
        array('jquery'), // Dependencies (in this case, jQuery)
        time(), // Version (you can set a version number here)
        true // Load the script in the footer
    );

    // Pass AJAX URL to the script
    wp_localize_script('admin-custom-js', 'ajax_data', array(
        'ajaxurl' => admin_url('admin-ajax.php') // AJAX URL provided by WordPress
    ));
}
add_action('admin_enqueue_scripts', 'enqueue_admin_custom_js');

// Group products by restaurant
/**
 * @param restaurant_id
 * @return Array with plates but that should be in get_specific_restaurant_signature_plates
 */
function get_products_grouped_by_signature_plate($restaurant_id) {

    $restaurant_all_signature_plates = get_specific_restaurant_signature_plates($restaurant_id);

    // Define the query arguments
    $args = array(
        'post_type' => 'product',
        'facetwp' => true,
        'per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND', // Ensures all conditions must be true
            array(
                'key'     => 'restaurant', // The custom field key for restaurant
                'value'   => $restaurant_id, // The current restaurant ID
                'compare' => '=' // Comparison operator
            ),
        ),
    );

    // Query the products
    $products = new WP_Query($args);

    // Initialize an array to hold grouped products
    $grouped_products = array();
    $normal_plates = array(); // Array to hold products with no signature plate

    // Check if we have products
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();

            // Declare the global product variable
            global $product;

            // Get the product signature plate
            $signature_plates = get_field('product_signature_plate', get_the_ID());

            // If it's not empty and is not an array, convert it to an array
            if (!empty($signature_plates) && !is_array($signature_plates)) {
                $signature_plates = array($signature_plates);
            }

            // Get additional product details using the global $product variable
            $is_purchasable = $product->is_purchasable();
            $is_in_stock = $product->is_in_stock();
            $sku = $product->get_sku();
            $add_to_cart_description = get_post_meta(get_the_ID(), 'add_to_cart_description', true);
            $add_to_cart_text = apply_filters('woocommerce_product_add_to_cart_text', $product->add_to_cart_text());
            $add_to_cart_url = $product->add_to_cart_url(); // Get the add to cart URL
            $price = $product->get_price();

            // Prepare product information
            $product_data = array(
                'is_purchasable' => $is_purchasable,
                'is_in_stock' => $is_in_stock,
                'sku' => $sku,
                'add_to_cart_description' => $add_to_cart_description,
                'add_to_cart_text' => $add_to_cart_text,
                'price' => $price,
                'add_to_cart_url' => $add_to_cart_url, // Add the add to cart URL
            );

            // If there are signature plates, group products accordingly
            if (!empty($signature_plates)) {
                foreach ($signature_plates as $plate) {
                    // Check if the plate is in the restaurant's signature plates
                    if (in_array($plate, $restaurant_all_signature_plates)) {
                        // Initialize the plate array if it doesn't exist
                        if (!isset($grouped_products[$plate])) {
                            $grouped_products[$plate] = array();
                        }

                        // Add both the product object and product data to the corresponding signature plate group
                        $grouped_products[$plate][] = array(
                            'product_post_data' => $products->post, // Store the whole product object
                            'prod_information' => $product_data // Store additional product information
                        );
                    } else {
                        // If the plate is not in the restaurant's signature plates, add to normal plates
                        $normal_plates[] = array(
                            'product_post_data' => $products->post, // Store the whole product object
                            'prod_information' => $product_data // Store additional product information
                        );
                    }
                }
            } else {
                // If there are no signature plates, add the product to normal plates
                $normal_plates[] = array(
                    'product_post_data' => $products->post, // Store the whole product object
                    'prod_information' => $product_data // Store additional product information
                );
            }
        }
        wp_reset_postdata(); // Reset post data

        // If there are normal plates, add them to the grouped products under the key "Normal Plates"
        if (!empty($normal_plates)) {
            $grouped_products['Others'] = $normal_plates;
        }
    } else {
        $grouped_products = array();
    }

    return $grouped_products; // Return the grouped products
}

