<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ogrud_botamiczny
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="wrapper">
	<header id="masthead" class="header">
		<div class="header__top">
			<div class="header__top_container container">
				<p>Aleje Ujazdowskie 4 | 00-478 Warszawa </p>
				<ul class="header__top_socials">
					<?php 
					$soicals = get_field( 'socials', 'options' );
					foreach ( $soicals as $key => $social ) { ?>
						<li>
							<a href="<?php echo $social["link"]?>" target="_blank"><?php echo wp_get_attachment_image( $social["icon"] , 'full' )?></a>
						</li>
					<?php } ?>
				</ul>
				<div class="lang">
					PL/EN
				</div>
			</div>
		</div>
		<div class="header__bottom">
			<div class="header__bottom_container container">
				<?php		
					$header = get_field( 'header', 'options' );
					$logo = $header['logo_header'];
					$logo_svg =$header["logo_svg"];
					if( $logo ) { ?>  
						<div class="header__logo">
							<a href="<?php echo esc_url( home_url( '/' ) ) ?>">
								<?php echo $logo_svg; 
								echo wp_get_attachment_image( $logo , 'full' ) ;?>
							</a>  
						</div>
				<?php } ?> 

				<nav id="site-navigation" class="header__nav">
					<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container' 			=> false,
								'menu_class'      => 'header__nav_menu',
								'fallback_cb'     => '',
								'menu_id'         => 'main-menu',
								'depth'           => 0,
							)
						);
					?>
				</nav><!-- #site-navigation -->
				
				<div class="shop">
					<a class="shopbagHeader" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'garden'); ?>">

						<?php echo file_get_contents( (get_template_directory_uri() . '/assets/img/koszyk-sushi-hero.svg') ); ?>
					
				</a>
				<div class="shop__counter">
					<?php 	global $woocommerce; 
					echo sprintf($woocommerce->cart->cart_contents_count);?>
				</div>
				</div>
				
				<div class="header__mobile">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-header',
								'container'			 => false,
								'menu_class'     => 'header__menu_mob',
							)
						);
					?>
				</div>

				<ul class="header__wcag">
					<li class="header__wcag_minus">
						<a href="#">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="18.8px" height="17.9px" viewBox="0 0 18.8 17.9" style="enable-background:new 0 0 18.8 17.9;" xml:space="preserve">
								<style type="text/css">
									.st0{fill:#231F20;}
								</style>
								<g>
									<path class="st0" d="M0.3,9.4h5.1v1.7H0.3V9.4z"/>
									<path class="st0" d="M16,12.3H9.2l-1.2,2.9H6.4l5.1-12.4h2.1l5.1,12.4h-1.4L16,12.3z M15.2,10.5l-2.4-5.6h-0.5l-2.4,5.6H15.2z"/>
								</g>
							</svg>
						</a>
					</li>
					<li class="header__wcag_plus">
						<a href="#">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="21px" height="17.9px" viewBox="0 0 21 17.9" style="enable-background:new 0 0 21 17.9;" xml:space="preserve">
								<style type="text/css">
									.st0{fill:#231F20;}
								</style>
								<g>
									<path class="st0" d="M7.6,10.6H4.4v2.9H3.3v-2.9H0.2V9h3.1V6.2h1.1V9h3.1V10.6z"/>
									<path class="st0" d="M18.1,12.2h-6.8l-1.2,2.9H8.5l5.1-12.4h2.1l5.1,12.4h-1.4L18.1,12.2z M17.4,10.4L15,4.8h-0.5l-2.4,5.6H17.4z"
										/>
								</g>
							</svg>
						</a>
					</li>
					<li class="header__wcag_contrast">
						<a href="#">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="17.9px" height="17.9px" viewBox="0 0 17.9 17.9" style="enable-background:new 0 0 17.9 17.9;" xml:space="preserve">
								<style type="text/css">
									.st0{fill:#2D2D2D;}
								</style>
								<path class="st0" d="M8.9,0.1c-4.9,0-8.8,4-8.8,8.8s4,8.8,8.8,8.8s8.8-4,8.8-8.8S13.8,0.1,8.9,0.1z M1.1,8.9c0-4.3,3.5-7.8,7.8-7.8
								c0,0,0,0,0,0v15.7c0,0,0,0,0,0C4.6,16.8,1.1,13.2,1.1,8.9z"/>
							</svg>
						</a>
					</li>
				</ul>

				<div class="header__burger"><span></span></div>
			</div>
		</div>
	</header><!-- #masthead -->
