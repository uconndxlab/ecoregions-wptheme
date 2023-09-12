<?php
get_header();
?>

    <main>
        <?php if ( have_posts() ) :
            while ( have_posts() ) :
                the_post(); ?>

            <?php endwhile;
        ?>

        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>

    </main>



<?php
get_footer();