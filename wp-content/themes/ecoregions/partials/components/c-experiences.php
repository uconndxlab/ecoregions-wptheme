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
} else {
  
}

// Loop through the experiences
foreach ($experiences as $experience) {

?>
    <div class="single-experience">
        <ul class="list-group">
            <li class="list-group-item">
                
            <a 

            hx-target = ".experience-detail"
            hx-get = "<?php echo get_permalink($experience->ID); ?>"  
            hx-push-url="true"
            hx-select = ".single-experience-wrap"
            href="<?php echo get_permalink($experience->ID); ?>">
                <?php echo get_the_title($experience->ID); ?>
            </a>
            </li>
        </ul>
    </div>

<?php
}
?>