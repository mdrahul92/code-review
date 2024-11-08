<?php
include_once "restaurants/functions/functions.php";
// Your code to enqueue parent theme styles
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

/**
 * Add a sidebar.
 */
function wpdocs_theme_slug_widgets_init() {

    register_nav_menus( [ 'menu-3' => esc_html__( 'Profile Menu', 'hello-elementor' ) ] );

    register_sidebar( array(
        'name'          => __( 'Footer Newsletter', 'Relish' ),
        'id'            => 'footer_newsletter',
        'description'   => __( 'Put Your Newsletter Here', 'Relish' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="footer-form-heading">',
        'after_title'   => '</h2><h4 class="footer-form-sub-heading">Wait up!</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Contact Info', 'Relish' ),
        'id'            => 'footer_contact_info',
        'description'   => __( 'Put Your Contact Info Here', 'Relish' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="footer-form-heading">',
        'after_title'   => '</h2><h4 class="footer-form-sub-heading">Wait up!</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Search page top bar text', 'Relish' ),
        'id'            => 'search_top_bar_text',
        'description'   => __( '', 'Relish' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );

/**
 * @snippet       WooCommerce User Registration Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 9
 * @community     https://businessbloomer.com/club/
 */
   
add_shortcode( 'wc_reg_form_bbloomer', 'bbloomer_separate_registration_form' );
     
function bbloomer_separate_registration_form() {
   if ( is_user_logged_in() ) return '<p>You are already registered</p>';
   ob_start();
   do_action( 'woocommerce_before_customer_login_form' );
   $html = wc_get_template_html( 'myaccount/form-login.php' );
   $dom = new DOMDocument();
   $dom->encoding = 'utf-8';
   $dom->loadHTML( utf8_decode( $html ) );
   $xpath = new DOMXPath( $dom );
   $form = $xpath->query( '//form[contains(@class,"register")]' );
   $form = $form->item( 0 );
   echo $dom->saveHTML( $form );
   return ob_get_clean();
}

function create_faq_post_type() {
    $labels = array(
        'name'                => _x('FAQs', 'Post Type General Name', 'textdomain'),
        'singular_name'       => _x('FAQ', 'Post Type Singular Name', 'textdomain'),
        'menu_name'           => __('FAQs', 'textdomain'),
        'parent_item_colon'   => __('Parent FAQ', 'textdomain'),
        'all_items'           => __('All FAQs', 'textdomain'),
        'view_item'           => __('View FAQ', 'textdomain'),
        'add_new_item'        => __('Add New FAQ', 'textdomain'),
        'add_new'             => __('Add New', 'textdomain'),
        'edit_item'           => __('Edit FAQ', 'textdomain'),
        'update_item'         => __('Update FAQ', 'textdomain'),
        'search_items'        => __('Search FAQs', 'textdomain'),
        'not_found'           => __('Not Found', 'textdomain'),
        'not_found_in_trash'  => __('Not found in Trash', 'textdomain'),
    );
     
    $args = array(
        'label'               => __('faqs', 'textdomain'),
        'description'         => __('Frequently Asked Questions', 'textdomain'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'revisions'),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    );
     
    // Registering the custom post type
    register_post_type('faqs', $args);
}
 
add_action('init', 'create_faq_post_type', 0);

// add custom.js to the theme
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-ajax-script', get_stylesheet_directory_uri() . '/js/custom-ajax.js', array('jquery'), null, true );

    // Pass the AJAX URL to the script
    wp_localize_script('custom-ajax-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


// handle address validation request
function handle_address_validation() {
    // Process the request and return a response
    if (isset($_POST['address'])) {
        $address = sanitize_text_field($_POST['address']);
        $response =check_delivery_address($address);
        // Perform your custom logic here
        $_SESSION['address'] = $address;

        echo $response; // Output the response

        // Important: always `wp_die()` at the end to terminate properly
        wp_die();
    }
}
add_action('wp_ajax_address_validation', 'handle_address_validation');
add_action('wp_ajax_nopriv_address_validation', 'handle_address_validation');

function save_user_rating( $post_id, $user_rating ) {
    $ratings = get_post_meta( $post_id, 'restaurant_ratings' );
    if ( !is_array( $ratings ) ) {
        $ratings = array();
    }
    $ratings[] = $user_rating;
    // update_post_meta( $post_id, 'restaurant_ratings', $ratings );
}

function get_total_ratings_count( $post_id ) {
    $ratings = get_post_meta( $post_id, 'restaurant_ratings' );
    // print_r($ratings);
    if ( is_array( $ratings ) ) {
        return count( $ratings );
    }
    return 0;
}

function get_average_rating( $post_id ) {
    $ratings = get_post_meta( $post_id, 'restaurant_ratings' );
    if ( is_array( $ratings ) && count( $ratings ) > 0 ) {
        $average = array_sum( $ratings ) / count( $ratings );
        return round( $average, 1 );
    }
    return null;
}

function enqueue_woocommerce_ajax_add_to_cart() {
    if ( function_exists( 'wc_enqueue_js' ) ) {
        wc_enqueue_js("
            jQuery(function($) {
                $('body').on('click', '.ajax_add_to_cart', function(e) {
                    e.preventDefault();
                    var button = $(this),
                        product_id = button.data('product_id');
                    
                    // Add to cart via AJAX
                    $.post('" . esc_url( admin_url('admin-ajax.php') ) . "', {
                        action: 'woocommerce_add_to_cart',
                        product_id: product_id,
                    }, function(response) {
                        if (response.error) {
                            // Handle error
                            console.log(response.error);
                        } else {
                            // Update mini-cart, etc.
                            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, button]);

                            // Assuming `cartFragmentData` is the JSON data object with cart fragment details.
                            let parser = new DOMParser();
                            let cartFragmentData = response.fragments
                            let cartHTML = parser.parseFromString(cartFragmentData['a.cart-contents'], 'text/html');

                            // Find the cart item count element
                            let cartCountElement = cartHTML.querySelector('.cart-contents-count');

                            // Extract the count value
                            let cartCount = cartCountElement ? parseInt(cartCountElement.textContent.trim(), 10) : 0;

                            $('.mb-cart-count').text(cartCount);
                        }
                    });
                });
            });
            jQuery(function($) {
                $('.menu-item-cart').hover(
                    function() {
                        $(this).find('.mini-cart').stop(true, true).slideDown(200);
                    }, 
                    function() {
                        $(this).find('.mini-cart').stop(true, true).slideUp(200);
                    }
                );
            });

            jQuery(function($) {
                $(document.body).on('removed_from_cart', function(event, fragments, cart_hash) {
                    let parser = new DOMParser();
                    let cartFragmentData = fragments
                    let cartHTML = parser.parseFromString(cartFragmentData['a.cart-contents'], 'text/html');

                    // Find the cart item count element
                    let cartCountElement = cartHTML.querySelector('.cart-contents-count');

                    // Extract the count value
                    let cartCount = cartCountElement ? parseInt(cartCountElement.textContent.trim(), 10) : 0;

                    $('.mb-cart-count').text(cartCount);
                });
            });
        ");
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_woocommerce_ajax_add_to_cart' );

// Add mini cart to the menu
add_filter('wp_nav_menu_items', 'add_mini_cart_to_menu', 10, 2);
function add_mini_cart_to_menu($items, $args) {
    // Replace 'primary' with the location of your menu if needed
    if ($args->theme_location == 'menu-3') {
        ob_start();
        ?>
        <li class="nav-item desktop menu-item-cart">
            <a class="nav-link nav-signup-btn cart-contents" href="/cart">
                <?php
                $cart_count = WC()->cart->get_cart_contents_count();
                $cart_total = WC()->cart->get_cart_subtotal();
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.0833 11.375C11.0833 11.8586 10.6913 12.25 10.2083 12.25C9.72529 12.25 9.33329 11.8586 9.33329 11.375C9.33329 10.8914 9.72529 10.5 10.2083 10.5C10.6913 10.5 11.0833 10.8914 11.0833 11.375ZM5.24996 11.375C5.24996 11.8586 4.85796 12.25 4.37496 12.25C3.89196 12.25 3.49996 11.8586 3.49996 11.375C3.49996 10.8914 3.89196 10.5 4.37496 10.5C4.85796 10.5 5.24996 10.8914 5.24996 11.375ZM9.55613 8.16667H5.11229L4.15738 4.66667H11.3061L9.55613 8.16667ZM12.2984 4.053C12.0843 3.7065 11.7133 3.5 11.3061 3.5H3.83946L3.47954 2.17992C3.41013 1.92617 3.17971 1.75 2.91663 1.75H1.74996C1.42738 1.75 1.16663 2.01133 1.16663 2.33333C1.16663 2.65533 1.42738 2.91667 1.74996 2.91667H2.47096L4.10371 8.90342C4.17313 9.15717 4.40354 9.33333 4.66663 9.33333H9.91663C10.1377 9.33333 10.3395 9.2085 10.4387 9.01075L12.3497 5.18817C12.5317 4.82358 12.5125 4.3995 12.2984 4.053Z" fill="white"/></svg><?php echo esc_html($cart_count); ?>
            </a>
            <div class="mini-cart">
                <?php woocommerce_mini_cart(); ?>
            </div>
        </li>
        <?php
        $items .= ob_get_clean();
    }
    return $items;
}

// Ensure the mini cart updates via AJAX
add_filter('woocommerce_add_to_cart_fragments', 'update_mini_cart_fragments');
function update_mini_cart_fragments($fragments) {
    ob_start();
    ?>
    <a class="cart-contents nav-link nav-signup-btn" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woocommerce'); ?>">
        <?php
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_total = WC()->cart->get_cart_subtotal();
        ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.0833 11.375C11.0833 11.8586 10.6913 12.25 10.2083 12.25C9.72529 12.25 9.33329 11.8586 9.33329 11.375C9.33329 10.8914 9.72529 10.5 10.2083 10.5C10.6913 10.5 11.0833 10.8914 11.0833 11.375ZM5.24996 11.375C5.24996 11.8586 4.85796 12.25 4.37496 12.25C3.89196 12.25 3.49996 11.8586 3.49996 11.375C3.49996 10.8914 3.89196 10.5 4.37496 10.5C4.85796 10.5 5.24996 10.8914 5.24996 11.375ZM9.55613 8.16667H5.11229L4.15738 4.66667H11.3061L9.55613 8.16667ZM12.2984 4.053C12.0843 3.7065 11.7133 3.5 11.3061 3.5H3.83946L3.47954 2.17992C3.41013 1.92617 3.17971 1.75 2.91663 1.75H1.74996C1.42738 1.75 1.16663 2.01133 1.16663 2.33333C1.16663 2.65533 1.42738 2.91667 1.74996 2.91667H2.47096L4.10371 8.90342C4.17313 9.15717 4.40354 9.33333 4.66663 9.33333H9.91663C10.1377 9.33333 10.3395 9.2085 10.4387 9.01075L12.3497 5.18817C12.5317 4.82358 12.5125 4.3995 12.2984 4.053Z" fill="white"></path></svg>
        <span class="cart-contents-count"><?php echo esc_html($cart_count); ?></span>
        <!-- <span class="cart-contents-total"><?php // echo $cart_total; ?></span> -->
    </a>
    <div class="mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();

    ob_start();
    ?>
    <div class="mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
    $fragments['div.mini-cart'] = ob_get_clean();


    return $fragments;
}


function custom_woocommerce_product_add_to_cart_text( $text ) {
    return __( 'Add', 'woocommerce' );
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );


add_filter( 'facetwp_facet_html', function( $output, $params ) {
        
    if ( 'price_sorting' == $params['facet']['name'] ) {
      $output .= '<div class="facetwp-sort-radio">';
      $i = 0;
      foreach ( $params['facet']['sort_options'] as $key => $atts ) {
        if($i == 0 && Count($params['selected_values']) == 0) {
            $checked = "checked";
        } else {
            $checked = "";
        }
        $output .= '<div class="facetwp-radio sort-radio '.$checked.'" data-value="' . $atts['name'] . '" data-type="sort"> ' . $atts['label'] . '</div>';
        $i++;
      }
      $output .= '</div>';
    }
  
    return $output;
  }, 10, 2 );
  // Replace 'my_sort_facet' with the name of your sort facet

  add_action( 'wp_footer', function() {
    ?>
      <script>
        (function($) {
  
            var sortfacet = 'price_sorting';
  
            $(document).on('click', '.sort-radio', function() {
                var val = $(this).attr('data-value');

                // Add 'checked' class to the clicked radio and remove from others
                $('.sort-radio').removeClass('checked');
                $(this).addClass('checked');

                // Update the select element and mark the correct option as selected
                var $select = $(this).parent().siblings("select");
                console.log($select);
                $select.val(val);  // Set the value of the select box

                // Ensure the selected option is marked as "selected"
                $select.find('option').each(function() {
                    if ($(this).val() === val) {
                        $(this).attr('selected');  // Mark this option as selected
                    } else {
                        $(this).removeAttr('selected'); // Unselect other options
                    }
                });

                document.addEventListener('facetwp-refresh', function() {
                    FWP.facets.price_sorting = [val]; // Force a specific value
                });
                FWP.refresh();


                // // Update FacetWP with the selected value
                // FWP.facets[sortfacet] = [val];

                // Optional: Delay the fetch to ensure the select element is updated in the DOM
                // setTimeout(() => {
                //     FWP.toggleOverlay('on');  // Display loading spinner
                //     FWP.fetchData();  // Fetch updated data
                //     FWP.setHash();  // Update the URL hash with the selected facet values
                // }, 300);
            });


            $(document).on('facetwp-loaded', function() {
            console.log(FWP.facets[sortfacet]);
            if ('undefined' !== typeof FWP.facets[sortfacet]) {
              $('.sort-radio').filter('[data-value="' + FWP.facets[sortfacet] + '"]').addClass("checked");
            }
          });
  
        })(jQuery);
      </script>
  
      <style>
          /* Replace 'my_sort_facet' with the name of your sort facet */
          .facetwp-facet-price_sorting select {
              display: none;
          }
          .facetwp-facet{
            margin-bottom: 0px;
          }
          
      </style>
    <?php
  }, 100 );

add_action('wp_enqueue_scripts', 'enqueue_facetwp_mobile_script');

function enqueue_facetwp_mobile_script() {
    if (is_page() || is_single()) { // Adjust to load on specific pages if needed
        wp_enqueue_script('facetwp-mobile-script', get_stylesheet_directory_uri() . '/js/facetwp-mobile.js', array('jquery'), null, true);
    }
}


add_action( 'restrict_manage_posts', 'acf_product_filter_dropdown' );
function acf_product_filter_dropdown() {
    global $typenow;

    // Only display the filter on the WooCommerce product listing page
    if ( 'product' === $typenow ) {

        // Get all 'restaurant' posts (linked via ACF post_object field)
        $restaurants = get_posts( [
            'post_type' => 'restaurant', // Adjust this to match your post_object ACF field's post type
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
        ] );

        // Output the dropdown
        if ( $restaurants ) {
            $selected_value = isset( $_GET['acf_filter'] ) ? $_GET['acf_filter'] : '';
            
            echo '<select name="acf_filter">';
            echo '<option value="">Filter by Restaurant</option>'; // Change "Restaurant" as needed
            foreach ( $restaurants as $restaurant ) {
                $selected = ( $selected_value == $restaurant->ID ) ? ' selected="selected"' : '';
                echo '<option value="' . esc_attr( $restaurant->ID ) . '"' . $selected . '>' . esc_html( $restaurant->post_title ) . '</option>';
            }
            echo '</select>';
        }
    }
}




add_action( 'pre_get_posts', 'filter_products_by_acf_selection' );
function filter_products_by_acf_selection( $query ) {
    global $typenow;

    if ( 'product' === $typenow && is_admin() && $query->is_main_query() ) {
        // Check if the ACF filter is set in the URL
        if ( isset( $_GET['acf_filter'] ) && !empty( $_GET['acf_filter'] ) ) {
            // Modify the query to filter by ACF field
            $meta_query = [
                [
                    'key'     => 'restaurant',  // Replace with your ACF field name
                    'value'   => $_GET['acf_filter'],
                    'compare' => '=',
                ],
            ];
            $query->set( 'meta_query', $meta_query );
        }
    }
}

function dd($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    wp_die();
}

// Add an extra menu item on the cart page
add_filter( 'wp_nav_menu_items', function( $items, $args ) {
    // Check if it's the cart page and if the correct menu location is being rendered
    if ( is_cart() && $args->theme_location == 'menu-3' ) {
        // Add a "Go to Home" link as the first item
        $first_item = '<li class="nav-item redirect-to-home-search-page"><a href="' . home_url() . '">Go to search</a></li>';
        
        // Prepend the new item to the menu
        $items = $first_item . $items;
    }
    return $items;
}, 10, 2 );

// show payment addition page suggestion text
function payment_info_suggestion_html()
{
    $html='';
    if (is_account_page() && strpos($_SERVER['REQUEST_URI'], 'add-payment-method') !== false) {
        $html ='<div class="payment-info-suggestion woocommerce-info">';
            $html.='<span class="add-payment-info-suggestion-text">We don\'t save your card credentials</span>';
        $html.='</div>';
    }
    return $html;
}

// change Billing Address Text To Shipping Address and remove Shipping Address from my account adress array
add_filter( 'woocommerce_my_account_get_addresses', 'filter_wc_my_account_get_addresses', 10, 2 ); 
function filter_wc_my_account_get_addresses( $adresses, $customer_id ) { 
    if( isset($adresses['shipping']) ) {
        unset($adresses['shipping']);
    }

    // Change the billing address label to "Shipping Address"
    if (isset($adresses['billing'])) {
        $adresses['billing'] = __('Shipping Address', 'woocommerce');
    }
    
    return $adresses; 
}

function change_billing_to_shipping_address_text( $translated_text, $text, $domain ) {
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if ( 'woocommerce' === $domain ) {
        // Check if the text to be changed is 'Billing address'
        switch ( $translated_text ) {
            case 'Billing address':
                $translated_text = 'Shipping address';
                break;
            case 'Billing details':
                // Check if the current page is the checkout page
                if ( $actual_link === site_url('/checkout/') || $actual_link === site_url('/checkout') ) {
                    $translated_text = 'Address'; // Corrected from 'Adress' to 'Address'
                } else {
                    $translated_text = 'Shipping Details'; // No need for __() if it doesn't need translation
                }
                break;
        }
    }
    return $translated_text;
}
add_filter( 'gettext', 'change_billing_to_shipping_address_text', 20, 3 );

// Function to enqueue Google Maps API
function enqueue_google_maps_api() {
    $api_key = defined('GOOGLE_MAPS_API_KEY') ? GOOGLE_MAPS_API_KEY : '';

    if ($api_key) {
        wp_enqueue_script(
            'google-maps-api',
            'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places',
            null,
            null,
            true // Load in footer
        );
    }
}

// Enqueue for front-end
add_action('wp_enqueue_scripts', 'enqueue_google_maps_api');

// Function to enqueue Google Maps API for admin area
function enqueue_google_maps_api_admin() {
    $api_key = defined('GOOGLE_MAPS_API_KEY') ? GOOGLE_MAPS_API_KEY : '';

    if ($api_key) {
        // Enqueue the Google Maps API for admin
        wp_enqueue_script(
            'google-maps-api-admin',
            'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places',
            null,
            null,
            true // Load in footer
        );

        // Enqueue custom admin JavaScript file
        wp_enqueue_script(
            'custom-admin-js',
            get_stylesheet_directory_uri() . '/js/custom-admin.js',
            array('google-maps-api-admin'), // Dependency
            null,
            true // Load in footer
        );
    }
}

// Enqueue scripts for admin area
add_action('admin_enqueue_scripts', 'enqueue_google_maps_api_admin');

function enqueue_lity_lightbox() {
    // Enqueue Lity CSS with current timestamp as version
    wp_enqueue_style( 'lity-css', 'https://sorgalla.com/lity/dist/lity.css', array(), time() );

    // Enqueue Lity JS with current timestamp as version
    wp_enqueue_script( 'lity-js', 'https://sorgalla.com/lity/dist/lity.js', array('jquery'), time(), true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_lity_lightbox' );

function getAddressComponents($address) {
    $apiKey = defined('GOOGLE_MAPS_API_KEY') ? GOOGLE_MAPS_API_KEY : '';
    $formattedAddress = urlencode($address);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$formattedAddress}&key={$apiKey}";

    // Make the API request
    $response = file_get_contents($url);
    
    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Initialize an empty array for the result
    $addressComponents = [
        'country_full_name' => null,
        'country_short_name'=> null,
        'street_address' => null,
        'town' => null,
        'state_full_name' => null,
        'state_short_name' => null,
        'zip_code' => null
    ];

    // Check if the request was successful
    if ($responseData['status'] == 'OK') {
        // Loop through the address components to extract relevant details
        foreach ($responseData['results'][0]['address_components'] as $component) {
            // Country
            if (in_array('country', $component['types'])) {
                $addressComponents['country_full_name'] = $component['long_name'];
                $addressComponents['country_short_name'] = $component['short_name'];
            }

            // Street Address (combining street number and route)
            if (in_array('street_number', $component['types'])) {
                $addressComponents['street_address'] = $component['long_name'];
            }
            if (in_array('route', $component['types'])) {
                $addressComponents['street_address'] .= ' ' . $component['long_name'];
            }

            // Town (locality)
            if (in_array('locality', $component['types'])) {
                $addressComponents['town'] = $component['long_name'];
            }

            // State
            if (in_array('administrative_area_level_1', $component['types'])) {
                $addressComponents['state_full_name'] = $component['long_name'];
                $addressComponents['state_short_name'] = $component['short_name'];
            }

            // Zip Code
            if (in_array('postal_code', $component['types'])) {
                $addressComponents['zip_code'] = $component['long_name'];
            }
        }
    }

    // Return the final array
    return $addressComponents;
}

add_action('woocommerce_before_checkout_form', 'display_session_variables_on_checkout');

function display_session_variables_on_checkout() {
    // Start the session if it isn't already started
    if (!session_id()) {
        session_start();
    }
    $add_components_data =[];
    // Check if session variables are set
    if (!empty($_SESSION) && isset($_SESSION['address']) && !empty($_SESSION['address'])) {
        $address = $_SESSION['address'];
        $add_components_data = getAddressComponents($address);
    }

    // If address components are available, set billing details
    if (!empty($add_components_data)) {
        add_filter('woocommerce_checkout_get_value', function ($value, $key) use ($add_components_data) {
            switch ($key) {
                case 'billing_country':
                    return $add_components_data['country_short_name'];
                case 'billing_city':
                    return $add_components_data['town'];
                case 'billing_state':
                    return $add_components_data['state_short_name'];
                case 'billing_postcode':
                    return $add_components_data['zip_code'];
                default:
                    return $value; // Return the original value for other fields
            }
        }, 10, 2);
    }
}

add_filter( 'facetwp_indexer_query_args', function( $args ) {
    $args['post_type'] = ['e-floating-buttons', 'faqs', 'page', 'post', 'product', 'product_variation' , 'restaurant']; // Index only these post types
    return $args;
});

function get_all_meals_products_with_meta() {
    // Define the query arguments to get all products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1, // Get all products
        'post_status' => 'publish', // Only get published products
    );

    // Fetch the products
    $products = get_posts($args);
    $products_meta = array();

    // Loop through each product
    foreach ($products as $product) {
        // Get all meta keys for the product
        $meta_keys = get_post_meta($product->ID);

        // Prepare an associative array where meta keys are the keys
        $product_meta = array();
        foreach ($meta_keys as $key => $value) {
            // Store the first value of the meta as the value (assume it's an array)
            $product_meta[$key] = maybe_unserialize($value[0]);
        }

        // Store the product ID and its meta in the products_meta array
        $products_meta[$product->ID] = array(
            'title' => $product->post_title,
            'meta' => $product_meta,
        );
    }

    return $products_meta;
}

function get_all_meals_products_restraunt_list() {
    $meal_meta_data = get_all_meals_products_with_meta();
    $restaurant_ids =[];
    if(count($meal_meta_data))
    {
        foreach($meal_meta_data as $meal_meta)
        {
            if(isset($meal_meta['meta']) && isset($meal_meta['meta']['restaurant']) && !empty($meal_meta['meta']['restaurant']))
            {
                $restaurant_ids[]=$meal_meta['meta']['restaurant'];
            }
        }
    }
    return array_values(array_unique($restaurant_ids));
}

function back_custom_icon_svg()
{
   $icon ='<svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7096 22.959C16.3567 22.959 16.0063 22.8056 15.7671 22.5083L9.93323 15.2583C9.57314 14.81 9.57798 14.1696 9.94652 13.7274L15.9882 6.47736C16.4147 5.96503 17.1772 5.89615 17.6907 6.32269C18.2031 6.74923 18.2719 7.51169 17.8442 8.02403L12.4369 14.514L17.6509 20.9931C18.0689 21.5127 17.9868 22.2739 17.466 22.692C17.2436 22.872 16.9754 22.959 16.7096 22.959Z" fill="white"></path>
        </svg>';
    return $icon;
}

function get_restra_addr_info($restaurant_id)
{
    // Default array with empty values
    $array = [
        'restaurant_location' => '',
        'restaurant_phone_number' => '',
        'restaurant_website_url' => ''
    ];

    // Get ACF field values
    $location = get_field('restaurant_location', $restaurant_id);
    $phone_number = get_field('restaurant_phone_number', $restaurant_id);
    $website_url = get_field('restaurant_website_url', $restaurant_id);

    // Populate the array if values exist
    if (!empty($location)) {
        $array['restaurant_location'] = $location;
    }

    if (!empty($phone_number)) {
        $array['restaurant_phone_number'] = $phone_number;
    }

    if (is_array($website_url) && !empty($website_url['url'])) {
        $array['restaurant_website_url'] = '<a class="restra-site-link" href="' . esc_url($website_url['url']) . '" target="' . esc_attr($website_url['target'] ?? '_self') . '">' . esc_html($website_url['title'] ?? 'Visit Website') . '</a>';
    }

    return $array;
}

function mobile_share_icon_svg()
{
    $svg='<svg xmlns="http://www.w3.org/2000/svg" width="14.739" height="14.843" viewBox="0 0 14.739 14.843"><defs><style>.a{fill:none;stroke:#8b8b8b;stroke-linecap:round;stroke-linejoin:round;}</style></defs><g transform="translate(0.5 0.571)"><path class="a" d="M7.4,47.976a2.381,2.381,0,1,0,0,2.127" transform="translate(-2.89 -42.183)"/><path class="a" d="M92.8,7.573a2.387,2.387,0,1,0-2.128-1.317" transform="translate(-81.484 -2.8)"/><path class="a" d="M90.685,91.733a2.381,2.381,0,1,0,2.128-1.317" transform="translate(-81.502 -81.477)"/><path class="a" d="M53.9,37.991a2.381,2.381,0,0,1-2.128-1.317L47.1,39.01a2.359,2.359,0,0,1,0,2.128l4.673,2.337A2.381,2.381,0,0,1,53.9,42.158" transform="translate(-42.588 -33.218)"/></g></svg>';
    return $svg;
}