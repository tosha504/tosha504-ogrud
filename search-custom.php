<?php
/**
 * Template Name: Search Page
 * @package ogrud_botamiczny
 */

get_header(); ?>

	<main id="primary" class="site-main">
		<?php show_archive_top(); ?>
		<div class="container">
			<?php 
			$tags = get_tags(array(
				'hide_empty' => false
			)); 

			$post_types = array(
				'posts_per_page' => -1,
				'post_type' => array( 'post', 'course', 'knoweledge_base' ),
				// 'tag' => '',
			);

			$query = new WP_Query( $post_types ); ?>
			<div id="customSearch" class="custom-search">
				<div id="datepicker" class="calendar">
					<img src="<?php echo get_template_directory_uri() . '/assets/img/ikona-kalendarz.svg' ?>">
					<label for="date">Choose a date:</label>
				</div>
				<ul class="custom-search__items">
					<li class="btn__border active" data-slug="<?php echo 'wszystkie'; ?>">Wszystkie</li>
						<?php foreach ($tags as $tag) { ;?>
							<li class="btn__border" data-slug="<?php echo $tag->slug; ?>"><?php echo $tag->name ; ?></li>
						<?php } ?>
				</ul>
			</div>
		<div class="box"><div class="loader"></div></div>	
		<section id="content" class="section-blog__cards">
			<?php 
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						
						$terms = wp_get_post_terms( $query->post->ID, array( 'categories', 'category-course' ) );
						$term_for_custom_page = $terms ?  $terms[0]->name : null;
						echo create_blog_card( get_the_ID(), get_the_title(), get_the_excerpt(), $term_for_custom_page ); ?>
						<?php
					}
				}
				else {
					_e('Oops. Nothing found!', 'garden');
				}
				wp_reset_postdata();
			?>
		</section>
		
	</div>

	</main><!-- #main -->

<?php
get_footer();
