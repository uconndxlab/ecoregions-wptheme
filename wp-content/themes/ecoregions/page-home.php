<?php
/*
Template Name: Home Page
*/
get_header();
?>

<!-- Hero Section -->
<section class="hero bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="my-3 text-white"> Connecticut's Ecoregions </h1>
                <p class="text-white my-3">From one corner to another …… observant passengers traveling in a vehicle following a diagonal route from the town of Stonington, along the southeastern coast of the state, to the town of Salisbury, in the northwestern corner, would notice a myriad of changes as they traverse the landscape. From standing on the shore and gazing out over Long Island Sound, our travelers would leave the ocean-scented air of the coast, and rise in elevation from less than 100 feet to over 1,500 feet. They would drive through rural, suburban and urban communities. And, although they would travel through many acres of forest, the presence of numerous stone walls would serve as a reminder of a not-so-distant past when trees did not dominant the land.</p>

            </div>
            <div class="col-md-6">
                <div class="video-wrap">
                    <iframe width="500" height="281" src="https://www.youtube.com/embed/wllTzw7O-z0" title="CSMNH - Introduction to the Ecoregions of Connecticut" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Intro Section -->
<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>What are Ecoregions?</h2>
                <p class="lead">Ecoregions are areas of the Earth's surface that contain similar ecosystems and ecological communities. They are defined by geology, climate, and other physical characteristics, as well as by the plants and animals that inhabit them.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>Why are Ecoregions important?</h3>
                <p>Ecoregions are important because they help us understand the natural world and the relationships between different species and ecosystems. They also help us identify areas that are particularly vulnerable to environmental change and degradation, and can guide conservation efforts.</p>
            </div>
            <div class="col-md-6">
                <h3>How are Ecoregions classified?</h3>
                <p>Ecoregions are classified based on a variety of factors, including climate, geology, and vegetation. The World Wildlife Fund has developed a system of ecoregions that is widely used by scientists and conservationists.</p>
            </div>
        </div>
    </div>
</section>

<!-- Regions Section -->
<section class="regions">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>All Regions</h2>
                <?php
                    get_template_part('partials/components/c-regions');
                    ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>