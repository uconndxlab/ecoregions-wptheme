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
<div class="container-fluid">
    <div class="row">

        <?php get_template_part('partials/layout/left-pane'); ?>
        
        <div class="col-md-6 pane-50 pane-50-right bg-light">

            <div class="region-map">
                <h3 class="text-dark">All Regions</h3>

                <p>Replace this with a map. If there's content below, it's a specific experience being shown. Should overlay the map.</p>
                <?php get_template_part('partials/components/c-regions'); ?>
            </div>

            <div id="experienceDetail"></div>
            <div class="single-location"></div>

        </div>
    </div>
</div>

<?php
get_footer();
