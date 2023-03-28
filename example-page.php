<?php
/**
 * Template Name: Example-page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ogrud_botamiczny
 */


get_header(); ?>
	<main id="primary" class="site-main">
    
    <?php show_archive_top(); ?>
    
    <div class="container">
      <?php
      if ( function_exists( 'yoast_breadcrumb' ) ) {
        yoast_breadcrumb( '<nav class="breadcrumbs-nav"><p id="breadcrumbs">','</p></nav>' );
      }
      $image = get_field('image');
      $content = get_field('content');
      echo '<section class="taxonomy">';
        
          echo '<div class="taxonomy__top">'; 
           echo '<h2>' . get_the_title() . '</h2>'; 
          echo '</div>'; 
         
          echo '<div class="taxonomy__bottom">'; 
            if ( $image ) {
              echo '<div class="taxonomy__bottom_img">' . 
                wp_get_attachment_image( $image, 'full' ) .
              '</div>'; 
            } 
  
            
            if ( $content  ) echo '<div class="taxonomy__bottom_content">' .
               $content . 
            '</div>'; 

          echo '</div>'; 

        echo '</section>';?>
    </div>

	</main><!-- #main -->

<?php
get_footer();
