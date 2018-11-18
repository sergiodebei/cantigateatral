<?php
/**
 * The Template for displaying pages
 *
 */

if ( ! class_exists( 'Timber' ) ) {
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}

// $template = is_page('reacties') || is_page('depoimentos') ? 'reactions.twig' : 'single.twig';
$template = 'page.twig';
$post                   = Timber::get_post();
$context                = Timber::get_context();
$context['post']        = $post;
$context['post']->blocks = $post->get_field('blocks');

$context['body_class']  = 'page-'.$post->post_name;

$context['options']     = get_fields('options');
$context['currentlanguage'] = pll_current_language();

$context['events']    = Timber::get_posts( 
	[ 
	  'post_type'   => 'events',
	  'numberposts' => '3',
	  'meta_key' => 'event_date',
	  'orderby' => 'meta_value_num',
	  'order' => 'ASC',
	  'meta_query' => array(
		array(
		  'key' => 'event_date',
		  'value' => date('Ymd'),
		  'type' => 'NUMERIC',
		  'compare' => '>=',
		)
	  )
	]
);

Timber::render($template, $context);