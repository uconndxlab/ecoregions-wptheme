<?php

$region_params = $args['region_params'];


if (!empty($region_params)) {
    $region_name = $region_params['region_name'];
    $region_overview = $region_params['region_overview'];
    $region_flavor_text = $region_params['region_flavor_text'];
    $region_id = $region_params['region_id'];
    $region_slug = $region_params['region_slug'];
} else {
    $region_name = '';
    $region_overview = '';
    $region_flavor_text = '';
    $region_id = '';
    $region_slug =  null;
}

?>

<div id="leftPane" class="col-md-12 pane-50 pane-50-left bg-dark text-white">

    <?php if ($region_id == '') : ?>
        <h2 class="text-white">An Introduction to Ecological Regions and Geological Features of Connecticut</h2>
        <div class="video-wrap">
            <iframe width="500" height="281" src="https://www.youtube.com/embed/wllTzw7O-z0" title="CSMNH - Introduction to the Ecoregions of Connecticut" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <h3 class="my-3"> Project Overview</h3>
        <p class="text-white my-3">From one corner to another …… observant passengers traveling in a vehicle following a diagonal route from the town of Stonington, along the southeastern coast of the state, to the town of Salisbury, in the northwestern corner, would notice a myriad of changes as they traverse the landscape. From standing on the shore and gazing out over Long Island Sound, our travelers would leave the ocean-scented air of the coast, and rise in elevation from less than 100 feet to over 1,500 feet. They would drive through rural, suburban and urban communities. And, although they would travel through many acres of forest, the presence of numerous stone walls would serve as a reminder of a not-so-distant past when trees did not dominant the land.</p>

    <?php endif; ?>

<h2><?php echo $region_name; ?></h2>


<!-- Nav tabs -->
<ul class="nav nav-tabs d-flex justify-content-around" id="regionTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="experiences-tab" data-bs-toggle="tab" href="#experiences" role="tab" aria-controls="experiences" aria-selected="false">Experiences</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content" id="regionTabContent">
    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
        <h3><?php echo $region_flavor_text; ?></h3>
        <p class="my-3"><?php echo $region_overview; ?></p>
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

<script>
    // Initialize the Bootstrap tabs
    var regionTabs = new bootstrap.Tab(document.getElementById('overview-tab'));
    regionTabs.show();
</script>




    <?php if (empty($region_params)) { ?>
        <div class="alert alert-warning mt-4">
            Select an ecoregion to see the experiences in that region.
        </div>
    <?php } ?>
</div>