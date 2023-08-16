<?php

$location_pod = pods('location', $post->ID);
$explorations = $location_pod->field('explorations');

if ( !empty($explorations) ) : ?>

    <?php
        foreach( $explorations as $expl ) {
            get_template_part('partials/components/c', 'explorations', array(
                'exploration' => $expl
            ));
        }
    ?>

<?php else: ?>

<p>No explorations.</p>

<?php endif;
