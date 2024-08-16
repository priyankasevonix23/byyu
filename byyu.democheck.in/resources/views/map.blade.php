<html>

  <head>

    <title>Places Search Box</title>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>



    <link rel="stylesheet" type="text/css" href="./style.css" />

    <script type="module" src="./index.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <style type="text/css">

        /*

 * Always set the map height explicitly to define the size of the div element

 * that contains the map.

 */

#map {

  height: 100%;

}



/*

 * Optional: Makes the sample page fill the window.

 */

html,

body {

  height: 100%;

  margin: 0;

  padding: 0;

}



#description {

  font-family: Roboto;

  font-size: 15px;

  font-weight: 300;

}



#infowindow-content .title {

  font-weight: bold;

}



#infowindow-content {

  display: none;

}



#map #infowindow-content {

  display: inline;

}



.pac-card {

  background-color: #fff;

  border: 0;

  border-radius: 2px;

  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);

  margin: 10px;

  padding: 0 0.5em;

  font: 400 18px Roboto, Arial, sans-serif;

  overflow: hidden;

  font-family: Roboto;

  padding: 0;

}



#pac-container {

  padding-bottom: 12px;

  margin-right: 12px;

}



.pac-controls {

  display: inline-block;

  padding: 5px 11px;

}



.pac-controls label {

  font-family: Roboto;

  font-size: 13px;

  font-weight: 300;

}



#pac-input {

  background-color: #fff;

  font-family: arial;

  font-size: 16px;

  font-weight: 300;

  margin: 20px auto 0;

  padding: 10px 10px 10px 20px;

  text-overflow: ellipsis;

  width: 400px;

  border-radius: 100px;

  left: 0 !important;

  border: 5px solid #f8e9e5 !important;

  color: #000;

  box-shadow: 0 5px 10px #0000004d;

  right: 0;

  outline: 0;

}



#pac-input:focus {

  border-color: #4d90fe;

}



#title {

  color: #fff;

  background-color: #4d90fe;

  font-size: 25px;

  font-weight: 500;

  padding: 6px 12px;

}



#target {

  width: 345px;

}



.btnConfirm{

  background-color: #f03613;

  color: #fff;

  padding: 9px 30px;

  border-radius: 100px;

  text-decoration: none;

  border: 0;

  font-size: 21px;

  transition-duration: 0.1s;

  text-transform: uppercase;

  line-height: normal;

  position: absolute;

  bottom: 20px;

  left: 0;

  right: 0;

  width: 280px;

  margin: 0 auto 0;

  font-family: arial;

  cursor: pointer;

}

.btnConfirm:hover {

  background-color: #bb8039;

  color: #fff;

  box-shadow: 0 5px 5px #72727233;

}



