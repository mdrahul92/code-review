let custom_ajax_data = ajax_data;
let product_signature_plate = jQuery('select[name="acf[field_product_signature_plate]"]').val();
jQuery(document).ready(function ($) {
    // Listen for changes to the restaurant select field
    $(document).on('change', 'div[data-name="restaurant"] select', function () {
        var restaurantID = $(this).val(); // Get the selected restaurant ID

        // Clear current options in the product_signature_plate field
        var $signaturePlateField = $('select[name="acf[field_product_signature_plate]"]');
        $signaturePlateField.empty();

        // Make an AJAX request to get the signature plates
        $.ajax({
            url: custom_ajax_data.ajaxurl, // WP's AJAX URL
            type: 'POST',
            data: {
                action: 'get_signature_plates', // Action defined in PHP
                restaurant_id: restaurantID,
            },
            success: function (response) {
                if (response.success) {
                    // Populate the product_signature_plate field with new options
                    $.each(response.data, function (index, plate) {
                        // Create the option element
                        var $option = $('<option>', {
                            value: plate,
                            text: plate,
                        });

                        // If the plate matches the current value, mark it as selected
                        if (plate === product_signature_plate) {
                            $option.prop('selected', true); // Set this option as selected
                        }

                        // Add the new option to the select field
                        $signaturePlateField.append($option);
                    });

                    // Refresh Select2 to show the new options
                    $signaturePlateField.trigger('change'); // Notify Select2 about the change
                }
            },
            error: function () {
                alert('An error occurred while fetching signature plates.');
            }
        });
    });
});

