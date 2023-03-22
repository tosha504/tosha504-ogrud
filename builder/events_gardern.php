<?php 
/**
 * Events gardern
 *
 * @package  ogrud_botamiczny
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$title = get_sub_field( 'title' );
$descr = get_sub_field( 'descr' );
$button = get_sub_field( 'button' );
$events = get_sub_field( 'events' );
$bg_image = get_sub_field( 'bg_image' ); 

?>
<!-- Events Gardern Start -->
<section class="events-garden">
  <div class="events-garden__top" <?php if( $bg_image ) { echo 'style="background: url(' . wp_get_attachment_image_url( $bg_image, 'full' ) .'); background-repeat: no-repeat;  background-position: center; background-size: cover;"' ; } ?>>
    <div class="container">
      <?php
        if ( $title )
          echo '<h4 class="events-garden__top_title">' . $title . '</h4>';
        if ( $descr )
          echo '<p class="events-garden__top_descr">' . $descr . '</p>';
        if ( $button ) createButton( $button, 'btn-primary' );
      ?>
    </div>
  </div>
  <div class="events-garden__bottom">
    <div class="container">
      <?php 
        if ( $events ) {
          echo '<ul class="events-garden__bottom_items items">';
          foreach ( $events as $key => $event ) {
            $date =$event['event']['event_date'];
            $new_day = date( "d", $date );
            $new_year = date( "Y", $date );
            $new_month = date( "F", $date );
          
            $trimWordsTitle = 7;
            $titleCount = wp_trim_words( $event['event']['title'], $trimWordsTitle );
            $trimWordsDescr = 15;
            $descrCount = wp_trim_words( $event['event']['descr'], $trimWordsDescr );
            echo '<li>' .
              '<div class="year-date"><p>' . __( $new_month ) . '</p><p>' .$new_year . '</p></div>' .
              '<p class="day">' . $new_day  . '</p>' . 
              '<h5>' . $titleCount . '</h5>' .
              '<p class="time">' . $event['event']['time'] . '</p>' . 
              '<p class="descr">' . $descrCount . '</p>' .
            '</li>';
          } 
          echo '</ul>';
        } 
      ?>
    </div>
  </div>
</section>
<!-- Events Gardern End -->

