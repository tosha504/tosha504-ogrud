<?php
/**
 * Mega menu
 *
 * @package ogrud_botamiczny
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// display shortcode
add_filter('walker_nav_menu_start_el', function($item_output, $item) {

    if (!is_object($item) || !isset($item->object)) {
        return $item_output;
    }

	$shortcode = get_field('shortcode_menu', $item->ID);
    if ($shortcode) {
        $item_output = $item_output . do_shortcode( $shortcode );
    }

    return $item_output;
}, 20, 2);

//add class to item menu
function my_wp_nav_menu_objects( $items, $args ) {
	
	foreach( $items as &$item ) {
		$shortcode = get_field('shortcode_menu', $item) ;
		if ($shortcode) {
			$item -> classes[] = 'is-megamenu';
		}
	}	
	return $items;
}
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

//post type mega menu
function megamenu_post_type() {
	$labels = array(
		'name'                => __('Mega menu', 'garden'),
		'singular_name'       => __('Mega menu', 'garden'),
		'menu_name'           => __('Mega menu', 'garden'),
	);
	$args = array(           
		'labels'              => $labels,
		'public'              => false,
		'show_ui'             => true,
		'menu_icon'           => 'dashicons-editor-ol',
	);
	register_post_type( 'megamenu', $args );
}
add_action('init', 'megamenu_post_type');

//add column with shorcode
function add_mege_menu_columns($columns){
	$column_meta = array( 'mega_menu' => 'shortcode' );
	$columns = array_slice( $columns, 0, 6, true ) + $column_meta + array_slice( $columns, 6, NULL, true );
	return $columns;
}

function mega_menu_columns($column) {
	global $post;
	switch ( $column ) {
		case 'mega_menu':
			$hits = '[mega_menu id="';
						$hits .= $post->ID;
						$hits .= '"]';
			echo $hits;
		break;
	}
}

add_filter( 'manage_megamenu_posts_columns',  'add_mege_menu_columns' );
add_action( 'manage_posts_custom_column' , 'mega_menu_columns' );

//mega-menu construct
function mega_menu( $atts, $content = null ){
	$atts = shortcode_atts(
                array(
                    'id'  => '',
                ), $atts
            );
    if($atts['id']){

        $html = mega_menu_display($atts['id']);       
    }        

	return $html;
}
add_shortcode('mega_menu', 'mega_menu' );

//mega-menu-shortcode
function mega_menu_display($id){
    ob_start();
    ?>
    <div class="header__mega mega">
        <div class="container mega__container">
                <?php
                    if(have_rows('menu_mm', $id)){
                        ?> 
                            <div class="mega__container_items items">
                                <?php  
                                    while ( have_rows('menu_mm', $id) ){  the_row();
                                        repeat_megamenu();
                                    } 
                                ?>
                            </div>
                        <?php
                    }
                    mega_menu_adds($id);
                ?>
        </div>
    </div>
    <?php

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function mega_menu_adds($id){
    $adds = get_field('adds_mm', $id);
    if($adds && get_field('display_addds', $id) == true){
        $title = $adds['title_ads_mm'];
        $description = $adds['description_ads_mm'];
        $related_posts = $adds['related_posts_ads_mm'];
        $link = $adds['button_ads_mm'];
        ?>
        <div class="mega__container_end end">
            <div class="end__header">
                <?php 
                    if($title) echo '<span class="end__header_title">' . $title . '</span>';
                    if($description) echo '<p class="end__header_description">' . $description . '</p>';
                ?>
            </div>
            <div class="end__content">
                <?php
                    if($related_posts){
                        echo '<ul class="end__content_list">';
                            foreach($related_posts as $post){
                                ?>
                                    <li class="end__content_list-items">
                                        <a class="end__content_list-item" href="<?php echo get_permalink($post) ?>" title="<?php echo get_the_title($post) ?>">
                                            <?php echo get_the_post_thumbnail($post, 'thumbnail');  ?>
                                        </a>
                                        <div class="end__content_list-item">
                                            <a href="<?php echo get_permalink($post) ?>" title="<?php echo get_the_title($post) ?>">
                                                <span> <?php echo get_the_title($post) ?> </span>
                                            </a>
                                        </div>
                                    </li>
                                <?php
                            }
                        echo '</ul>';
                    }
                ?>
            </div>
            <?php 
                if($link){
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                        <div class="megaMenu__adds--footer">
                            <a class="btn btn__primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php echo esc_html( $link_title ); ?>
                            </a>
                        </div>
                    <?php
                }
            ?>
        </div>  
        <?php
    }
}

function repeat_megamenu(){
    $icon = get_sub_field('icon_mm');
    $primary_link = get_sub_field('primary_link_mm');
    $description = get_sub_field('description');
    ?> 
        <div class="items__sub-item sub-item">
            <div class="sub-item__item">
                <div class="sub-item__header">
                    <?php 
                        if($icon) echo '<div class="sub-item__header_icon">' . wp_get_attachment_image($icon) . '</div>';
                        if ( $primary_link ){
                            $primary_link_url = $primary_link['url'];
                            $primary_link_title = $primary_link['title'];
                            $primary_link_target = $primary_link['target'] ? $primary_link['target'] : '_self';
                            ?> 
                                <div class="sub-item__header_link">
                                    <a href="<?php echo esc_url( $primary_link_url ); ?>" target="<?php echo esc_attr( $primary_link_target ); ?>">
                                        <?php echo esc_html($primary_link_title ); ?>
                                    </a>
                                </div>
                            <?php
                        }
                        if($description) echo '<p class="sub-item__header_description">' . $description . '</p>';
                    ?>
                </div>
                    <?php
                        if ( have_rows( 'submenu_mm' ) ){
                            echo '<ul class="sub-item__list">';
                                while ( have_rows( 'submenu_mm' ) ){ the_row();
                                    $sublink = get_sub_field( 'link_submenu_mm' );
                                    if ( $sublink ){
                                        $sublink_url = $sublink['url'];
                                        $sublink_title = $sublink['title'];
                                        $sublink_target = $sublink['target'] ? $sublink['target'] : '_self';
                                        $sublink_style = get_sub_field('style_as_a_button') ? 'btn btn-primary' : '';
                                        ?> 
                                            <li>
                                                <a class="sub-item__list_item <?php echo $sublink_style ?>" href="<?php echo esc_url( $sublink_url ); ?>" target="<?php echo esc_attr( $sublink_target ); ?>">
                                                    <?php echo esc_html( $sublink_title ); ?>
                                                </a>
                                            </li>
                                        <?php
                                    }
                                }
                            echo '</ul>';
                        }
                    ?>
            </div>
        </div>
    <?php
}
