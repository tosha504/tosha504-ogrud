
      echo '<section class="knowledge">';
        foreach ( $term_childs as $child ) {
        $term_child = get_term_by( 'id', $child, $tax );
        $term_image = get_field( 'image', $term_child );
        $term_image_render =  $term_image  ? 'style="background: url(' . get_the_post_thumbnail($term_image, 'medium') . '/assets/img/tlo-kafelki.svg"' : 'style="background: url(' . get_template_directory_uri() . '/assets/img/tlo-kafelki.svg"';
        // var_dump($term_image);
        echo '<a class="knowledge__item" href="' . get_term_link( $term_child ) . '">
          <div class="knowledge__item_img" ' . $term_image_render . ' >
          <p>' . esc_html( $term_child->name ) . '</p>
          </div>
          <div class="knowledge__item_arrow">
            <span class="link-arrow-green">' . __( 'Read more', 'ogrud_botamiczny' ) . '</span>
          </div>
        </a>';
        } 
        echo '</section>';


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
			);

			$query = new WP_Query( $post_types ); ?>
			<div class="custom-search">
				<label for="date">Choose a date:</label>
				<input type="date" id="datepicker" name="datepicker">
				<ul class="custom-search__items">
					<li class="btn__border active" data-slug="<?php echo 'wszystkie'; ?>">Wszystkie</li>
						<?php foreach ($tags as $tag) { ;?>
							<li class="btn__border" data-slug="<?php echo $tag->slug; ?>"><?php echo $tag->name ; ?></li>
						<?php } ?>
				</ul>
			</div>
		<section class="section-blog__cards">
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
				echo 'No matches';
			}

			// Возвращаем оригинальные данные поста. Сбрасываем $post.
			wp_reset_postdata();
			?>
		</section>
		
	</div>

	</main><!-- #main -->