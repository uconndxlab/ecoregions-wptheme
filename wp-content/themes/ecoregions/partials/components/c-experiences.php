<?php
$region_slug = $args['region'];
$requested_habitat = $args['habitat'];
$requested_experience = $args['experience_type'];

if(!isset($requested_habitat)) {
    $requested_habitat = null;
}

if(!isset($requested_experience)) {
    $requested_experience = null;
}



// Get the experiences in this region
$params = array(
    'post_type' => 'experience',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'region',
            'field' => 'slug',
            'terms' => $region_slug,
        )
    )
);


$experiences = get_posts($params);



?>

<?php

if (!empty($experiences)) {
    // Loop through the experiences
    foreach ($experiences as $experience) {
        $habitats = get_the_terms($experience->ID, 'habitat');
        $habitat_names = array();
        if (isset($habitats)) {
            foreach ($habitats as $habitat) {
                $habitat_names[] = strtolower($habitat->name);
            }

            if (isset($requested_habitat)) {
                if (!in_array($requested_habitat, $habitat_names)) {
                    continue;
                }
            }
        }

        $experience_types = get_the_terms($experience->ID, 'experience_type');
        $experience_type_names = array();
        $experience_type_slugs = array();
        if (isset($experience_types)) {
            foreach ($experience_types as $experience_type) {

                $experience_type_names[] = strtolower($experience_type->name);
                $experience_type_slugs[] = strtolower($experience_type->slug);
            }
                if (isset($requested_experience)) {
                    if (!in_array($requested_experience, $experience_type_slugs)) {
                        continue;
                    }
                }
        }
?>
        <div>
            <ul class="list-group">


                <li
                <?php if(isset($display)) { ?>
                    style="display: <?php echo $display; ?>"
                <?php } ?>
                class="list-group-item my-2 alert-warning text-blue-darker">
                    <a class="list-group-item-action text-blue-darker" hx-target=".single-experience-target" hx-get="<?php echo get_permalink($experience->ID); ?>" hx-push-url="false" hx-select=".single-experience-wrap" href="<?php echo get_permalink($experience->ID); ?>">
                        <h4><?php echo get_the_title($experience->ID); ?></h4>
                        <p> <?php echo get_the_excerpt($experience->ID); ?></p>



                    </a>
                    <?php // do the badges for habitats and experience types
                    if (!empty($habitat_names)) {
                        foreach ($habitat_names as $habitat_name) {
                    ?>
                            <span class="badge bg-green"><?php echo $habitat_name; ?></span>
                        <?php
                        }
                    }

                    if (!empty($experience_type_names)) {
                        foreach ($experience_type_names as $experience_type_name) {
                        ?>
                            <span class="badge bg-secondary"><?php echo $experience_type_name; ?></span>
                    <?php

                        }
                    }
                    ?>
                </li>

            </ul>
        </div>

    <?php
    }
} else {  ?>

    <div class="alert alert-warning">
        There are no experiences available for this region.
    </div>

<?php }
