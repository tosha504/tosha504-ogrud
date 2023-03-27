<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ogrud_botamiczny
 */

$logos = get_field('logo', 'options');
$description = get_field('description', 'options');
$contact_title = get_field('contact_title', 'options');
$contacts = get_field('contact', 'options');
$greenhouse_title = get_field('greenhouse_title', 'options');
$greenhouse_descr = get_field('greenhouse_descr', 'options');
$magic_title = get_field('magic_title', 'options');
$magic_descr = get_field('magic_descr', 'options');
$menu_title = get_field('menu_title', 'options');
$menu_links = get_field('menu_links', 'options');
$block_title = get_field('block_title', 'options');
$block_links = get_field('block_links', 'options'); 
$title_schedules = get_field( 'title_schedules', 'options' );
$schedules = get_field( 'schedule', 'options' );
// MAP
$map = get_field( 'map', 'options' );
// NEWSLETTER
$bag_image = get_field('bag_image', 'options');
$settings_bg = get_field('settings_bg', 'options'); 
$backgound = wp_get_attachment_image_url( $bag_image, 'full');
echo ! is_front_page() ? newsletter_creating( $backgound, $settings_bg ) : '';
echo ! is_front_page() ? schedule_creating( $title_schedules, $schedules ) : ''; 
echo ! is_front_page() ? map_creating($map)  : '';?>

	<footer id="colophon" class="footer">
		<div class="container footer__container">
			<div class="footer__container_item item">
				<?php if($logos){ ?>
					<div class="item__logo">
						<?php foreach ($logos as $key => $logo) {
							$link_url = $logo['link']['url'];
							$link_target = $logo['link']['target'] ? $logo['link']['target'] : '_self'; ?>
							<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo wp_get_attachment_image($logo['icon']); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="item__content content">
						<div class="content__left">
							<div class="content__left_contact contact">
								<h6 class="contact__title footer__title"><?php echo $contact_title; ?></h6>	
								<ul class="cocntact__items">
									<?php 
									foreach ($contacts as $key => $contact) {
										$phone = $contact['phone']; 
										$phoneLink = preg_replace('/[^0-9]/', '', $phone);?>
										<li class="cocntact__items_phone">
											<a href="tel:<?php echo $phoneLink; ?>"><?php echo $phone; ?></a>
										</li>
									<?php } ?>
								</ul>
							</div>
							<div class="content__left_greenhouse greenhouse">
								<h6 class="greenhouse__title footer__title"><?php echo $greenhouse_title; ?></h6>	
								<p class="greenhouse__descr"><?php echo $greenhouse_descr; ?></p>
							</div>
							<div class="content__left_magic magic">
								<h6 class="magic__title footer__title"><?php echo $magic_title; ?></h6>	
								<p class="magic__descr"><?php echo $magic_descr; ?></p>
							</div>
						</div>
						<div class="content__right menu">
							<h6 class="menu__title footer__title"><?php echo $menu_title; ?></h6>	
							<ul class="menu__items">
								<?php 
									foreach ($menu_links as $key => $link) {
									$link_url = $link['link']['url'];
									$link_title = $link['link']['title'];
									$link_target = $link['link']['target'] ? $link['link']['target'] : '_self';?>
									<li>
										<a class="footer_link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
									</li>
								<?php } ?>
							</ul>
						</div>
				</div>
			</div>
			<div class="footer__container_item item">
				<div class="item__socials socials">
					<p class="socials__descr"><?php echo $description; ?></p>
					<ul class="socials__items">
					<?php 
					$soicals = get_field('socials', 'options');
					foreach ($soicals as $key => $social) { ?>
						<li>
							<a href="<?php echo  $social["link"]?>" target="_blank"><?php echo wp_get_attachment_image($social["icon"] , 'full')?></a>
						</li>
					<?php } ?>
				</ul>
				</div>							

			<div class="item__content content">
				<div class="content__left">
				<h6 class="content__menu_title footer__title"><?php echo $block_title; ?></h6>	
				<ul class="content__menu_items">
					<?php 
						foreach ($block_links as $key => $link_block) {
						$link_url = $link_block['link']['url'];
						$link_title = $link_block['link']['title'];
						$link_target = $link_block['link']['target'] ? $link_block['link']['target'] : '_self';?>
						<li>
							<a class="footer_link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						</li>
					<?php } ?>
				</ul>
				
				</div>
				<div class="content__right new">
					<div class="news">
						<h6>Zapisz się do newslettera,
							a nic Cię nie ominie</h6>
							<p>Pracujemy nad uruchomieniem newslettera. Potrzebujemy jednak jeszcze trochę czasu. Zajrzyj do nas niebawem!</p>
					</div>
				</div>
					
			</div>
			</div>
		<p class="privacy">
		Ogród Botaniczny UW © 2023 | wykonanie <a href="https://thenewlook.pl/" target="_blank" rel="noopener noreferrer">Thenewlook</a> 
		</p>
		</div>
		
	</footer><!-- #colophon -->
	
	<div class="cookies">
		<div class="cookies__flex">
			<p>Używamy plików cookie, aby poprawić komfort korzystania z naszej witryny. Przeglądając tę stronę, zgadzasz się na używanie przez nas plików cookie.</p>	
			<a href="javascript:;"  class="cookies__btn btn submit">Akceptuję</a>
		</div>
	</div><!-- cookies -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
