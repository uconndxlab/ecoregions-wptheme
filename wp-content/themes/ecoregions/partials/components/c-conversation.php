<?php
$conv_id = $args['conversation']['ID'];
$post_meta = array(
    'video_link' => get_post_meta( $conv_id, 'video_link', true ),
    'speaker' => get_post_meta( $conv_id, 'speaker', true)
); ?>

<div class="conversation-blurb">
    <span class="conversation-blurb-subhead"><?php echo $post_meta['speaker']; ?></span>
    <h3><?php echo get_the_title($conv_id); ?></h3>
    <p><?php echo get_the_content(null, false, $conv_id); ?></p>
    <?php echo $post_meta['video_link']; ?>
</div>