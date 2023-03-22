<?php 
/**
 * Blog
 *
 * @package  ogrud_botamiczny
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$title = get_sub_field( 'title' );
$text = get_sub_field( 'text' );
$blog_posts = get_sub_field( 'blog_posts' );
$link = get_sub_field( 'see_all' ); ?>
<!-- Blog Start -->
<section class="section-blog">
  <div class="container">
    <?php echo ! empty($title) ? '<h5 class="section-blog__title">' . $title . '</h5>' : '';
    echo $text ? '<p class="section-blog__text">' . $text . '</p>' : '';
    if ( $blog_posts ) {
      echo '<div class="section-blog__cards">';
        foreach ( $blog_posts as $key => $blog_post ) {
          // var_dump($blog_post);
          create_blog_card( $blog_post->ID, $blog_post->post_title,  $blog_post->post_excerpt );
        } 
      echo '</div>';
    }
    if ( $link ) createButton( $link, 'btn-primary' );
  ?>
  </div>
</section><!-- Blog End -->