let change_delivery_address_outer_div_html = '';
let filter_wrapper_display_div_html='';

function isMobileDevice() {
    return /android|iphone|ipad|ipod|blackberry|iemobile|opera mini|webos/i.test(navigator.userAgent);
}

jQuery(document).ready(function() {
    // Check if the element exists
    if (jQuery('.change_delivery_address_outer').length) {
        // Get the outer HTML of the parent element
        change_delivery_address_outer_div_html = jQuery('.change_delivery_address_outer').parent()[0].outerHTML;
    }
    if (jQuery('filter-wrapper.display-mobile').length) {
        filter_wrapper_display_div_html = jQuery('.filter-wrapper.display-mobile').parent()[0].outerHTML;
    }
});

jQuery(document).ready(function($) {
    $('.address_validation').on('click',function(e) {
        e.preventDefault();
        var address = $('#address').val();
        var data = {
            action: 'address_validation',
            address: address // Any data you want to send
        };

        $.post(ajax_object.ajax_url, data, function(response) {
            if(response.data.error){
                window.location.replace("/no-delivery");
            }else{
                window.location.replace("/login");
            }
        });
        console.log('address_validation');
    });
    console.log('custom-ajax');

    $('.custom_billing_phone_number').on('input', function() {
        // Replace any non-digit characters with an empty string
        this.value = this.value.replace(/\D/g, '');
    });
});

function checkAndHideEmptyDesktopFacets() {
    if(jQuery('.home-search-page').length || jQuery('.custom-restaurants-section').length)
    {
        if(jQuery(window).width()>=765)
        {
            jQuery('.filter-wrapper.display-desktop').each(function() {
                if (jQuery(this).find('.selection-card .facetwp-facet').html() === '')
                {
                    // Hide the closest .filter-wrapper
                    jQuery(this).closest('.filter-wrapper.display-desktop').css('display', 'none');
                }
                else{
                    // If not empty, ensure it is displayed
                    jQuery(this).closest('.filter-wrapper.display-desktop').css('display', 'block');
                }
            })
        }
        else{
            jQuery('.filter-wrapper.display-desktop').css('display', 'none');
        }
        jQuery('.home-search-page .sidebar-filter').css('display', 'block');
        jQuery('.custom-restaurants-section .sidebar-filter').css('display', 'block');
    }
}


jQuery(document).on('facetwp-loaded', function() {
    setTimeout(() => {
        checkAndHideEmptyDesktopFacets();
        wrapPlateCards().then(() => {
            // This code runs after wrapPlateCards has completed
            if (!jQuery('.product-grid.meal-result-grid').parent().find('.change_delivery_address_outer').length) {
                jQuery(change_delivery_address_outer_div_html).insertBefore(".product-grid.meal-result-grid");
                googleAutoCompleteInputHandle();
            }
        });
    }, 100);
});

document.addEventListener("DOMContentLoaded", function() {
    // Ensure that the collapsed class is applied correctly on page load
    document.querySelectorAll('.accordion-button').forEach(button => {
        let collapseElement = document.querySelector(button.getAttribute('data-bs-target'));
        if (!collapseElement.classList.contains('show')) {
            button.classList.add('collapsed');
        }
    });
});

jQuery(window).on('load',function(e) {
    setTimeout(() => {
        if(jQuery('.home-search-page').length || jQuery('.custom-restaurants-section').length)
        {
            if(jQuery(window).width()>=765)
            {
                jQuery('.filter-wrapper.display-desktop').each(function() {
                    if (jQuery(this).find('.selection-card .facetwp-facet').html() === '')
                    {
                        // Hide the closest .filter-wrapper
                        jQuery(this).closest('.filter-wrapper.display-desktop').css('display', 'none');
                    }
                    else{
                        // If not empty, ensure it is displayed
                        jQuery(this).closest('.filter-wrapper.display-desktop').css('display', 'block');
                    }
                })
            }
            else{
                jQuery('.filter-wrapper.display-desktop').css('display', 'none');
            }
            jQuery('.home-search-page .sidebar-filter').css('display', 'block');
            jQuery('.custom-restaurants-section .sidebar-filter').css('display', 'block');
        }
    }, 100);
});

jQuery(window).on('resize',function(e) {
    checkAndHideEmptyDesktopFacets();
});

jQuery(document).ready(function(){
    googleAutoCompleteInputHandle();
});

function googleAutoCompleteInputHandle()
{
    // Initialize Autocomplete with 'geocode' restriction
    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input, { types: ['geocode'] });

    // Listen for the place_changed event to get more details about the selected place
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();

        // Check if the place has a geometry (location details)
        if (place.geometry) {
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            console.log(latitude+' '+longitude);
        } else {
           console.log("no")
        }

        console.log("Selected place:", place);
    });
}
function wrapPlateCards() {
    return new Promise((resolve, reject) => {
        try {
            // Check if .plate-card exists and .product-grid.meal-result-grid.mt-5 doesn't exist
            if (jQuery('.plate-card').length > 0 && jQuery('.product-grid.meal-result-grid.mt-5').length === 0) {
                // Wrap all .plate-card elements with the parent div
                jQuery('.plate-card').wrapAll('<div class="product-grid meal-result-grid mt-5"></div>');
            }
            // Resolve the Promise after the operation
            resolve();
        } catch (error) {
            // Reject the Promise if an error occurs
            reject(error);
        }
    });
}

jQuery(document).ajaxComplete(function(event, jqXHR, settings) {
    try {
        const response = JSON.parse(jqXHR.responseText); // Attempt to parse the response

        if (response.fragments && response.cart_hash) {
        let old_val =  jQuery('.mb-cart-count').text();
        // If the response contains fragments
        let cartFragmentData = response.fragments; // Correctly access response.fragments

        // Parse the specific fragment for cart contents
        let cartHTML = new DOMParser().parseFromString(cartFragmentData['a.cart-contents'], 'text/html');

        // Find the cart item count element
        let cartCountElement = cartHTML.querySelector('.cart-contents-count');

        // Extract the count value, default to 0 if not found
        let cartCount = cartCountElement ? parseInt(cartCountElement.textContent.trim(), 10) : old_val;

        // Update the cart count display in your DOM
        jQuery('.mb-cart-count').text(cartCount);
        }
    } catch (e) {
    //   console.error("Error parsing response:", e); // Log the error for debugging
    //   console.log("Error Response Value:", jqXHR.responseText); // Fallback if not JSON
    }
});
  
// Custom Sharing
var pageLink = window.location.href;
var url_to_be_share = pageLink;
var pageTitle = String(document.title).replace(/\&/g, '%26');

//Web sharing api functionality on mobile
function onShare(url_to_be_share) {
    const title = document.title;
    const text = document.title;
  
    if (navigator.share) {
        navigator
            .share({
                title,
                url: url_to_be_share,
                text
            })
            .then(() => {
                console.log("Thanks for Sharing!");
            })
            .catch(err => {
                console.log(`Couldn't share: ${err}`);
            });
    } else {
        console.log("Sharing not supported in this browser.");
    }
}
  
function initializeApp() {
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("/wp-content/themes/hello-elementor-child/js/service-worker.js").then(() => {
            document.querySelectorAll('#CustomSharePage').forEach(item => {
                item.addEventListener('click', () => {
                    const currentUrl = window.location.href;
                    onShare(currentUrl); // Pass the current URL to onShare
                });
            });
        }).catch(err => {
            console.log(`Service Worker registration failed: ${err}`);
        });
    }
}

// Initialize the app
initializeApp();