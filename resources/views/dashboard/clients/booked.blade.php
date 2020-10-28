@extends('layouts.dashboard')
@section('title','For Pickup')
@section('maintitle', 'For Pickup')

@section('script-top')
  <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('content')

  <div class="card">
      <div class="card-header clearfix">
        <h4 class="pull-left card-title">Ready For Pickup</h4>
        <a class="pull-right btn btn-danger btn-round" href="{{ route('client.index') }}">Back</a>
      </div>
      <div class="card-body">
        <div class="row depot-wrapper">
            <aside class="col-md-3">
              <div class="map-sidebar">
                <div class='heading'>
                  <h5>Clients</h5>
                </div>
              <div id='listings' class='listings'></div>
            </div>

          </aside>
          <div class="col-md-9">
            <div id='map' class='map full-map'></div>
          </div>
        </div>
    </div>
  </div>

  <?php 
    $clientjson = '';
    $turfpoints = '';
    $objLocation = '';

    foreach($clients as $client){
        $turfpoints .= "[" . $client->lng . "," . $client->lat . "],";
        $objLocation .= '{
          "lat": "' . $client->lat . '",
          "lng": "' . $client->lng . '"
        },';

        $clientjson .= '{
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                "'. $client->lng .'",
                "'. $client->lat .'"
              ]
            },
            "properties": {
              "phoneFormatted": "",
              "name": "'. $client->name .'",
              "scheme_id": "'. $client->scheme_id .'",
              "depotId":'. $client->id .',
              "phone": "'. $client->mobile .'",
              "address": "'. $client->address .'"
            }
          },';
    }
  ?>
  {{-- {{ dd($objLocation) }} --}}

  <script type="text/javascript">
      mapboxgl.accessToken = "pk.eyJ1IjoieW5ub3NzZW5jZSIsImEiOiJja2ZnZ3Vlcmkwa2poMzBvNWswNm5vaW9lIn0.6ESxbFhgeUncrEwnwPsh3Q";

        var dianella = [115.8771122,-31.9069759];
        var kelmscott = [116.005396,-32.12936];

        var truckLocation = dianella;
        var warehouseLocation = dianella;
        var lastQueryTime = 0;
        var lastAtRestaurant = 0;
        var keepTrack = [];
        var currentSchedule = [];
        var currentRoute = null;
        var pointHopper = {};
        var pause = true;
        var speedFactor = 50;
        var objLocation = [<?php echo $objLocation; ?>];

        console.log(objLocation);

        var warehouse = turf.featureCollection([turf.point(warehouseLocation)]);

        // Create an empty GeoJSON feature collection for drop off locations
        var dropoffs = turf.featureCollection([]);

        // Create an empty GeoJSON feature collection, which will be used as the data source for the route before users add any new data
        var nothing = turf.featureCollection([]);

        // This will let you use the .remove() function later on
        if (!('remove' in Element.prototype)) {
          Element.prototype.remove = function() {
            if (this.parentNode) {
                this.parentNode.removeChild(this);
            }
          };
        }
       
        /** 
         * Add the map to the page
        */
        var map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/light-v10',
          // center: [115.843232, -31.9384826],
          center: dianella,
          zoom: 11,
          scrollZoom: true
        });

        var stores = {
          "type": "FeatureCollection",
          "features": [<?php echo $clientjson; ?>]
        };
        
        /**
         * Assign a unique id to each store. You'll use this 'id'
         * later to associate each point on the map with a listing
         * in the sidebar.
        */
        stores.features.forEach(function(store, i){
          store.properties.id = i;
        });

        /**
         * Wait until the map loads to make changes to the map.
        */
        map.on('load', function (e) {
          /** 
           * This is where your '.addLayer()' used to be, instead
           * add only the source without styling a layer
          */
          map.addSource("places", {
            "type": "geojson",
            "data": stores
          });

          /**
           * Add all the things to the page:
           * - The location listings on the side of the page
           * - The markers onto the map
          */

          // Create a new marker
          var depot = document.createElement('div');
          depot.classList = 'depot-location';
          depotMarker = new mapboxgl.Marker(depot)
            .setLngLat(kelmscott)
            .addTo(map);

          var depot2 = document.createElement('div');
          depot2.classList = 'depot-location';
          depot2Marker = new mapboxgl.Marker(depot2)
            .setLngLat(dianella)
            .addTo(map);

          buildLocationList(stores);
          addMarkers();
          routesInit();

          prepLocation();
          
        });

        function prepLocation() {
          objLocation.forEach(obj => {
            newDropoff(obj);
            updateDropoffs(dropoffs);
          });
          
        }

        /**
         * Add a marker to the map for every store listing.
        **/
        function addMarkers() {
          /* For each feature in the GeoJSON object above: */
          stores.features.forEach(function(marker) {
            /* Create a div element for the marker. */
            var el = document.createElement('div');
            /* Assign a unique 'id' to the marker. */
            el.id = "marker-" + marker.properties.id;
            /* Assign the 'marker' class to each marker for styling. */
            el.className = 'marker';
            
            /**
             * Create a marker using the div element
             * defined above and add it to the map.
            **/
            new mapboxgl.Marker(el, { offset: [0, -23] })
              .setLngLat(marker.geometry.coordinates)
              .addTo(map);

            /**
             * Listen to the element and when it is clicked, do three things:
             * 1. Fly to the point
             * 2. Close all other popups and display popup for clicked store
             * 3. Highlight listing in sidebar (and remove highlight for all other listings)
            **/
            el.addEventListener('click', function(e){
              /* Fly to the point */
              flyToStore(marker);
              /* Close all other popups and display popup for clicked store */
              createPopUp(marker);
              /* Highlight listing in sidebar */
              var activeItem = document.getElementsByClassName('active');
              e.stopPropagation();
              if (activeItem[0]) {
                activeItem[0].classList.remove('active');
              }
              var listing = document.getElementById('listing-' + marker.properties.id);
              listing.classList.add('active');
            });
          });
        }

        /**
         * Add a listing for each store to the sidebar.
        **/
        function buildLocationList(data) {
          data.features.forEach(function(store, i){
            /**
             * Create a shortcut for 'store.properties',
             * which will be used several times below.
            **/
            var prop = store.properties;

            /* Add a new listing section to the sidebar. */
            var listings = document.getElementById('listings');
            var listing = listings.appendChild(document.createElement('div'));
            /* Assign a unique 'id' to the listing. */
            listing.id = "listing-" + prop.id;
            /* Assign the 'item' class to each listing for styling. */
            listing.className = 'item';

            /* Add the link to the individual listing created above. */
            var link = listing.appendChild(document.createElement('a'));
            link.href = '#';
            link.className = 'title';
            link.id = "link-" + prop.id;
            link.innerHTML = prop.name + " <strong>(" + prop.scheme_id + ")</strong>";


            /* Add details to the individual listing. */
            var details = listing.appendChild(document.createElement('div'));
            details.classList.add('depot-address');
            details.classList.add('clearfix');
            details.innerHTML = prop.address;
            if (prop.phone) {
              details.innerHTML += ' ' + prop.phoneFormatted;
            }

            /**
             * Listen to the element and when it is clicked, do four things:
             * 1. Update the 'currentFeature' to the store associated with the clicked link
             * 2. Fly to the point
             * 3. Close all other popups and display popup for clicked store
             * 4. Highlight listing in sidebar (and remove highlight for all other listings)
            **/
            link.addEventListener('click', function(e){
              for (var i=0; i < data.features.length; i++) {
                if (this.id === "link-" + data.features[i].properties.id) {
                  var clickedListing = data.features[i];
                  flyToStore(clickedListing);
                  createPopUp(clickedListing);
                }
              }
              var activeItem = document.getElementsByClassName('active');
              if (activeItem[0]) {
                activeItem[0].classList.remove('active');
              }
              this.parentNode.classList.add('active');
            });
          });
        }

        /**
         * Use Mapbox GL JS's 'flyTo' to move the camera smoothly
         * a given center point.
        **/
        function flyToStore(currentFeature) {
          map.flyTo({
            center: currentFeature.geometry.coordinates,
            zoom: 15
          });
        }

        /**
         * Create a Mapbox GL JS 'Popup'.
        **/
        function createPopUp(currentFeature) {
          var popUps = document.getElementsByClassName('mapboxgl-popup');
          if (popUps[0]) popUps[0].remove();
          var popup = new mapboxgl.Popup({closeOnClick: false})
            .setLngLat(currentFeature.geometry.coordinates)
            .setHTML('<h3>' + currentFeature.properties.name +  '</h3>' +
              '<h4>' + currentFeature.properties.address + '</h4>')
            .addTo(map);
        }

        function routesInit() {
          
          // Create a circle layer
          map.addLayer({
              id: 'warehouse',
              type: 'circle',
              source: {
                data: [turf.point(dianella)],
                type: 'geojson'
              },
              paint: {
                'circle-radius': 20,
                'circle-color': 'white',
                'circle-stroke-color': '#3887be',
                'circle-stroke-width': 3
              }
            });

            // Create a symbol layer on top of circle layer
            map.addLayer({
              id: 'warehouse-symbol',
              type: 'symbol',
              source: {
                data: [turf.point(dianella)],
                type: 'geojson'
              },
              layout: {
                'icon-image': 'grocery-15',
                'icon-size': 1
              },
              paint: {
                'text-color': '#3887be'
              }
            });

            map.addLayer({
              id: 'dropoffs-symbol',
              type: 'symbol',
              source: {
                data: [turf.point(dianella)],
                type: 'geojson'
              },
              layout: {
                'icon-allow-overlap': true,
                'icon-ignore-placement': true,
                'icon-image': 'marker-15'
              }
            });

            map.addSource('route', {
              type: 'geojson',
              data: nothing
            });

            map.addLayer(
              {
                id: 'routeline-active',
                type: 'line',
                source: 'route',
                layout: {
                  'line-join': 'round',
                  'line-cap': 'round'
                },
                paint: {
                  'line-color': '#3887be',
                  'line-width': ['interpolate', ['linear'], ['zoom'], 12, 3, 22, 12]
                }
              },
              'waterway-label'
            );

            map.addLayer(
              {
                id: 'routearrows',
                type: 'symbol',
                source: 'route',
                layout: {
                  'symbol-placement': 'line',
                  'text-field': '▶',
                  'text-size': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    12,
                    24,
                    22,
                    60
                  ],
                  'symbol-spacing': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    12,
                    30,
                    22,
                    160
                  ],
                  'text-keep-upright': false
                },
                paint: {
                  'text-color': '#3887be',
                  'text-halo-color': 'hsl(55, 11%, 96%)',
                  'text-halo-width': 3
                }
              },
              'waterway-label'
            );

        }
      

      map.on('load', function () {
        var marker = document.createElement('div');
        marker.classList = 'truck';

        // Create a new marker
        truckMarker = new mapboxgl.Marker(marker)
          .setLngLat(truckLocation)
          .addTo(map);


        
      });

      function newDropoff(coords) {
        // Store the clicked point as a new GeoJSON feature with
        // two properties: `orderTime` and `key`
        var pt = turf.point([coords.lng, coords.lat], {
          orderTime: Date.now(),
          key: Math.random()
        });
        dropoffs.features.push(pt);
        pointHopper[pt.properties.key] = pt;

        // Make a request to the Optimization API
        $.ajax({
          method: 'GET',
          url: assembleQueryURL()
        }).done(function (data) {
          // Create a GeoJSON feature collection
          var routeGeoJSON = turf.featureCollection([
            turf.feature(data.trips[0].geometry)
          ]);

          // If there is no route provided, reset
          if (!data.trips[0]) {
            routeGeoJSON = nothing;
          } else {
            // Update the `route` source by getting the route source
            // and setting the data equal to routeGeoJSON
            map.getSource('route').setData(routeGeoJSON);
          }

          //
          if (data.waypoints.length === 12) {
            window.alert(
              'Maximum number of points reached. Read more at docs.mapbox.com/api/navigation/#optimization.'
            );
          }
        });
      }

      function updateDropoffs(geojson) {
        map.getSource('dropoffs-symbol').setData(geojson);
      }

      // Here you'll specify all the parameters necessary for requesting a response from the Optimization API
      function assembleQueryURL() {
        // Store the location of the truck in a variable called coordinates
        var coordinates = [truckLocation];
        var distributions = [];
        keepTrack = [truckLocation];

        // Create an array of GeoJSON feature collections for each point
        var restJobs = objectToArray(pointHopper);

        // If there are actually orders from this restaurant
        if (restJobs.length > 0) {
          // Check to see if the request was made after visiting the restaurant
          var needToPickUp =
            restJobs.filter(function (d, i) {
              return d.properties.orderTime > lastAtRestaurant;
            }).length > 0;

          // If the request was made after picking up from the restaurant,
          // Add the restaurant as an additional stop
          if (needToPickUp) {
            var restaurantIndex = coordinates.length;
            // Add the restaurant as a coordinate
            coordinates.push(warehouseLocation);
            // push the restaurant itself into the array
            keepTrack.push(pointHopper.warehouse);
          }

          restJobs.forEach(function (d, i) {
            // Add dropoff to list
            keepTrack.push(d);
            coordinates.push(d.geometry.coordinates);
            // if order not yet picked up, add a reroute
            if (needToPickUp && d.properties.orderTime > lastAtRestaurant) {
              distributions.push(
                restaurantIndex + ',' + (coordinates.length - 1)
              );
            }
          });
        }

        // Set the profile to `driving`
        // Coordinates will include the current location of the truck,
        return (
          'https://api.mapbox.com/optimized-trips/v1/mapbox/driving/' +
          coordinates.join(';') +
          '?distributions=' +
          distributions.join(';') +
          '&overview=full&steps=true&geometries=geojson&source=first&access_token=' +
          mapboxgl.accessToken
        );
      }

      function objectToArray(obj) {
        var keys = Object.keys(obj);
        var routeGeoJSON = keys.map(function (key) {
          return obj[key];
        });
        return routeGeoJSON;
      }
    


      </script>

@endsection
