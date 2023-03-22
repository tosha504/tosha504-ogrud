<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ogrud_botamiczny
 */

get_header();
?>
	<main id="primary" class="site-main">

		<?php 
		show_archive_top();
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
				// if(  get_post_type() === 'post') {
				// 	echo '<div class="section-blog__cards">';
				// 		get_template_part( 'template-parts/content-post', get_post_type() );
				// 	echo '</div>';
				// }
				// if(  get_post_type() === 'custom_events') {
				// 	get_template_part( 'template-parts/content', get_post_type() );
				// }
				// else if(  get_post_type() === 'knoweledge_base') {
					
				// 	echo '<div class="container">		sdfsdfsd';
				// 		// get_template_part( 'template-parts/taxonomy-knoweledge_base', get_post_type() );
				// 	echo '</div>';
				// }
				endwhile;
				
				the_posts_navigation();
				
				else :
					
					// get_template_part( 'template-parts/content', 'none' );
					
		endif;
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
