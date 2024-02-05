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

<div class="region-taxonomy-wrap region-<?php echo $region_slug; ?>">

    <!-- Hero Section -->
    <section class="hero" style="background-image: url(
    <?php echo get_template_directory_uri(); ?>/assets/images/hero-fpo.jpg); background-attachment:fixed;background-size:cover; background-repeat:no-repeat; max-height: 500px;">
        <div class="container">
            <div class="row py-4 align-items-center">
                <div class="col-md-6 p-4 bg-blue">
                    <h2 class="text-white fw-500">
                        <!-- blank badge -->
                        <span class="badge text-white"> </span>
                        <?php echo $region_name; ?>
                    </h2>
                    <h5 class="text-white fw-500"><?php echo $region_flavor_text; ?></h5>

                </div>
                <div class="col-md-6 text-center">
                    <img style="position:sticky; top:25px; object-fit:contain; max-height:450px;" class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/images/map_svg/<?php echo $region_slug; ?>.png" alt="<?php echo $region_name; ?>">

                </div>

                <!-- learn more scroll down -->



            </div>
        </div>
    </section>

    <div class="bg-dark">
        <div class="container text-white">

            <div class="row bg-dark pt-5">
                <div id="region-meat" class="row">
                    <div class="col-md-12 region-overview bg-blue-light text-white p-4">
                        <h4 class="text-white">About <?php echo $region_name; ?></h4>
                        <div>
                            <?php echo $region_overview; ?>
                        </div>
                        <?php if (empty($region_overview)) : ?>
                            <div class="alert alert-warning" role="alert">
                                <h3>No Region Information Found</h3>
                                <p>It looks like we haven't finished populating the content for this ecoregion. Check back soon!</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-8">
                        <h4 class="text-white stuff-to-do-header mb-5 mt-4">Stuff To Do</h4>
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
                        <div class="single-experience-target"></div>

                    </div>

                    <div class="col-md-4">
                        <h4 class="text-white stuff-to-do-header mb-5 mt-4">Filter Options</h4>
                        <div class="experience-search-wrap">
                            <!-- add filter dropdowns for "activity_type" and "habitat" -->
                            <div class="filter-experiences">
                                <h5 class="text-white">Filter by Habitat</h5>
                                <nav class="nav">
                                    <ul id="habitat-menu" class="nav mb-4 nav-pills flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/region/<?php echo $region_slug; ?>/">All Habitats</a>
                                        </li>
                                        <?php
                                        $habitat_params = array(
                                            'limit' => -1,
                                            'orderby' => 'name ASC'
                                        );

                                        $habitats = pods('habitat', $habitat_params);

                                        while ($habitats->fetch()) :
                                        ?>
                                            <li class="nav-item">
                                                <a class="text-white nav-link <?php if ($_GET['hab'] == $habitats->field('slug')) : ?>active<?php endif; ?>" href="/region/<?php echo $region_slug; ?>/?hab=<?php echo $habitats->field('slug'); ?>"><?php echo $habitats->display('name'); ?></a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </nav>
                            </div>

                            <div class="filter-experiences">
                                <h5 class="text-white" id="activity-type">Filter by Experience Type</h5>
                                <nav class="nav flex-column">
                                    <ul id="activity-menu" class="nav mb-4 nav-pills flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/region/<?php echo $region_slug; ?>/">All Experience Types</a>
                                        </li>
                                        <?php
                                        $experience_type_params = array(
                                            'limit' => -1,
                                            'orderby' => 'name ASC'
                                        );

                                        $experience_types = pods('experience_type', $experience_type_params);

                                        while ($experience_types->fetch()) :
                                        ?>
                                            <li class="nav-item">
                                                <a class="text-white nav-link <?php if ($_GET['ex_type'] == $experience_types->field('slug')) : ?>active<?php endif; ?>" href="/region/<?php echo $region_slug; ?>/?ex_type=<?php echo $experience_types->field('slug'); ?>"><?php echo $experience_types->display('name'); ?></a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

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

    // if the url doesn't have a query string, activate the first tab
    // otherwise, activate the second tab

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const habitat = urlParams.get('hab');
</script>

<?php
get_footer(); // Include your footer template
