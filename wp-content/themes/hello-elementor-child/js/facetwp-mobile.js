jQuery(document).ready(function($) {
    // Check if the screen size is mobile
    if ($(window).width() < 768) {
        $('.facetwp-checkbox').each(function(index) {
            // Create a unique select element for each facet filter
            var select = $('<select class="facetwp-facet-select" id="facet-select-' + index + '"></select>');
            
            // Add a default option
            select.append('<option value="">Select an option</option>');

            // Loop through each checkbox within this filter and add it as an option
            $(this).find('input[type="checkbox"]').each(function() {
                var label = $(this).next('label').text(); // Get label text
                var value = $(this).val(); // Get checkbox value
                var isChecked = $(this).is(':checked'); // Check if the checkbox is selected

                // Add the option to the select dropdown
                var option = $('<option></option>').val(value).text(label);

                // If the checkbox is checked, mark the corresponding select option as selected
                if (isChecked) {
                    option.attr('selected', 'selected');
                }

                select.append(option);
            });

            // Insert the select box after the checkbox facet
            $(this).after(select).remove(); // Remove the checkboxes
        });

        // Trigger FacetWP to reload and apply the selected filters on change
        $('.facetwp-facet-select').on('change', function() {
            var facet_name = $(this).closest('.facetwp-facet').attr('data-name');
            var selected_value = $(this).val();
            var params = {};

            params[facet_name] = selected_value;
            FWP.reset();
            FWP.extras = params;
            FWP.refresh();
        });
    }
});
