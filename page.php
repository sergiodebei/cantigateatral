<?php
/**
 * The Template for displaying pages
 *
 */

if ( ! class_exists( 'Timber' ) ) {
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}

// $template               = is_page('about') || is_page('contact') ? $post->post_name.'.twig' : 'single.twig';
$template = 'page.twig';
$post                   = Timber::get_post();
$context                = Timber::get_context();
$context['post']        = $post;
$context['post']->blocks = $post->get_field('blocks');

$context['body_class']  = 'page-'.$post->post_name;

// WP_Query arguments
$posts_args = array (
	'post_type'   => 'events',
	'numberposts' => '-1',
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
);
$events = Timber::get_posts($posts_args);

// print_r($events);

Timber::render($template, $context);