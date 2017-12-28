<?php
/*
Plugin Name: Social Menu Module
Plugin URI: http://employee451.com/
Description: This plugin adds support for social media icon menus for Employee 451 Pixelarity themes.
Author: Employee 451
Author URI: http://employee451.com/
Version: 1.0
GitHub Plugin URI: employee451/social-menu-module
*/

$social_module_enabled = true;

/* Register the Menu Location */
function social_menu_module_setup() {
  add_theme_support( 'menus' );

  register_nav_menus( array(
    'social-module'	=> __( 'Social Menu', 'social-menu-module' )
  ) );
}
add_action( 'plugins_loaded', 'social_menu_module_setup' );

/* Social Menu Walker */
class Social_Menu_Module_Walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth=0, $args=array(), $id = 0 ) {
    	$object = $item->object;
    	$type = $item->type;
    	$title = $item->title;
    	$description = $item->description;
    	$permalink = $item->url;

		$social_icons = social_menu_module_links_icons();

		$icon = '';

		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $permalink, $attr ) ) {
				$icon = $value;
			}
		}

		$output .= "<li class='" .  implode(" ", $item->classes) . "'>";

		//Add SPAN if no Permalink
		if( $permalink && $permalink != '#' ) {
			$output .= '<a href="' . $permalink . '"';
			if( $icon ) {
				$output .= ' class="icon fa-' . $icon . '"';
			}
			$output .= '>';
		} else {
			$output .= '<span>';
		}
		if( $icon ) {
			$output .= '<span class="label">' . $title . '</span>';
		}
		else {
			$output .= $title;
		}
		if( $permalink && $permalink != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}
	}
}

/* Social Medias and Their Respective Font Awesome Icon Values */
function social_menu_module_links_icons() {
	$social_links_icons = array(
		'behance.net'     => 'behance',
		'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-o',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest-p',
		'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit-alien',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	);
	return apply_filters( 'social_menu_module_links_icons', $social_links_icons );
}
