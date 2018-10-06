<?php
/**
 * The Template for displaying all single events
 *
 */

$template               = 'single.twig';
$post                   = Timber::get_post();
$context                = Timber::get_context();
$context['post']        = $post;
$context['post']->blocks = $post->get_field('blocks');
$context['body_class']  = 'page-single';
$context['options'] = get_fields('options');

Timber::render('single-events.twig', $context);