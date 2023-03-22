<?php
/**
 * Theme enqueue scripts and styles.
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
if( ! function_exists('garden_scripts')){
    function garden_scripts() {
        $theme_uri = get_template_directory_uri();
        // Custom JS
        
      
        wp_enqueue_script('garden_functions_calendar', $theme_uri . '/dist/simplepicker.js', [], time(), true);
        wp_enqueue_script('garden_functions', $theme_uri . '/src/index.js', ['jquery', 'garden_functions_calendar'], time(), true);

        wp_localize_script('garden_functions', 'localizedObject', [
          'ajaxurl' => admin_url('admin-ajax.php'),
          'nonce'   => wp_create_nonce('ajax_nonce'),
        ]);

        // Custom css
        wp_enqueue_style('garden_style', $theme_uri . '/src/index.css', [], time());
        wp_enqueue_style('garden_style_calendar', $theme_uri . '/dist/simplepicker.css', [], time());
      

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
          wp_enqueue_script( 'comment-reply' );
        }

    }
}
add_action( 'wp_enqueue_scripts', 'garden_scripts', );

add_action( 'wp_ajax_get_post_tag', 'get_post_tag' );
add_action( 'wp_ajax_nopriv_get_post_tag', 'get_post_tag' );

function get_post_tag() {
 
  if(isset( $_POST['tag']) && !empty( $_POST['tag'])) {
    $tag = sanitize_text_field( $_POST['tag']);   
    
    $post_type = array(
      // 'posts_per_page' => -1,
      'post_type' => array( 'post', 'course', 'knoweledge_base' ),
    );

    if( $tag !== 'wszystkie') {
      $post_type['tag'] =  $tag;
    }

    if(isset( $_POST['date'] ) && !empty( $_POST['date'] ) ) {
      $date = sanitize_text_field( $_POST['date'] );
      $post_type['date_query'] = array(
        array(
          'year' => date( 'Y', strtotime($date) ),
          'month' => date( 'm', strtotime($date) ),
          'day' => date( 'd', strtotime($date) ),
        )
      );
    }
  
    $query = new WP_Query( $post_type );
    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
        $terms = wp_get_post_terms( get_the_ID(), array( 'categories', 'category-course' ) );
        $term_for_custom_page = $terms ?  $terms[0]->name : null;
        // var_dump($term_for_custom_page);
        if(!empty(get_the_ID()) && !empty(get_the_title()) && !empty(get_the_content()) && !empty( $term_for_custom_page) ) {
          echo create_blog_card( get_the_ID(), get_the_title(), get_the_content(), $term_for_custom_page );
        } 
      }
    } else {
      _e('Oops. Nothing found!', 'ogrud_botamiczny');
    }
    wp_reset_postdata();
  
  }
	
  die();
}