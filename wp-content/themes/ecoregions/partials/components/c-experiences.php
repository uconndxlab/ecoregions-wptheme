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

// Loop through the experiences
foreach ($experiences as $experience) {

?>
    <div class="single-experience">
        <a 

        hx-target = ".experience-detail"
        hx-get = "<?php echo get_permalink($experience->ID); ?>"  
        hx-select = ".single-experience-wrap"
        href="<?php echo get_permalink($experience->ID); ?>">
            <?php echo get_the_title($experience->ID); ?>
        </a>
    </div>

<?php
}
?>