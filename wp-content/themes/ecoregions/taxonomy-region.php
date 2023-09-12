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
<h1>It is HTMX </h1>
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
        <h2>It is not HTMX</h2>
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
                    <h3 class="text-dark">All Regions</h3>

                    <p>Replace this with a map. If there's content below, it's a specific experience being shown. Should overlay the map.</p>
                    <?php get_template_part('partials/components/c-regions'); ?>

                </div>

                <div class="experience-detail">

                </div>

            </div>

        </div>
    </div>

<?php
    get_footer(); // Include your footer template
}
