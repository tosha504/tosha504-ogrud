<?php
/**
 * Template Name: Donors
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ogrud_botamiczny
 */


get_header(); ?>
	<main id="primary" class="site-main">
    
    <?php show_archive_top(); ?>
    
    <div class="container">
      <?php
      if ( function_exists( 'yoast_breadcrumb' ) ) {
        yoast_breadcrumb( '<nav class="breadcrumbs-nav"><p id="breadcrumbs">','</p></nav>' );
      }
      $title = get_field('title');
      $subtitle = get_field('subtitle');
      $donors = get_field('Donors');
      if( $title ) { ?><h1><?php echo $title; ?></h1><?php } ?>
      <?php if( $subtitle ) { ?><h2><?php echo $subtitle; ?></h2><?php } ?>
      <?php if ( $donors) { ?> 
        <section class="donors">
          <?php foreach ($donors as $donor) { ?>
            <div class="donors__item">
              <div class="donors__item_left">
                <?php echo wp_get_attachment_image( $donor['icon'], 'full' ) ?>
                  
              </div>
              <div class="donors__item_right">
                <h6><?php echo $donor['title']; ?></h6>  
              <p>
                  <?php echo $donor['descr']; ?></p>
                  <a class="btn" href="<?php echo esc_url( $donor['link']["url"] ); ?>" target="<?php echo esc_attr( $donor['link']["target"] ); ?>"><?php echo esc_html( $donor['link']["title"] ); ?></a>
                </div>

                
            </div>
          <?php }?>
        </section>
      <?php } ?>
    </div>

	</main><!-- #main -->

<?php
get_footer();
