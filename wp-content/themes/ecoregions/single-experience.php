<?php

$experience_pod = pods('experience', $post->ID);
$description = $experience_pod->field('description');
$attachments = $experience_pod->field('attachments');

if(!isHTMX()) {
    get_header();
}
?>

        <div class="single-experience-wrap">

            <h1><?php the_title(); ?></h1>

            <!-- get the content -->
            <?php the_excerpt(); ?>

            <!-- get the description -->
            <div class="experience-description">
                <h2>Description</h2>
                <?php echo $description; ?>
            </div>

            <div class="experience-attachments">

                <h2>Attachments</h2>

                <!-- get the attachments -->
                <?php
                if (!empty($attachments)) {
                    foreach ($attachments as $attachment) {
                        $attachment_url = $attachment['guid'];
                        $attachment_title = $attachment['post_title'];
                        $attachment_description = $attachment['post_content'];
                        $attachment_type = $attachment['post_mime_type'];
                        $attachment_filename = basename($attachment_url);
                        $attachment_extension = pathinfo($attachment_filename, PATHINFO_EXTENSION);
                        $attachment_icon = get_template_directory_uri() . '/assets/images/icons/' . $attachment_extension . '.png';
                        //$attachment_icon = file_exists($attachment_icon) ? $attachment_icon : get_template_directory_uri() . '/assets/images/icons/unknown.png';

                ?>

                        <div class="attachment">
                            <a href="<?php echo $attachment_url; ?>" target="_blank">
                                <img src="<?php echo $attachment_icon; ?>" alt="<?php echo $attachment_type; ?>">
                                <span><?php echo $attachment_title; ?></span>
                            </a>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>

<?php

if(!isHTMX()) {
    get_footer();
}
