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
        <p class="text-white">From one corner to another …… observant passengers traveling in a vehicle following a diagonal route from the town of Stonington, along the southeastern coast of the state, to the town of Salisbury, in the northwestern corner, would notice a myriad of changes as they traverse the landscape. From standing on the shore and gazing out over Long Island Sound, our travelers would leave the ocean-scented air of the coast, and rise in elevation from less than 100 feet to over 1,500 feet. They would drive through rural, suburban and urban communities. And, although they would travel through many acres of forest, the presence of numerous stone walls would serve as a reminder of a not-so-distant past when trees did not dominant the land.</p>

    <?php endif; ?>



    <h2>
        <?php
        echo $region_name;
        ?>
    </h2>

    <h3>
        <?php
        echo $region_flavor_text;
        ?>
    </h3>

    <p>
        <?php
        echo $region_overview;
        ?>
    </p>



    <h3 class="text-white">Experiences</h3>
    <!-- get the experiences c-experiences -->
    <?php
    get_template_part('partials/components/c', 'experiences', array(
        'region' => $region_slug,
    ));
    ?>



    <?php if (empty($region_params)) { ?>
        <div class="alert alert-warning mt-4">
            Select an ecoregion to see the experiences in that region.
        </div>
    <?php } ?>
</div>