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

if(isset($requested_habitat)) {
    echo "Habitat Type: " . $requested_habitat . "<br>";
    $params['tax_query'][] = array(
        'taxonomy' => 'habitat',
        'field' => 'slug',
        'terms' => $requested_habitat,
    );
}

if(isset($requested_experience)) {
    echo "Experience Type: " . $requested_experience . "<br>";
    $params['tax_query'][] = array(
        'taxonomy' => 'experience_type',
        'field' => 'slug',
        'terms' => $requested_experience,
    );
}
    

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
        }

        $experience_types = get_the_terms($experience->ID, 'experience_type');
        $experience_type_names = array();
        $experience_type_slugs = array();
        if (isset($experience_types)) {
            foreach ($experience_types as $experience_type) {

                $experience_type_names[] = strtolower($experience_type->name);
                $experience_type_slugs[] = strtolower($experience_type->slug);
            }
        }
?>
        <div>
            <ul class="list-group">


                <li
                <?php if(isset($display)) { ?>
                    style="display: <?php echo $display; ?>"
                <?php } ?>
                class="list-group-item my-2 bg-white text-blue-darker">
                    <a class="list-group-item-action text-blue-darker" 

                    href="<?php echo get_permalink($experience->ID); ?>">
                        <h4><?php echo get_the_title($experience->ID); ?></h4>
                        <p> <?php echo get_the_excerpt($experience->ID); ?></p>



                    </a>
                    <?php // do the badges for habitats and experience types
                    if (!empty($habitat_names)) {
                        foreach ($habitat_names as $habitat_name) {
                    ?>

                            <span class="badge <?php echo "badge-" . str_replace(" ", "-", $habitat_name); ?>"><?php echo $habitat_name; ?></span>
                        <?php
                        }
                    }

                    if (!empty($experience_type_names)) {
                        foreach ($experience_type_names as $experience_type_name) {
                        ?>
                            <span class="badge <?php echo "badge-" . str_replace("/", "-", $experience_type_name); ?>
                            
                            "><?php echo $experience_type_name; ?></span>
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
        There are no experiences available matching your query.
    </div>

<?php }
