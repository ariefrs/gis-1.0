<!DOCTYPE html>
<html>
  <head>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script type="text/javascript">
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center:{lat: -0.1007596, lng:117.2045936},
        });
        // Load GeoJSON.
        /**
        var promise = $.getJSON('https://raw.githubusercontent.com/ariefrs/labeled-places/master/labeled-places.json'); 
        //same as map.data.loadGeoJson();
        promise.then(function(data){
            cachedGeoJson = data; //save the geojson in case we want to update its values
            map.data.addGeoJson(cachedGeoJson,{idPropertyName:"id"});  
        });
        */
        // NOTE: This uses cross-domain XHR, and may not work on older browsers.
        map.data.loadGeoJson('https://raw.githubusercontent.com/ariefrs/labeled-places/master/labeled-places.json');
    // Set mouseover event for each feature.
        map.data.addListener('mouseover', function(event) {
        document.getElementById('info-box').textContent =  event.feature.getProperty('nama');
        });
    }
    </script>
    <?php //echo $map['js']; ?>
  </head>
  <body>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div><!-- End of row -->    
        <div class="row">                 
                <div id="map"><?php //echo $map['html']; ?>                                    
                </div>
        </div><!-- End Of Row <-->    
        
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE&callback=initMap">
    </script>
    
    </body>
</html>