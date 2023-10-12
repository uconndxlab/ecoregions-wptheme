<?php
/*
Template Name: Regions List Template (for the "Regions" page).
This route will be /regions (The "Regions" page must be created in the admin panel) 
If this route is being accessed via HTMX, then just return the list of regions, but if it's being accessed by a browser, then render the full layout.
*/



// this is a browser request
get_header();
?>

<!-- bootstrap page header -->
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="region-list">
                <?php get_template_part('partials/components/c-regions'); ?> 

            </div>

        </div>

        <div class="experience-detail"></div>

    </div>
</div>
</div>

<script>
    let mapbox_key = "pk.eyJ1IjoidWNvbm5keGdyb3VwIiwiYSI6ImNrcTg4dWc5NzBkcWYyd283amtpNjFiZXkifQ.iGpZ5PfDWFWWPkuDeGQ3NQ";
    // intialize the inital map data
    // let region_coordinate_mappings = {
    //     "northwestern-uplands": [
    //         [-72.82161082594858, 42.035933621864295],
    //         [-73.4873136457728, 42.049446888173385],
    //         [-73.53535710341936, 41.44558860831884],
    //         [-73.44467683996596, 41.59054265050452],
    //         [-73.20293456479384, 41.772053800976785],
    //         [-73.10146797338896, 41.73207678388107],
    //         [-73.01510758315594, 41.775084941678145],
    //         [-72.96719934136044, 41.82676315673198],
    //         [-72.8725992050337, 41.837486521688604],
    //         [-72.84438786871107, 41.95087354088623],
    //     ],
    // }

    // let layerStates = {
    //     townNames: true,
    //     regions: true,
    //     geologicalFeatures: true,
    // }

    mapboxgl.accessToken = mapbox_key;
    // const map = new mapboxgl.Map({
    //     container: 'map', 
    //     style: "mapbox://styles/uconndxgroup/ckvb5m4qm0q0v14qs76jitlc6",
    //     center: [-72.6734, 41.5758], // starting position [lng, lat]
    //     zoom: 8, // starting zoom
    // });
</script>


<style>

</style>



<?php
get_footer();
