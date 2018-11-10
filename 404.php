<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

$templates = array( '404.twig');

$context = Timber::get_context();
$context['options']         = get_fields('options');
$context['currentlanguage'] = pll_current_language();

$context['body_class']  = 'error-404 not-found';

// $args = array(
//     'post_type' => 'post',
//     'posts_per_page' => 5,
// );

// $context['recentposts'] = Timber::get_posts( $args );

Timber::render( $templates, $context );