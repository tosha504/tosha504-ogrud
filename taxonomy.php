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
    <?php show_archive_top(); ?>
    <div class="container">
      <?php 
      $curent_obj = get_queried_object();
      $current_term_ID = $curent_obj->term_id;
      $tax = $curent_obj->taxonomy;
      $terms = get_term( $current_term_ID , $tax );
      $image = get_field( 'image', $terms );
      $descr = get_field( 'descr', $terms );
      $sub_descr = get_field( 'sub_descr', $terms );
      $button = get_field( 'button', $terms );
      $email = get_field( 'email', $terms );
      $image_full = get_field( 'image_full', $terms );
      $term_childs = get_term_children( $current_term_ID , $tax );

      if ( $terms ) {

        echo '<section class="taxonomy">';
          if ( function_exists( 'yoast_breadcrumb' ) ) {
            yoast_breadcrumb( '<nav class="breadcrumbs-nav"><p id="breadcrumbs">','</p></nav>' );
          }
          echo '<div class="taxonomy__top">'; 
          if ( $terms->name ) echo '<h2>' . $terms->name . '</h2>'; 
            if ( $button ) {
              $link_url = $button['url'];
              $link_title = $button['title'];
              $link_target = $button['target'] ? $button['target'] : '_self';
              ?>
              <a class="btn__border" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
          <?php }
          echo '</div>'; 
          if( $image_full ) {
            echo '<div class="full">';
            echo wp_get_attachment_image( $image_full, 'full' ) ;
            echo  '</div>';
          }
          echo '<div class="taxonomy__bottom">'; 
            if ( $image && !$image_full ) {
              echo '<div class="taxonomy__bottom_img">' . 
                wp_get_attachment_image( $image, 'full' ) .
              '</div>'; 
            } 
            
            if($email) echo '<div class="taxonomy__bottom_email">
              <p>W razie pytań napisz do nas</p>
              <a href="mailto:' . $email . '" class="btn">' .
              $email .
              '</a>
            </div>';
            
            if ( $descr || $sub_descr ) echo '<div class="taxonomy__bottom_content">' .
              '<p class="big">' . $descr . '</p>' . 
              '<p>' . $sub_descr . '</p>' .
            '</div>'; 

          echo '</div>'; 

        echo '</section>';
      }

      if (!empty($term_childs) && get_post_type() == 'knoweledge_base') { 
        echo '<section class="knowledge">';
          foreach ( $term_childs as $child  ) {
          $term_child = get_term_by( 'id', $child, $tax );
          echo '<a class="knowledge__item" href="' . get_term_link( $term_child ) . '">
            <div class="knowledge__item_img" style="background: url(' . get_template_directory_uri() . '/assets/img/tlo-kafelki.svg">
            <p>' . esc_html( $term_child->name ) . '</p>
            </div>
            <div class="knowledge__item_arrow">
              <span class="link-arrow-green">' . __( 'Read more', 'garden' ) . '</span>
            </div>
          </a>';
          } 
        echo '</section>'; }
      else if( !empty($term_childs) && get_post_type() == 'course' ){
        ?>
        
        <section class="for-whom">
          <ul class="for-whom__cards">
            <?php
            foreach ($term_childs as $key => $child) {
              $term_child = get_term_by( 'id', $child, $tax );
              $term_image = get_field( 'image', $term_child);
              $term_image_full = get_field( 'image_full', $term_child );
              $term_background = get_field( 'background', $term_child ); 
              $current_image = $term_image_full ? $term_image_full : $term_image; ?>
              <li>
                <a href="<?php echo esc_url(get_term_link( $term_child )); ?>"  class="for-whom__cards_card card">
                    <?php if ( $term_image ) echo '<div class="card__img">' . wp_get_attachment_image( $term_image , 'medium-large') . '</div>';?>
                  <div class="card__content" <?php echo $term_background ? 'style=" background:' . $term_background .'"' : 'style=" background:#16823a"';?>>
                    <div class="card__content_top">
                      <?php if($term_child->name){ ?><h4><?php echo esc_html( $term_child->name ) ?></h4><?php } ?>
                    </div>
                    <div class="card__content_bottom">
                    <span class="link-arrow"><?php _e( 'Read more', 'garden' ); ?></span>
                    </div>
                </div>
              </a>
            <?php } ?>
          </ul>
        </section>
      <?php

      }
      else if( have_posts() ) { 
        echo '<div class="section-blog__cards">';
          while ( have_posts() ) {
            the_post();
            create_blog_card( get_the_ID(), get_the_title(), get_the_excerpt(), $terms->name );
          }
        echo '</div>';
      } ?>
    </div>        
	</main><!-- #main -->

<?php

get_footer();
