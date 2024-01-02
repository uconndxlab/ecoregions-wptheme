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
$region_overview = $region_pod->display('overview');
// since we're using the wysiwyg editor, we need to use the display function to get the content


$region_flavor_text = $region_pod->field('flavor_text');
$region_slug = $region->slug;

$experience_type = $_GET['ex_type'];
$habitat = $_GET['hab'];

if (!isset($experience_type) or $experience_type == 'all') {
    $experience_type = null;
}

if (empty($habitat) or $habitat == 'all') {
    $habitat = null;
}


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


<div id="region-taxnonomy" class="container-fluid text-white">
    <div class="row bg-dark pt-5">
        <div class="col-md-6">
            <img style="position:sticky; top:25px;" class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/images/map_svg/<?php echo $region_slug; ?>.svg" alt="<?php echo $region_name; ?>">
        </div>
        <div id="region-meat" class="col-md-6">
            <h2><?php echo $region_name; ?></h2>


            <!-- Nav tabs -->

            <?php if (!empty($region_overview)) : ?>

                <ul class="nav nav-tabs d-flex" id="regionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item 
                    <?php if (($experience_type) or ($habitat)) : ?>
                        active
                    <?php endif; ?>
                    " role="presentation"
                    
                    >
                        <a class="nav-link
                        <?php if (($experience_type) or ($habitat)) : ?>
                        active
                    <?php endif; ?>
                        " id="experiences-tab" data-bs-toggle="tab" href="#experiences" role="tab" aria-controls="experiences" aria-selected="false">Stuff To Do</a>
                    </li>
                </ul>
            <?php endif; ?>

            <!-- Tab panes -->
            <div class="tab-content" id="regionTabContent">
                <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <h5><?php echo $region_flavor_text; ?></h5>
                    <div class="my-3"><?php echo $region_overview; ?></div>

                    <?php if (empty($region_overview)) : ?>
                        <div class="alert alert-warning" role="alert">
                            <h3>No Region Information Found</h3>
                            <p>It looks like we haven't finished populating the content for this ecoregion. Check back soon!</p>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="tab-pane fade
                <?php if (($experience_type) or ($habitat)) : ?>
                        active show
                    <?php endif; ?>
                " id="experiences" role="tabpanel" aria-labelledby="experiences-tab">
                    <!-- add filter dropdowns for "activity_type" and "habitat" -->
                    <form method="get" action="/region/<?php echo $region_slug; ?>/" id="filter_experiences" >
                        <div class="d-flex justify-content-between">

                            <div class="filter-experiences mb-4">
                                <select id="habitat-select" name="hab">
                                    <option value="">All Habitats</option>
                                    <?php
                                    $habitat_params = array(
                                        'limit' => -1,
                                        'orderby' => 'name ASC'
                                    );

                                    $habitats = pods('habitat', $habitat_params);

                                    while ($habitats->fetch()) :
                                    ?>
                                        <option <?php if ($habitats->field('slug') == $habitat) : ?> selected <?php endif; ?> value="<?php echo $habitats->field('slug'); ?>"><?php echo $habitats->display('name'); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="filter-experiences mb-4">
                                <select id="activity-select" name="ex_type">
                                    <option value="all">All Experience Types</option>
                                    <?php
                                    $experience_type_params = array(
                                        'limit' => -1,
                                        'orderby' => 'name ASC'
                                    );

                                    $experience_types = pods('experience_type', $experience_type_params);

                                    while ($experience_types->fetch()) :
                                    ?>
                                        <option value="<?php echo $experience_types->field('slug'); ?>"><?php echo $experience_types->display('name'); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </form>


                    <div class="experience-results">
                        <?php
                        // Include your experiences content here, or use your existing code to get experiences
                        get_template_part('partials/components/c', 'experiences', array(
                            'region' => $region_slug,
                            'habitat' => $habitat,
                            'experience_type' => $experience_type
                        ));
                        ?>
                    </div>


                </div>

            </div>
            <div class="single-experience-target">

            </div>
        </div>
    </div>
</div>

    <script>
        // when one of the dropdowns is changed, submit the form

        document.querySelector('#habitat-select').addEventListener('change', function() {
            document.querySelector('#filter_experiences').submit();
            
        });

        document.querySelector('#activity-select').addEventListener('change', function() {
            document.querySelector('#filter_experiences').submit();
        });
    </script>

    <?php
    get_footer(); // Include your footer template
