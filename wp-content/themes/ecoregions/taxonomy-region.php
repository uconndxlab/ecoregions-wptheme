<?php
/*
Template Name: Regions Taxonomy Template (Really only for use on a Region taxonomy listing)
*/


// Query all pods of type "location"
$args = array(
    'post_type' => 'location', // Replace with your custom pods post type
    'posts_per_page' => -1,
);
$locations_query = new WP_Query($args);

$args = array(
    'post_type' => 'exploration', // Replace with your custom pods post type
    'posts_per_page' => -1,
);

$explorations_query = new WP_Query($args);


if (!isset($_SERVER['HTTP_HX_REQUEST'])):

    get_header();

endif;


?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <header class="page-header">
            <h1 class="page-title">
                <?php 
                    // get the name of the current taxonomy
                    $term = get_queried_object();
                    echo $term->name;


                ?>
            </h1>
        </header>

        <h2 class="text-white"> Locations in this region </h2>
        <?php if ($locations_query->have_posts()) : ?>
            <ul class="location-list">
                <?php while ($locations_query->have_posts()) : $locations_query->the_post(); ?>
                    <li><a
                    hx-get = "<?php the_permalink(); ?>"
                    hx-target = "#results"
                    hx-push-url = "true"
                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>No locations found.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>

        <h2 class="text-white"> All Explorations in this region </h2>
        <?php if ($explorations_query->have_posts()) : ?>
            <ul class="exploration-list">
                <?php while ($explorations_query->have_posts()) : $explorations_query->the_post(); ?>
                    <li><a
                    hx-get = "<?php the_permalink(); ?>"
                    hx-target = "#results"
                    hx-push-url = "true"
                    
                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>No explorations found.</p>
        <?php endif; ?>
    </main>
</div>

<?php if (!isset($_SERVER['HTTP_HX_REQUEST'])): ?>

<?php get_footer(); ?>

<?php endif; ?>
