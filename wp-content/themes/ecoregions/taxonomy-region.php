<?php

/** taxonomy-region.php
 *
 * The template for displaying the region taxonomy
 */

// Get the region taxonomy
$region = get_queried_object();

// get the pods field 'overview'
$region_pod = pods('region', $region->term_id);
$region_name = $region->name;
$region_overview = $region_pod->field('overview');
$region_flavor_text = $region_pod->field('flavor_text');
$region_slug = $region->slug;

$region_params = array(
    'region_name' => $region->name,
    'region_overview' => $region_overview,
    'region_flavor_text' => $region_flavor_text,
    'region_id' => $region->term_id,
    'region_slug' => $region_slug
);



// Check if this is an HTMX request using your custom function
if (isHTMX()) { ?>
    <div class="region-info">
        <h2><?php echo esc_html($region_name); ?></h2>
        <p><?php echo esc_html($region_overview); ?></p>
        <p><?php echo esc_html($region_flavor_text); ?></p>
        <div class="region-experiences">
            <?php

            get_template_part(
                'partials/layout/left-pane',
                null,
                array(
                    'region_params' => $region_params,
                )
            );
            ?>
        </div>
    </div>
<?php
} else {
    // This is a browser request, render the full layout
    get_header(); // Include your header template
?>

    <div class="container-fluid">
        <div class="row">

            <?php

            get_template_part(
                'partials/layout/left-pane',
                null,
                array(
                    'region_params' => $region_params,
                )
            );
            ?>

            <div class="col-md-12 pane-50 pane-50-right bg-light">

                <div class="region-map">
                    <div class="region-map">
                    <?php get_template_part('partials/components/c-regions'); ?>
                    <h3><?php echo esc_html($region_name); ?></h3>


                        <!-- include a google map usa here -->
                        <div class="map-wrap">
                            <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Hartford,%20CT+(Hartford,%20CT)&amp;t=&amp;z=8&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Population calculator map</a></iframe></div>
                        </div>
                    </div>

                </div>



                <div class="experience-detail">

                </div>

            </div>

        </div>
    </div>

<?php
    get_footer(); // Include your footer template
}
