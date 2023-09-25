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

        <div class="col-md-12 pane-50 pane-50-right bg-light">

            <div class="region-map">
                <!-- include a google map usa here -->
                <div class="map-wrap">
                    <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Hartford,%20CT+(Hartford,%20CT)&amp;t=&amp;z=8&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Population calculator map</a></iframe></div>
                </div>


                <?php get_template_part('partials/components/c-regions'); ?>
            </div>

            <div class="experience-detail"></div>

        </div>
    </div>
</div>





<?php
get_footer();
