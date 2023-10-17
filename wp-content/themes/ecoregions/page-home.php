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
<section id="regions" class="regions">
    <div class="container-fluid">
        <div class="row no-gutters p-0">

            <div class="col-md-7 no-gutters p-0" style="position: relative;">
                <div>
                    <?php
                    $params = array(
                        'limit' => -1,
                        'orderby' => 'name ASC'
                    );

                    $regions = pods('region', $params);

                    $isEmpty = $regions->total() === 0; ?>



                    <div style="position: absolute; top:50px; right:20px; z-index:999;" class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="regionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Region
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="regionsDropdown">
                            <?php while ($regions->fetch()) : ?>
                                <li><a class="dropdown-item" hx-get="<?php echo $regions->display('permalink'); ?>" hx-push-url="false" hx-target=".region-info" hx-select="#region-meat" href="<?php echo $regions->display('permalink'); ?>"><?php echo $regions->display('name'); ?></a></li>
                            <?php endwhile; ?>
                            <?php // reset the regions query
                            $regions->reset(); ?>
                        </ul>
                    </div>

                </div>
                <div id="map" class="map d-none d-lg-block"></div>
            </div>

            <div class="col-md-5 p-4 region-wrap bg-blue-dark"">

                <div class=" region-info text-white">

                <h2>Let's explore Connecticut's Ecoregions!</h2>
                <p>Select a region on the map or in the dropdown menu to learn more about it.</p>
                <p>Each region has a unique combination of geology, topography, soils, climate, and plant and animal communities. </p>
                <!-- show the dropdown menu -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="regionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Region
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="regionsDropdown">
                        <?php while ($regions->fetch()) : ?>
                            <li><a class="dropdown-item" hx-get="<?php echo $regions->display('permalink'); ?>" hx-push-url="false" hx-target=".region-info" hx-select="#region-meat" href="<?php echo $regions->display('permalink'); ?>"><?php echo $regions->display('name'); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>

            </div>
        </div>


    </div>
    </div>
</section>


<script>
    var mapbox_key = "pk.eyJ1IjoidWNvbm5keGdyb3VwIiwiYSI6ImNrcTg4dWc5NzBkcWYyd283amtpNjFiZXkifQ.iGpZ5PfDWFWWPkuDeGQ3NQ";
    //intialize the inital map data
    var region_coordinate_mappings = {
        "northwestern-uplands": [
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
        ],
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
</script>

<?php get_footer(); ?>