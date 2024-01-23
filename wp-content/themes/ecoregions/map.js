<script>
    var mapbox_key = "pk.eyJ1IjoidWNvbm5keGdyb3VwIiwiYSI6ImNrcTg4dWc5NzBkcWYyd283amtpNjFiZXkifQ.iGpZ5PfDWFWWPkuDeGQ3NQ";
    //intialize the inital map data
    var region_coordinate_mappings = {

        "northwestern-uplands": {
            name: "Northwestern Uplands",
            slug: "northwestern-uplands",
            coords: [
                [-72.82161082594858, 42.035933621864295],
                [-73.4873136457728, 42.049446888173385],
                [-73.53535710341936, 41.44558860831884],
                [-73.44467683996596, 41.59054265050452],
                [-73.20293456479384, 41.772053800976785],
                [-73.10146797338896, 41.73207678388107],
                [-73.01510758315594, 41.775084941678145],
                [-72.96719934136044, 41.82676315673198],
                [-72.8725992050337, 41.837486521688604],
                [-72.84438786871107, 41.95087354088623],
            ]
        }
    }

    let layerStates = {
        townNames: true,
        regions: true,
        geologicalFeatures: true,
    }

    mapboxgl.accessToken = mapbox_key;
    const map = new mapboxgl.Map({
        container: 'map',
        style: "mapbox://styles/uconndxgroup/ckvb5m4qm0q0v14qs76jitlc6",
        center: [-72.6734, 41.5758], // starting position [lng, lat]
        zoom: 8, // starting zoom
    });

    // Add a polygon for each region coordinate mapping onto the Mapbox map, on map load

    map.on('load', function() {

        Object.keys(region_coordinate_mappings).forEach(region => {

            var regionSlug = region_coordinate_mappings[region].slug;
            var regionName = region_coordinate_mappings[region].name;

            const coordinates = region_coordinate_mappings[region].coords;

            var polygon = {
                "type": "Feature",
                "geometry": {
                    "type": "Polygon",
                    "coordinates": [coordinates]
                }
            };

            map.addSource(region, {
                type: "geojson",
                data: polygon
            });

            map.addLayer({
                id: regionSlug + "-layer",
                type: "fill",
                source: {
                    type: "geojson",
                    data: polygon
                },
                paint: {
                    "fill-color": "#1f2e3a",
                    "fill-opacity": 0.2
                }
            });

            console.log(regionSlug + "-layer");

            // when the layer is hovered, thicken its border and lighten its fill, then show a tooltip with its name
            map.on('mouseenter', regionSlug + "-layer", function() {
                map.setPaintProperty(regionSlug + "-layer", 'fill-opacity', 0.4);
                map.setPaintProperty(regionSlug + "-layer", 'fill-color', '#1f2e3a');
                map.getCanvas().style.cursor = 'pointer';
                map.setFeatureState({
                    source: region,
                    id: regionSlug + "-layer"
                }, {
                    hover: true
                });







            });

            // when your mouse moves off the layer, reset the border and fill
            map.on('mouseleave', regionSlug + "-layer", function() {
                map.setPaintProperty(regionSlug + "-layer", 'fill-opacity', 0.2);
                map.setPaintProperty(regionSlug + "-layer", 'fill-color', '#1f2e3a');
                map.getCanvas().style.cursor = '';
                map.setFeatureState({
                    source: region,
                    id: regionSlug + "-layer"
                }, {
                    hover: false
                });

            });

            // when you click on the layer, zoom in to it and also console.log its name
            map.on('click', regionSlug + "-layer", function() {

                // zoom to the polygon
                // find the center of the polygon
                var bounds = coordinates.reduce(function(bounds, coord) {
                    return bounds.extend(coord);
                }, new mapboxgl.LngLatBounds(coordinates[0], coordinates[0]));

                map.fitBounds(bounds, {
                    padding: 20
                });

                // trigger a click event on the dropdown menu, where the href contains the region's slug
                var regionLink = document.querySelector("a[href*='" + regionSlug + "']");
                regionLink.click();





                console.log(regionName);
            });



        });
    });
</script>