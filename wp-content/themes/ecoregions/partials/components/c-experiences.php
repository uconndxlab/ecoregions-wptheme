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
    //echo "Habitat Type: " . $requested_habitat . "<br>";
    $params['tax_query'][] = array(
        'taxonomy' => 'habitat',
        'field' => 'slug',
        'terms' => $requested_habitat,
    );
}

if(isset($requested_experience)) {
    //echo "Experience Type: " . $requested_experience . "<br>";
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
        <div class="col">
        <div class="card equal-height-card my-2">
            <img src="<?php echo get_the_post_thumbnail_url($experience->ID, 'thumbnail'); ?>" class="card-img-top" alt="Featured Image">
            <div class="card-body">
                <a href="<?php echo get_permalink($experience->ID); ?>" class="text-decoration-none">
                    <h4 class="card-title"><?php echo get_the_title($experience->ID); ?></h4>
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
                        <span class="badge <?php echo "badge-" . str_replace("/", "-", $experience_type_name); ?>"><?php echo $experience_type_name; ?></span>
                <?php

                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php
    }
} else {  ?>
    <div class="alert alert-warning" style="width: 100%;">
        There are no experiences available matching your query.
    </div>
<?php } ?>

