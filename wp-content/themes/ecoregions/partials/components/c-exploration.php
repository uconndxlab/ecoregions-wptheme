<?php
$expl_id = $args['exploration']['ID'];
?>

<div class="exploration-blurb">
    <h4><?php echo get_the_title($expl_id); ?></h4>
    <p><?php echo get_the_content(null, false, $expl_id); ?></p>
</div>