.text-center{

    text-align: center;

}

    </style>

  </head>

  <body>

    <input

      id="pac-input"

      class="controls"

      type="text"

      placeholder="Search Box"

    />
    
    <input type="hidden" name="mapLat" id="mapLat" />
    
    <input type="hidden" name="mapLng" id="mapLng" />

    <div id="map"></div>

    <div class="text-center">

     <button type="button" class="btnConfirm">Confirm Location</button>

    </div>


    <!--

      The `defer` attribute causes the callback to execute after the full HTML

      document has been parsed. For non-blocking uses, avoiding race conditions,

      and consistent behavior across browsers, consider loading using Promises.

      See https://developers.google.com/maps/documentation/javascript/load-maps-js-api

      for more information.

      -->

    <script

      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSfEYjknao_GTrv0-kIifoqxAWPzvCcJ0&callback=initAutocomplete&libraries=places&v=weekly"

      defer

    ></script>

    <script type="text/javascript">
    
    if (navigator.geolocation) {
        var latlngData = navigator.geolocation.getCurrentPosition(locationSuccess);
        console.log(latlngData);
    } else {
        $("#locationData").html('Your browser does not support location data retrieval.');
    }

    function locationSuccess(position) {
            var mapLat = position.coords.latitude;
            var mapLng = position.coords.longitude;
            $('#mapLat').val(mapLat);
            $('#mapLng').val(mapLng);
    }
    
    // locationSuccess();

     var selected_location = '' ;

     var selected_lat = '' ;

     var selected_lng = '' ;

     var selected_adr_components = [];

     var selected_country = [];

      var geocoder;

      function initAutocomplete() {
          
        var mapLat = ($('#mapLat').val()) ? $('#mapLat').val(): 25.2048;
        var mapLng = ($('#mapLng').val()) ? $('#mapLng').val(): 55.2708;
        console.log(mapLat,mapLng,'initAutocomplete');

      const map = new google.maps.Map(document.getElementById("map"), {

        center: { lat: parseFloat(mapLat), lng: parseFloat(mapLng) },

        zoom: 13,

        mapTypeId: "roadmap",

      });





      // Create the search box and link it to the UI element.

      const input = document.getElementById("pac-input");

      const searchBox = new google.maps.places.SearchBox(input);



      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      // Bias the SearchBox results towards current map's viewport.

      map.addListener("bounds_changed", () => {

        searchBox.setBounds(map.getBounds());

      });



      let markers = [];



      var searchInput = 'pac-input';

      var autocomplete;

      autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {

          types: ['geocode'],

      });



      google.maps.event.addListener(autocomplete, 'place_changed', function () {

        // console.log('map place change');

          selected_country = [];

          var near_place = autocomplete.getPlace();



          if(!near_place || near_place.location){

              console.log('Please select location');

              return;

          }else{

            selected_location = near_place.formatted_address ;

            selected_lat = (near_place.geometry.location.lat())?near_place.geometry.location.lat():'' ;

            selected_lng = (near_place.geometry.location.lng())?near_place.geometry.location.lng():'';

            selected_adr_components = near_place.address_components;



            $.each(selected_adr_components, function(key,value) {

                var vtype = value.types;

                if(vtype.indexOf("country") != -1 || vtype.indexOf("administrative_area_level_1") != -1){

                  selected_country.push(value.short_name);

                  console.log(selected_country);

                }

            });

          }

          console.log('near_place',near_place);

          // console.log(near_place.geometry.location.lat());

          // console.log(near_place.geometry.location.lng());



          if (near_place.length == 0) {

            return;

          }



        // Clear out the old markers.

        markers.forEach((marker) => {

          marker.setMap(null);

        });

        markers = [];



        // For each place, get the icon, name and location.

        const bounds = new google.maps.LatLngBounds();



        // near_place.forEach((place) => {

          if (!near_place.geometry || !near_place.geometry.location) {

            console.log("Returned place contains no geometry");

            return;

          }



          const icon = {

            url: near_place.icon,

            size: new google.maps.Size(71, 71),

            origin: new google.maps.Point(0, 0),

            anchor: new google.maps.Point(17, 34),

            scaledSize: new google.maps.Size(25, 25),

          };



          // Create a marker for each place.

          markers.push(

            new google.maps.Marker({

              map,

              icon,

              title: near_place.name,

              position: near_place.geometry.location,

            }),

          );



          // console.log(near_place);

          // console.log(near_place.geometry.location.lng);

          if (near_place.geometry.viewport) {

            // Only geocodes have viewport.

            bounds.union(near_place.geometry.viewport);

          } else {

            bounds.extend(near_place.geometry.location);

          }

        // });

        map.fitBounds(bounds);

      });



      geocoder = new google.maps.Geocoder();



      google.maps.event.addListener(map, 'click', function(event) {

        // console.log(event.latLng);

         placeMarker(event.latLng);

      });



      function placeMarker(location) {

          markers.forEach((marker) => {

            marker.setMap(null);

          });

          markers = [];

          markers.push(

            new google.maps.Marker({

              position: location,

              map: map

            }),

          );



          getAddress(location);

      }



      function getAddress(latLng) {

        geocoder.geocode( {'latLng': latLng},

          function(results, status) {

            if(status == google.maps.GeocoderStatus.OK) {

              if(results[0]) {

                console.log(results);
                // alert(results[0].formatted_address);

                document.getElementById("pac-input").value = results[0].formatted_address;

                selected_location = (results[0].formatted_address)?results[0].formatted_address:'';

                selected_lat = (results[0].geometry.location.lat())?results[0].geometry.location.lat():'' ;

                selected_lng = (results[0].geometry.location.lng())?results[0].geometry.location.lng():'';



                selected_adr_components = results[0].address_components;



                $.each(selected_adr_components, function(key,value) {

                  var vtype = value.types;

                  if(vtype.indexOf("country") != -1 || vtype.indexOf("administrative_area_level_1") != -1){

                    selected_country.push(value.short_name);

                    console.log(selected_country);

                  }

                });

              }

              else {

                console.log("No results");

              }

            }

            else {

              console.log(status);

            }

          });

      }



    }



    window.initAutocomplete = initAutocomplete;



    $(document).ready(function(){



        $('.btnConfirm').on('click',function(){

          var pacinput=document.getElementById('pac-input').value;
            // console.log(selected_location, selected_lat, selected_lng);

            if(jQuery.inArray("Dubai", selected_country) == -1){

              alert('Service is not available in this area');

              return;

            }
            var user_id;
            var userprofile;

            function getUserIdFromUrl() {
                var url = window.location.href;
                var urlParts = url.split('/');
                user_id = urlParts[urlParts.length - 1];
                userprofile = urlParts[urlParts.length - 2];
                // return urlParts[urlParts.length - 1];
            }

           getUserIdFromUrl();





            if(!selected_location || selected_location.location){

              alert('Please select location');

              return;

            }

            console.log(user_id);

// "{{url('user/address/save')}}"

            $.ajax({

                type: 'POST',

                url:  "https://www.byyu.com/admin/api/user/address/save",

                data: { user_id:user_id, address: selected_location, lat:selected_lat, lng:selected_lng },

                success: function(result) {

                   console.log(result);

                   if(result.success == true){

                     window.top.location.href = 'https://www.byyu.com/address-new/'+  userprofile +'/'+user_id;
                    // window.top.location.href = 'http://localhost/byyu/address-new/' +  userprofile + '/' + user_id;


                   }

                },

                error: function(error) {

                    console.error('Error:', error);

                }

            });



        });



    });



    </script>

  </body>

</html>
