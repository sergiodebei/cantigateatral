<?php
/**
* The template for displaying Archive pages.
*
*/

if ( ! class_exists( 'Timber' ) ) {
 echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
 return;
}


$templates = array( 'archive.twig' );
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
// $pageID = get_the_ID();
// 356
// $context['blocks'] = get_field('blocks', 356);
//TODO the id show be dynamic
$context['post']->blocks = get_field('blocks', 356);
//live is 680
// $context['post']->blocks = get_field('blocks', 680);

// $context['body_class']  = 'archive-'.$post->post_name;

$context['events']    = Timber::get_posts( 
    [ 
      'post_type'   => 'events', 
      'orderby'     => 'menu_order',
      'order'       => 'ASC',
      'numberposts' => '-1'
    ]
  );

Timber::render( $templates, $context );
 