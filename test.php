<?php 

include 'wp-config.php';

// echo check_delivery_address('145 W 45th St, New York, NY 10036, United States');
$my_field_value = get_field('order_time_deadline', 'option');

// Example: Output the value
if ( $my_field_value ) {
    echo $my_field_value;
} else {
    echo 'Field not found or no value set.';
}