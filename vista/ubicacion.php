<br>
<div id="divMapaSpinner"class="spinner"></div>
<div id="divMapa" class="trasSpinner">
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

        <div id="fotosProductos" class="pics img-rounded " >
            <img src=""  />
            <img src=""  />
            <img src=""  />
        </div>

        <div class="nav" style=" text-align: center;" >
            <div>aca va el buscador</div>
            <br>
            <ul class='list-group' id="navEventos"></ul>
        </div>
    </div> 

    <div  class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
        <p class="bg-default">
            <div id="map"></div>
        </p>       
    </div>
    <div  class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
</div>

    <script>

      function initMap2(locations) {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: -32.9442426, lng: -60.65053880000001}
        });

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length]
          });
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
      
    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAclQUJOrarrDS4PZHUYmFkNoHmN3V9K4A&callback=initMap">
    </script>
