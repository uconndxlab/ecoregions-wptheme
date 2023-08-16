<?php

$location_pod = pods('location', $post->ID);
$conversations = $location_pod->field('conversations');


if ( !empty($conversations) ) : ?>

    <?php
        foreach( $conversations as $conv ) {
            get_template_part('partials/components/c', 'conversation', array(
                'conversation' => $conv
            ));
        }
    ?>

<?php else: ?>

<p>No conversations.</p>

<?php endif;
