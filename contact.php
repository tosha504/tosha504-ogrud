<?php 
/**
 *Template Name: Contact 
 * @package ogrud_botamiczny
 */

get_header(); ?>

  <main id="primary" class="site-main">
    <?php show_archive_top(); ?>
    <div class="container">
      <?php 
      $title_form = get_field('title_form');
      $shortcode = get_field('shortcode');
      $naglowek_info = get_field('naglowek_info__');
      $info_pola = get_field('info_pola');      
        if ( function_exists( 'yoast_breadcrumb' ) ) {
          yoast_breadcrumb( '<nav class="breadcrumbs-nav"><p id="breadcrumbs">','</p></nav>' );
        }
      ?>
      <div class="contact-items">
        <div class="contact-items__left">
          <h1><?php echo $title_form; ?></h1>
          <div class="contact-items__left_wrap">
            <?php echo do_shortcode( $shortcode ); ?>
          </div>
        </div>
        <div class="contact-items__right">
          <h2><?php echo $naglowek_info; ?></h2>
          <div class="contact-items__right_wrap">
            <?php
              foreach ($info_pola as $info_pole) {
                echo $info_pole['info_field'];
              }
            ?>
          </div>
        </?div>

      </div>
    </div>
  </main><!-- #main -->

<?php get_footer();