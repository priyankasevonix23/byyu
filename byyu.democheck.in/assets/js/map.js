
    function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 40.7128, lng: -74.006 },
        zoom: 12,
      });

      const searchInput = document.getElementById("search-input");
      const searchBox = new google.maps.places.SearchBox(searchInput);

      map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
      });

      let markers = [];

      searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length === 0) {
          return;
        }

        markers.forEach((marker) => {
          marker.setMap(null);
        });
        markers = [];

        const bounds = new google.maps.LatLngBounds();
        places.forEach((place) => {
          if (!place.geometry || !place.geometry.location) {
            console.log("Returned place contains no geometry");
            return;
          }

          const marker = new google.maps.Marker({
            map,
            title: place.name,
            position: place.geometry.location,
          });

          markers.push(marker);

          if (place.geometry.viewport) {
            bounds.union(place.geometry.viewport);
          } else {
            bounds.extend(place.geometry.location);
          }
        });

        map.fitBounds(bounds);
      });
    }