<?php
/**
 * Custom functions
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function builder_template() {
  if ( class_exists( 'ACF' ) && have_rows( 'builder' ) ) {
    if ( have_rows( 'builder' ) ) { while ( have_rows( 'builder' ) ) 
      { the_row();		
        if( get_row_layout() == 'banner'){
          get_template_part('builder/banner');
        }else if( get_row_layout() == 'schedule'){
          get_template_part('builder/schedule');
        }else if( get_row_layout() == 'for_whom'){
          get_template_part('builder/for-whom');
        }else if( get_row_layout() == 'thematic_events'){
          get_template_part('builder/events');
        }else if( get_row_layout() == 'section_newsletter'){
          get_template_part('builder/newsletter');
        }else if( get_row_layout() == 'blog'){
          get_template_part('builder/blog');
        }else if( get_row_layout() == 'garden_supports'){
          get_template_part('builder/supports');
        }else if( get_row_layout() == 'events_gardern'){
          get_template_part('builder/events_gardern');
        }
      }	
    }
  }
}

function createButton($link, $class_btn) {
  // var_dump($link, $class_btn);
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
    ?>
    <div class="btn-wrap">
      <a class="btn <?php echo $class_btn?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
    </div>
    
  <?php 
}

function schedule_creating($title_schedules, $schedules) {
  // var_dump($schedules);
	$html = '';
	$title_not_home = ! is_front_page() ? '<h3 class="schedule__title">' . $title_schedules . '</h3>' : '' ;
	$html .= '<!-- Schedule Start -->
 	<section class="schedule">
		<div class="schedule__container container">' . 
		$title_not_home .	
			'<div class="schedule__items">';
				foreach ($schedules as $key => $schedule) { 
					$title = $schedule["title"] ? '<h3>' . $schedule["title"] . '</h3>' : '' ;
					$descr = $schedule['descr'] ? '<p>' . $schedule['descr'] . '</p>' : '' ;
					$html .= '<div class="schedule__items_item">' .
            $title . 
            $descr .
					'</div>'; 
				} 
				$html .=  '
			</div>
		</div>
	</section><!-- Schedule End-->';

	return $html;
}

function map_creating($map) {
  $html = '';
  $html .= '<!-- Schedule Start -->
  <section class="map">' .
  $map .
  '</section><!-- Schedule End-->';
  return $html;
}

function newsletter_creating($bag_image, $settings_bg) {
  $backgound = $bag_image ? 'style="background: url(' . $bag_image . '); background-repeat: no-repeat;  background-position: left; background-size: cover;"' : '' ;
  $color =$settings_bg == true ? 'style="background: linear-gradient(180deg, #fff 50%, #FAF8F5 50%);"' : '';

  return '<!-- Newsletter Start -->
  <section class="newsletter" '.$color.'>
    <div class="container">
      <div class="newsletter__body" ' . $backgound . '>
        <h3>Zapisz się do newslettera,<br> a nic Cię nie ominie</h3>
        
        <div class="newsletter__body_box">
          
          <p>Pracujemy nad uruchomieniem newslettera. Potrzebujemy jednak jeszcze trochę czasu. Zajrzyj do nas niebawem!</p>
        </div>  
      </div>
    </div>
  </section><!-- Newsletter End -->';
}

function create_blog_card( $blog_post_ID, $blog_post_title, $blog_post_excerpt, $term_cat = null) {
  
  $image =  get_the_post_thumbnail($blog_post_ID) ?  get_the_post_thumbnail($blog_post_ID, 'full') : '<img src="' .  get_template_directory_uri() . '/assets/img/tlo-green-ogrod-botaniczny-uw.svg">';
  $trimWordsTitle = 5;
  $titleCount = wp_trim_words( $blog_post_title, $trimWordsTitle, ' ...' );
  $trimWordsExcerpt = 15;
  $excerptCount = $blog_post_excerpt ? wp_trim_words( $blog_post_excerpt, $trimWordsExcerpt, ' ...' ) : null;
  $categories = get_the_category( $blog_post_ID );
  $current_cat = isset( $categories[0] ) ? $categories[0]->name : '';
  $cat = $term_cat !== null ? $term_cat : $current_cat;

  echo '<article class="section-blog__cards_card card"><a href="' . esc_url( get_permalink( $blog_post_ID ) ) . '">' .
    '<div class="card__image">' . $image . '</div>';
    echo '<div class="card__body">';
      echo '<div class="card__body_info">' .
        '<p class="category">' . $cat . '</p>' .
        '<p>' . get_the_date( 'j F' , $blog_post_ID ) . '</p>' .
      '</div>';
      echo '<h6 class="card__body_title">' . $titleCount . '</h6>';
      echo $excerptCount ? '<p class="card__body_excerpt">' . $excerptCount . '</p>' : '';
      echo '<span class="link-arrow-green">' . __( 'Read more', 'garden' ) . '</span>';
    echo '</div>';
  echo '</a></article>';

}

function single_page_render( $duration = null, $limit = null, $available = null, $cost = null, $age = null, $email = null, $contact_form = null ) {
  $sub_title = get_field( 'sub_title', get_the_ID() );
  $recipe = get_field( 'Recipe', get_the_ID() );
  $preparation = get_field( 'preparation', get_the_ID() );
  $number_servings = get_field( 'number_servings', get_the_ID() );
  $button = get_field( 'button', get_the_ID() );
  $download = get_field( 'download', get_the_ID() );
  
  echo '<div class="title">
  <div class="container">';
    if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb( '<nav class="breadcrumbs-nav"><p id="breadcrumbs">','</p></nav>' );
    }
    echo '<div class="title__wrap">';
      echo '<div class="title__wrap_titles">';
        the_title( '<h1 class="entry-title">', '</h1>' );
        ?>
          <ul class="fields">
            <?php if( $duration ) { ?>
            <li>
              <p><?php _e( 'Digestion time:', 'garden' ) ?></p>
              <p class="fields__border"><?php echo $duration;?></li><?php } ?></p>
            </li>
            <?php if( $limit ) { ?>
            <li>
                <p><?php _e( 'Seat limit:', 'garden' ) ?></p>
                <p class="fields__border"><?php echo $limit;?></li><?php } ?></p>
            </li>
            <?php if( $available ) { ?>
            <li>
                <p><?php _e( 'Activities available:', 'garden' ) ?></p>
                <p class="fields__border"><?php echo $available;?></li><?php } ?></p>
            </li>
            <?php if( $cost ) { ?>
            <li>
                <p><?php _e( 'Cost:', 'garden' ) ?></p>
                <p class="fields__border"><?php echo $cost;?></li><?php } ?></p>
            </li>
            <?php if( $age ) { ?>
            <li>
                <p><?php _e( 'Age:', 'garden' ) ?></p>
                <p class="fields__border"><?php echo $age;?></li><?php } ?></p>
            </li>
          </ul>
        <?php 
        if ( $sub_title ) echo '<p class="sub-title">' . $sub_title. '</p>'; 
      echo '</div>';
      if ( $number_servings ) echo '<p class="number">' . $number_servings. '</p>'; 
      if ( $button ) {
        $link_url = $button['url'];
        $link_title = $button['title'];
        $link_target = $button['target'] ? $button['target'] : '_self';
        ?>
        <a class="btn__border" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
      <?php }
    echo '</div>';
  echo '</div></div>';
  
  echo '<div class="content"><div class="container">';
    echo wp_get_attachment_image( get_post_thumbnail_id(), 'full' );
    if( $recipe || $download || $email )echo '<div class="content__wrap">';
      if($email) echo '<div class="taxonomy__bottom_email">
        <p>W razie pytań napisz do nas</p>
        <a href="mailto:' . $email . '" class="btn">' .
        $email .
        '</a>
      </div>';
      if ( $recipe ) echo '<div class="content__recipe">
        <span class="recipe-title">' . __( 'Recipe:', 'garden' ) . '</span>' .  $recipe ;
      if ( $download ) {
        echo '<div class="content__download"><span class="recipe-title">' . __( 'Download:', 'garden' ) . '</span>';
        foreach ($download as $link_download) {
        $link_url = $link_download['button']['url'];
        $link_title = $link_download['button']['title'];
        $link_target = $link_download['button']['target'] ? $link_download['button']['target'] : '_self';
        ?>
        <a class="btn__border" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php 
        }
      }
      if( $recipe || $download ) echo '</div>';
     
      echo '<div class="content__text">';
        the_content();
        if ( $preparation ) echo '<div class="content__text_preparation"><span class="recipe-title">' . __( 'Preparation:', 'garden' ) . '</span><p>' . $preparation . '</p></div>';
      echo '</div>';
    echo '</div>';
  echo '</div></div>';
  if( $contact_form ) { ?>
    <div class="container">
      <h3 class="title-form"><?php _e( 'Booking', 'garden' ) ?></h3>
      <?php  echo do_shortcode( $contact_form ); ?>
    </div>
  <?php }  
}
