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

get_header();
?>

<header class="page-header">
    <h1 class="page-title">Regions</h1>
    <h2> Big ol map will go here.</h2>
</header>

<?php if ($regions && !is_wp_error($regions)) : ?>
    <ul class="region-list">
        <?php foreach ($regions as $region) : ?>
            <li><a href="<?php echo get_term_link($region); ?>"><?php echo $region->name; ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No regions found.</p>
<?php endif; ?>

<?php get_footer(); ?>