<?php
/**
 * The Template for displaying pages
 *
 */

if ( ! class_exists( 'Timber' ) ) {
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}

$template               = 'home.twig';
$post                   = Timber::get_post();
$context                = Timber::get_context();
$context['post']        = $post;
$context['post']->blocks = $post->get_field('blocks');

$context['body_class']  = 'page-home';

$context['events']    = Timber::get_posts( 
  [ 
    'post_type'   => 'events', 
    'orderby'     => 'menu_order',
    'order'       => 'ASC',
    'numberposts' => '-1'
  ]
);

Timber::render([$template], $context);