<?php
/*
Template Name: Home Page
*/
get_header();
?>
<style>
    #map {
        height: 840px;
        width: 100%;
    }
</style>
<!-- Hero Section -->
<section class="hero" style="background-image: url(
    <?php echo get_template_directory_uri(); ?>/assets/images/hero-fpo.jpg); background-attachment:fixed;background-size:cover; background-repeat:no-repeat;">
    <div class="container">
        <div class="row py-4 align-items-center
        
        ">
            <div class="col-md-6 bg-blue text-white material-shadow py-3 px-4">
                <h1 class="my-3"> Connecticut's Ecoregions </h1>
                <p class="my-3">From one corner to another, observant passengers traveling in a vehicle following a diagonal route from the town of Stonington, along the southeastern coast of the state, to the town of Salisbury, in the northwestern corner, would notice a myriad of changes as they traverse the landscape.
                </p>
                <p class="my-3"> From standing on the shore and gazing out over Long Island Sound, our travelers would leave the ocean-scented air of the coast, and rise in elevation from less than 100 feet to over 1,500 feet. They would drive through rural, suburban and urban communities. And, although they would travel through many acres of forest, the presence of numerous stone walls would serve as a reminder of a not-so-distant past when trees did not dominant the land.</p>

            </div>
            <div class="col-md-6">
                <div class="card material-shadow">
                    <div class="card-body">
                        <h5 class="card-title">Introduction to the Ecoregions of Connecticut</h5>
                        <div class="video-wrap">
                            <iframe width="500" height="281" src="https://www.youtube.com/embed/wllTzw7O-z0" title="CSMNH - Introduction to the Ecoregions of Connecticut" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- learn more scroll down -->



        </div>
    </div>
</section>

<!-- Regions Section -->
<section id="regions" class="regions bg-dark">
    <div class="container-fluid">
        <div class="row no-gutters p-0">
            <div class="col-md-8 no-gutters p-4" style="position: relative;">
                <div>
                    <?php
                    $params = array(
                        'limit' => -1,
                        'orderby' => 'name ASC'
                    );

                    $regions = pods('region', $params);

                    $isEmpty = $regions->total() === 0; ?>



                    <div style="position: absolute; top:50px; right:20px; z-index:999;" class="dropdown d-none">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="regionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Region
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="regionsDropdown">
                            <?php while ($regions->fetch()) : ?>
                                <li><a class="dropdown-item" href="<?php echo $regions->display('permalink'); ?>"><?php echo $regions->display('name'); ?></a></li>
                            <?php endwhile; ?>
                            <?php // reset the regions query
                            $regions->reset(); ?>
                        </ul>
                    </div>

                </div>

                <!-- display the town map gif image -->
                <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/townmap_blue.gif" alt="Connecticut's Ecoregions" class="img-fluid" /> -->

                <div class="map d-none d-lg-block">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/map_svg/CT_Map_NoKey.gif" alt="Connecticut's Ecoregions" class="img-fluid" />
                </div>
            </div>

            <div class="col-md-4 p-4 region-wrap bg-blue-dark"">
            <div class="filter-regions mb-4 dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="regionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Region
                </button>
                <ul class="dropdown-menu" aria-labelledby="regionsDropdown">
                    <?php while ($regions->fetch()) : ?>
                        <li><a class="dropdown-item" href="<?php echo $regions->display('permalink'); ?>"><?php echo $regions->display('name'); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class=" 
            clearfix
             region-info text-white
             bg-blue-light p-4 material-shadow
             mt-5
             ">

                <h2>Let's explore!</h2>
                <p>Select a region on the map or in the dropdown menu to learn more about it.</p>
                <p>Each region has a unique combination of geology, topography, soils, climate, and plant and animal communities. </p>
                <!-- show the dropdown menu -->


            </div>
        </div>


    </div>
    </div>
</section>


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

    map.on('load', function(){  

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

<?php get_footer(); ?>