
<?php 
/**
 * Newsletter
 *
 * @package  ogrud_botamiczny
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


$bag_image = get_field('bag_image', 'options');
$settings_bg = get_field('settings_bg', 'options'); 
$backgound = wp_get_attachment_image_url( $bag_image, 'full');
echo newsletter_creating(  $backgound, $settings_bg );

