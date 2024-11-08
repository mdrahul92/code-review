jQuery(document).ready(function ($) {
  // In edit or add scene
  if (window.location.href.includes("term.php?taxonomy=delivery_zone&tag_ID") || window.location.href.includes("edit-tags.php?taxonomy=delivery_zone")) {
    // Select the input field within the div with data-name="address"
    var addressInput = $('div[data-name="address"] .acf-input-wrap input');

    // Initialize Autocomplete with 'geocode' restriction for address input
    if (addressInput.length) {
      var addressAutocomplete = new google.maps.places.Autocomplete(
        addressInput[0],
        { types: ["geocode"] }
      );

      // Listen for the place_changed event to get more details about the selected place
      addressAutocomplete.addListener("place_changed", function () {
        var place = addressAutocomplete.getPlace();

        // Check if the place has a geometry (location details)
        if (place.geometry) {
          var latitude = place.geometry.location.lat();
          var longitude = place.geometry.location.lng();

          $('div[data-name="lattitude"] .acf-input-wrap input').val(latitude);
          $('div[data-name="longitude"] .acf-input-wrap input').val(longitude);
        } else {
          console.log("No geometry available for this place");
        }

        console.log("Selected place:", place);
      });
    }
  }
});
