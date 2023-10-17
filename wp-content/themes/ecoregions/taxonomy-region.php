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




// This is a browser request, render the full layout
get_header(); // Include your header template
?>

<style>

</style>


<div class="container-fluid">
    <div class="row">
        <div id="region-meat" class="col-md-12">
            <h2><?php echo $region_name; ?></h2>


            <!-- Nav tabs -->

            <?php if (!empty($region_overview)) : ?>

                <ul class="nav nav-tabs d-flex" id="regionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="experiences-tab" data-bs-toggle="tab" href="#experiences" role="tab" aria-controls="experiences" aria-selected="false">Experiences</a>
                    </li>
                </ul>
            <?php endif; ?>

            <!-- Tab panes -->
            <div class="tab-content" id="regionTabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <h5><?php echo $region_flavor_text; ?></h5>
                    <p class="my-3"><?php echo $region_overview; ?></p>

                    <?php if (empty($region_overview)) : ?>
                        <div class="alert alert-warning" role="alert">
                            <h3>No Region Information Found</h3>
                            <p>It looks like we haven't finished populating the content for this ecoregion. Check back soon!</p>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="tab-pane fade" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">
                    <?php
                    // Include your experiences content here, or use your existing code to get experiences
                    get_template_part('partials/components/c', 'experiences', array(
                        'region' => $region_slug,
                    ));
                    ?>
                </div>
            </div>
            <div class="single-experience-target">

            </div>
        </div>

    </div>
</div>

<?php
get_footer(); // Include your footer template
