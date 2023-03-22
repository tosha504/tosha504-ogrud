<?php 
/**
 * For whom
 *
 * @package  ogrud_botamiczny
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$cards = get_sub_field('cards');
?>
<!-- For-whom start -->
<section class="for-whom">
  <div class="container">
    <ul class="for-whom__cards">
      <?php
      foreach ($cards as $key => $item) {
        // var_dump($item['card']);
        $card = $item['card']; ?>
        <li>
          <a href="<?php echo esc_url($card['link']['url']); ?>"  class="for-whom__cards_card card">
              <?php if ($card['image']) echo '<div class="card__img">' . wp_get_attachment_image($card['image'], 'full') . '</div>';?>
            <div class="card__content" style=" background:<?php echo $card['color'] ?     $card['color'] : '#16823a';?>">
              <div class="card__content_top">
                <?php if($card["title"]){ ?><h4><?php echo $card["title"]; ?></h4><?php } ?>
              </div>
              <div class="card__content_bottom">
                <span class="link-arrow"><?php echo esc_html( $card['link']['title']); ?></span>
              </div>
          </div>
        </a>
      <?php } ?>
    </ul>
  </div>
</section><!-- For-whom end -->
