<?php
/**
 * The template for displaying home(archive)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ogrud_botamiczny
 */

get_header(); ?>
	<main id="primary" class="site-main">
    
    <?php show_archive_top(); ?>
    
    <div class="container">
      <div class="section-blog__cards blog">
      <?php 
      
      if ( have_posts() ) : ?>	
        
      <?php		
        /* Start the Loop */
        while ( have_posts() ) :
        the_post();
        /*
        * Include the Post-Type-specific template for the content.
        * If you want to override this in a child theme, then include a file
        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
        */
      
          create_blog_card( get_the_ID(), get_the_title(), get_the_excerpt() );
            
          endwhile;
          
          the_posts_navigation();
          
          else :
            
            get_template_part( 'template-parts/content', 'none' );
            
          endif;
      ?>
    </div>
    </div>
	</main><!-- #main -->

<?php
get_footer();
