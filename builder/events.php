<?php 
/**
 * Events
 *
 * @package  ogrud_botamiczny
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$image = get_sub_field('image');
$pre_title = get_sub_field('pre_title');
$title = get_sub_field('title');
$posts_this_category = get_sub_field('posts_this_category'); ?>
<!-- Events Start -->
<section class="events">
  <div class="events__left">
    <?php echo wp_get_attachment_image($image, 'full'); ?>
  </div>
  <div class="events__right">
    <?php
    if($pre_title) echo '<p class="events__right_pre">' . $pre_title .'</p>';
    if($title) echo '<h2>' . $title .'</h2>';
    echo '<div class="events__right_wrap wrap">';
      foreach ($posts_this_category as $key => $post_cat) {
        echo '<div class="wrap__item">';
          $categories = get_the_category($post_cat->ID);
          $current_cat = isset($categories[0]) ? $categories[0]->name : '';
          echo '<a href="' . esc_url(get_permalink($post_cat->ID)) . '">';
            echo '<div class="wrap__item_info">' .
              '<p class="category">' . $current_cat . '</p>' .
              '<p>' .   get_the_date( 'j F' , $post_cat->ID ) . '</p>' .
            '</div>';
            echo '<h3>' . $post_cat->post_title . '</h3>';
            echo '<p>' . $post_cat->post_excerpt . '</p>';
            echo '<span class="link-arrow-green">' . __('Read more', 'ogrud_botamiczny' ) . '</span>';
          echo '</a>';
        echo '</div>';
      }
    echo '</div>';
    ?>
  </div>
</section> <!-- Events End -->