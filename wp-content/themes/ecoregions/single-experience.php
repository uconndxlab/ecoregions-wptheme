<?php

$experience_pod = pods('experience', $post->ID);
$description = $experience_pod->field('description');
$attachments = $experience_pod->field('attachments');
// region is a taxonomy. get the region for the current experience
$current_region = get_the_terms($post->ID, 'region')[0]->name;


if (!isHTMX()) {
    get_header();
}
?>
<div class="single-experience-wrap">
    <!--  link back to the region -->
    <a href="<?php echo get_term_link($current_region, 'region'); ?>" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Back to <?php echo $current_region; ?> Map
    </a>

    <h1><?php the_title(); ?></h1>


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="text-tab" data-bs-toggle="tab" href="#text" role="tab" aria-controls="text" aria-selected="true">Description</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="attachments-tab" data-bs-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">Attachments</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="text" role="tabpanel" aria-labelledby="text-tab">
            <!-- get the description -->
            <div class="experience-description mt-2">
                <?php if ($description): ?>
                    <h2>Description</h2>
                    <?php echo $description; ?>
                <?php else: ?>
                    <div class="alert alert-warning">
                        No description found.
                    </div>
                <?php endif; ?>
            </div>

        </div>
        <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">

            <!-- Attachments content -->
            <div class="experience-attachments mt-2">

                <?php
                if (!empty($attachments)) { ?>
                    <h2>Attachments</h2>

                    <?php
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
                } else {
                    // no attachments, show a bootstrap alert
                    ?>

                    <div class="alert alert-warning">
                        No attachments found.
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</div>


<?php

if (!isHTMX()) {
    get_footer();
}
