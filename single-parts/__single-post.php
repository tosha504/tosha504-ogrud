<?php 
/**
 * Template part for single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ogrud_botamiczny
 */

echo '<div class="title">
<div class="container">';
echo 'sdfsdf';
  if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<nav class="breadcrumbs-nav"><p id="breadcrumbs">','</p></nav>' );
  }
  the_title( '<h1 class="entry-title">', '</h1>' );
echo '</div></div>';

echo '<div class="content"><div class="container">';
  echo wp_get_attachment_image(get_post_thumbnail_id(), 'full');
  the_content();
echo '</div></div>';