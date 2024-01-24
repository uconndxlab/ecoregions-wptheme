<?php

$experience_pod = pods('experience', $post->ID);
$description = $experience_pod->display('description');
$attachments = $experience_pod->field('attachments');
// region is a taxonomy. get the region for the current experience
$current_region = get_the_terms($post->ID, 'region')[0]->name;
$region_name = $current_region;
$region_slug = get_the_terms($post->ID, 'region')[0]->slug;


if (!isHTMX()) {
    get_header();
}
?>

<div class="region-taxonomy-wrap region-<?php echo $region_slug; ?>">

    <!-- Hero Section -->
    <section class="hero" style="background-image: url(
    <?php echo get_template_directory_uri(); ?>/assets/images/hero-fpo.jpg); 
    background-attachment:fixed;
    background-size:cover; 
    background-repeat:no-repeat;
    max-height: 200px;">

        <div class="container">
            <div class="row py-4 align-items-center">
                <div class="col-md-6 px-4 py-3 bg-dark">
                    <h4 class="text-white fw-500">
                        <!-- blank badge -->
                        <span class="badge text-white"> </span>
                        <a href="<?php echo get_term_link($region_slug, 'region'); ?>" class="text-white fw-500 text-decoration-none">
                            <?php echo $region_name; ?>
                        </a>
                    </h4>
                    <h1 class="text-white fw-500"><?php the_title(); ?></h1>


                </div>
                <div class="col-md-6 text-center">
                </div>

                <!-- learn more scroll down -->



            </div>
        </div>
    </section>

    <div class="bg-dark">
        <div class="container text-white">
            <div class="single-experience-wrap row">


                <!-- Description column -->
                <div class="col-7">
                    <!-- link back to the region -->
                    <div class="experience-description mt-2 p-4 bg-white text-dark">
                        <?php if ($description) : ?>
                            <h4>Description</h4>
                            <?php echo $description; ?>
                        <?php else : ?>
                            <div class="alert alert-warning">
                                No description found.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Attachments column -->
                <div class="col-5">
                    <!-- Attachments content -->
                    <div class="experience-attachments mt-2 pt-4">
                        <?php
                        if (!empty($attachments)) { ?>
                            <h4>Attachments</h4>
                            <?php
                            foreach ($attachments as $attachment) {
                                $attachment_url = $attachment['guid'];
                                $attachment_title = $attachment['post_title'];
                                $attachment_type = $attachment['post_mime_type'];
                                $attachment_filename = basename($attachment_url);
                                $attachment_extension = pathinfo($attachment_filename, PATHINFO_EXTENSION);
                                $attachment_icon = get_template_directory_uri() . '/assets/images/icons/' . $attachment_extension . '-white.png';
                                //$attachment_icon = file_exists($attachment_icon) ? $attachment_icon : get_template_directory_uri() . '/assets/images/icons/unknown.png';
                            ?>
                                <div class="attachment text-white">
                                    <a class="text-white" href="<?php echo $attachment_url; ?>" target="_blank">
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
            </div> <!-- end single-experience-wrap -->

        </div>
        <script>
            // when the button is clicked, remove the node labeled "single-experience-wrap"
            // from the DOM



            document.getElementById('backToRegion').addEventListener('click', function() {
                document.querySelector('.single-experience-wrap').remove();
            });
        </script>
    </div>



    <?php

    if (!isHTMX()) {
        get_footer();
    }
