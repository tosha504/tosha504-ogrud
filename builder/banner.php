<?php
/**
 * Banner
 *
 * @package  ogrud_botamiczny
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


$background_image = get_sub_field('background_image');
$invite = get_sub_field('invite');
$title = $invite['title'];
$bg_img = $invite['bg_img'];
$link = $invite['link']; ?>
<!-- Banner Start -->
<section class="banner" <?php if( $background_image){ echo 'style="background: url(' . wp_get_attachment_image_url( $background_image, 'full') .'); background-repeat: no-repeat;  background-position: center; background-size: cover;"' ; } ?>>
  <div class="banner__invite" <?php if( $bg_img){ echo 'style="background: url(' . wp_get_attachment_image_url( $bg_img, 'full') .');background-repeat: no-repeat;   background-size: cover;"' ; }?>>
    <div class="banner__invite_wrap">
      <?php if ($title){ ?><h1 class="banner__invite_wrap-title"><?php echo $title; ?></h1><?php } ?>
      <?php
      if ( $link ) {
      $link_url = $link['url'];
      $link_title = $link['title'];
      $link_target = $link['target'] ? $link['target'] : '_self'; ?>
        <a class="link-arrow" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
      <?php } ?>
    </div>
  </div>
</section><!-- Banner End -->