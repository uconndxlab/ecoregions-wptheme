<?php
$expl_id = $args['exploration']['ID'];
?>

<div class="exploration-blurb">
    <h3><?php echo get_the_title($expl_id); ?></h3>
    <p><?php echo get_the_content(null, false, $expl_id); ?></p>
</div>