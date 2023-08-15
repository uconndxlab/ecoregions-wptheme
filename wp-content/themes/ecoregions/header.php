<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- get htmx via CDN -->
    <script src="https://unpkg.com/htmx.org/dist/htmx.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="site">

    <?php get_template_part( 'partials', 'skiplinks', array() ); ?>

    <header></header>