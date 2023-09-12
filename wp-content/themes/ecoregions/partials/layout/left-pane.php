<?php

$region_params = $args['region_params'];


if (!empty($region_params)) {
    $region_name = $region_params['region_name'];
    $region_overview = $region_params['region_overview'];
    $region_flavor_text = $region_params['region_flavor_text'];
    $region_id = $region_params['region_id'];
    $region_slug = $region_params['region_slug'];
} else {
    $region_name = 'No region selected';
    $region_overview = 'No region selected';
    $region_flavor_text = 'No region selected';
    $region_id = 'No region selected';
    $region_slug =  null;
}

?>

<div id="leftPane" class="col-md-6 pane-50 pane-50-left bg-dark text-white">

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

    <p class="text-white">When you select an ecoregion, you'll see some descriptive info about that ecoregion here.</p>


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