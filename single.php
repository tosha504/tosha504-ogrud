<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ogrud_botamiczny
 */

get_header();
?>

	<main id="primary" class="site-main">
			<?php
			show_archive_top();
			while ( have_posts() ) :
				the_post();
				// echo get_the_title($post->post_parent);
				if(has_term('downloads', 'categories', get_the_ID())) {
					single_page_render();
				} else if( has_term('cykle_edukacyjne', 'categories', get_the_ID() )){
					single_page_render();
				}else if( has_term('', 'category-course', get_the_ID() )){
					$duration = get_field( 'duration', get_the_ID());
					$limit = get_field( 'limit', get_the_ID());
					$cost = get_field( 'Cost', get_the_ID());
					$age = get_field( 'age', get_the_ID());
					$available = get_field( 'available', get_the_ID());
					$email = get_field( 'mail', get_the_ID());
					$contact_form = get_field( 'contact_form', get_the_ID());
          single_page_render( $duration , $limit , $available , $cost, $age, $email, $contact_form );
				}else {
					single_page_render();
				}
			
				// the_post_navigation(
				// 	array(
				// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'garden' ) . '</span> <span class="nav-title">%title</span>',
				// 		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'garden' ) . '</span> <span class="nav-title">%title</span>',
				// 	)
				// );

			endwhile; // End of the loop.
			?>

	</main><!-- #main -->

<?php
get_footer();
