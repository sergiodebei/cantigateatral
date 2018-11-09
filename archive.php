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
$context['post']->blocks = pll_current_language() == 'nl' ? get_field('blocks', 356) : get_field('blocks', 401);
//live is 713/715
// $context['post']->blocks = pll_current_language() == 'nl' ? get_field('blocks', 713) : get_field('blocks', 715);

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
 