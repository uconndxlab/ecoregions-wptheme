<?php
get_header();
?>



    <main class="location-type">

        <?php if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
        ?>
            <div class="location-info">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_post_meta( $post->ID, 'flavor_text', true); ?></p>
            </div>

            <div class="conversations">
                <h2>Conversations With</h2>
                <p>Video with content supporting the selected Visit and Explore sites.  Topics cover geology, climate, vegetation, biology, ecology/conservation, archaeology/history, and Native Americans.</p>

                <?php get_template_part( 'partials/content', 'conversations' ); ?>
            </div>

            <div class="explorations">
                <h2>Further Your Exploration</h2>
                <p>Links to other sites of interest in the region especially hiking trails, archaeological sites, and natural history related education centers.</p>

                <?php get_template_part( 'partials/content', 'explorations' ); ?>
            </div>

            <?php endwhile; ?>

        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
        
    </main>

<?php
if (!isHTMX())
    get_footer(); ?>