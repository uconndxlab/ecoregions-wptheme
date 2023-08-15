<?php
/*
Template Name: Regions List Template
*/

// get all Pod type Region (taxonomy) and put them in $regions
$regions = get_terms('region', array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false
));

// if not via htmx, load header
if (!isset($_SERVER['HTTP_HX_REQUEST'])):
    get_header();

    ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

<?php

endif;

?>

<header class="page-header">
    <h1 class="page-title">Regions</h1>
    <h2> Big ol map will go here.</h2>
</header>

<?php if ($regions && !is_wp_error($regions)) : ?>
    <ul class="region-list">
        <?php foreach ($regions as $region) : ?>
            <li><a
            hx-get = "<?php echo get_term_link($region); ?>"
            hx-target = "#main"
            hx-push-url = "true"
            href="<?php echo get_term_link($region); ?>"><?php echo $region->name; ?></a></li>
        <?php endforeach; ?>
    </ul>



<?php else : ?>
    <p>No regions found.</p>
<?php endif; ?>

<?php if (!isset($_SERVER['HTTP_HX_REQUEST'])): ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>

<?php endif; ?>