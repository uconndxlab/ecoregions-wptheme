<?php
$region_slug = $args['region'];

// Get the experiences in this region
$experiences = get_posts(array(
    'post_type' => 'experience',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'region',
            'field' => 'slug',
            'terms' => $region_slug,
        )
    )
));



?>

<?php

if (!empty($experiences)) {
    // Loop through the experiences
    foreach ($experiences as $experience) {
        $habitats = get_the_terms($experience->ID, 'habitat');
        $habitat_names = array();
        if (!empty($habitats)) {
            foreach ($habitats as $habitat) {
                $habitat_names[] = $habitat->name;
            }
        }

        $experience_types = get_the_terms($experience->ID, 'experience_type');
        $experience_type_names = array();
        if (!empty($experience_types)) {
            foreach ($experience_types as $experience_type) {
                $experience_type_names[] = $experience_type->name;
            }
        }


?>
        <div>
            <ul class="list-group">


                <li class="list-group-item my-2 alert-warning text-blue-darker">
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
