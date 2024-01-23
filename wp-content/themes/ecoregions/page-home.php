<?php
/*
Template Name: Home Page
*/
get_header();
?>
<style>
    #map {
        height: 840px;
        width: 100%;
    }
</style>
<!-- Hero Section -->
<section class="hero" style="background-image: url(
    <?php echo get_template_directory_uri(); ?>/assets/images/hero-fpo.jpg); background-attachment:fixed;background-size:cover; background-repeat:no-repeat;">
    <div class="container">
        <div class="row py-4 align-items-center
        
        ">
            <div class="col-md-6 bg-blue text-white material-shadow py-3 px-4">
                <h1 class="my-3"> Connecticut's Ecoregions </h1>
                <p class="my-3">From one corner to another, observant passengers traveling in a vehicle following a diagonal route from the town of Stonington, along the southeastern coast of the state, to the town of Salisbury, in the northwestern corner, would notice a myriad of changes as they traverse the landscape.
                </p>
                <p class="my-3"> From standing on the shore and gazing out over Long Island Sound, our travelers would leave the ocean-scented air of the coast, and rise in elevation from less than 100 feet to over 1,500 feet. They would drive through rural, suburban and urban communities. And, although they would travel through many acres of forest, the presence of numerous stone walls would serve as a reminder of a not-so-distant past when trees did not dominant the land.</p>

            </div>
            <div class="col-md-6">
                <div class="card material-shadow">
                    <div class="card-body">
                        <h5 class="card-title">Introduction to the Ecoregions of Connecticut</h5>
                        <div class="video-wrap">
                            <iframe width="500" height="281" src="https://www.youtube.com/embed/wllTzw7O-z0" title="CSMNH - Introduction to the Ecoregions of Connecticut" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- learn more scroll down -->



        </div>
    </div>
</section>

<!-- Regions Section -->
<section id="regions" class="regions bg-dark">
    <div class="container-fluid">
        <div id="region-row" class="row no-gutters p-0">
            <div class="col-md-8 no-gutters p-4" style="position: relative;">
                <div>
                    <?php
                    $params = array(
                        'limit' => -1,
                        'orderby' => 'name ASC'
                    );

                    $regions = pods('region', $params);

                    $isEmpty = $regions->total() === 0; ?>



                    <div style="position: absolute; top:50px; right:20px; z-index:999;" class="dropdown d-none">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="regionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Region
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="regionsDropdown">
                            <?php while ($regions->fetch()) : ?>
                                <li><a class="dropdown-item" href="<?php echo $regions->display('permalink'); ?>"><?php echo $regions->display('name'); ?></a></li>
                            <?php endwhile; ?>
                            <?php // reset the regions query
                            $regions->reset(); ?>
                        </ul>
                    </div>

                </div>

                <!-- display the town map gif image -->
                <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/townmap_blue.gif" alt="Connecticut's Ecoregions" class="img-fluid" /> -->

                <div class="map d-none d-lg-block">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/map_svg/CT_Map_NoKey_Colored.svg" alt="Connecticut's Ecoregions" class="img-fluid" />
                </div>
            </div>

            <div class="col-md-4 p-4 region-wrap bg-blue-dark"">
            <div class=" filter-regions mb-4 dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="regionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Region
                </button>
                <ul class="dropdown-menu" aria-labelledby="regionsDropdown">
                    <?php while ($regions->fetch()) : ?>
                        <li><a class="dropdown-item" href="<?php echo $regions->display('permalink'); ?>"><?php echo $regions->display('name'); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class=" 
             clearfix
             region-info text-white
             bg-blue-light p-4 material-shadow
             mt-5
             ">

                <?php
                $params = array(
                    'limit' => -1,
                    'orderby' => 'name ASC'
                );
                $regions = pods('region', $params);
                $isEmpty = $regions->total() === 0;
                ?>

                <h2>Let's explore!</h2>
                <p>Select a region on the map or in the dropdown menu to learn more about it.</p>
                <p>Each region has a unique combination of geology, topography, soils, climate, and plant and animal communities. </p>
                <!-- show the regions nav -->

                <div class="regions-nav">

                    <?php while ($regions->fetch()) : global $region_colors; ?>
                        <a href="<?php echo $regions->display('permalink'); ?>" data-region="<?php echo $regions->display('slug'); ?>" class="btn 
                        btn-outline-light
                        btn-sm 
                        d-block 
                        text-dark
                        fw-bold

                        mb-2 <?php echo $region_colors[$regions->display('slug')]; ?>">



                            <?php echo $regions->display('name'); ?>
                        </a>
                    <?php endwhile; ?>
                </div>





            </div>
        </div>
    </div>
    </div>
</section>




<?php get_footer(); ?>