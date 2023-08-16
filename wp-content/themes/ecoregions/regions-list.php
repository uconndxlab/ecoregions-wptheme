<?php
/*
Template Name: Regions List Template (for the "Regions" page).
This route will be /regions (The "Regions" page must be created in the admin panel) 
If this route is being accessed via HTMX, then just return the list of regions, but if it's being accessed by a browser, then render the full layout.
*/



// get the c-regions.php component from /partials/components

// if this is an HTMX request, then just return the list of regions, otherwise render the full layout
if (isset($_SERVER['HTTP_HX_REQUEST'])) {
    // this is an HTMX request
    get_template_part('partials/components/c-regions');
} else {
    // this is a browser request
    get_header();
        ?>

<!-- bootstrap page header -->
<div class="container-fluid">
    <div class="row">

        <div id="results" class="col-md-6 pane-50 pane-50-left bg-dark text-white">
           
            <p class="text-white">This is the Regions page template. It will display a map of EcoRegions on the right.</p> 
            <p class="text-white">When you select an ecoregion, you'll also see some descriptive info here.</p>


            <h3 class="text-white">Explorations</h3>
            <p class="text-white">This is a list of all the explorations. If a region is selected, then only the explorations in that region will be displayed.</p>
            <!-- all the explorations -->
            
            <div class="my-2"><?php get_template_part('partials/content-subjects'); ?></div>

            <?php get_template_part('partials/content-habitats'); ?>

            <?php get_template_part('partials/components/c-explorations'); ?>
        </div>

        <div class="col-md-6 pane-50 pane-50-right bg-light">
            <h3 class="text-dark">EcoRegions</h3>

            


            <?php get_template_part('partials/components/c-regions'); ?>
            <p>Replace this with a map.</p>
        </div>
    </div>
</div>




<?php
    get_footer();
}

