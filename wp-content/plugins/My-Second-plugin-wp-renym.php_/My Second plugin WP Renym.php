<?php
/*
Plugin Name: My Second plugin WP Renym
Plugin URI:  http://kaisasuurmannikt.khk.ee/wordpress
Description: This plugin is my second, what replaces words with your own choice of words. Also it adds an ending for my posts.
Version:     1.0
Author:      Kaisa Suurmann
Author URI:  http://kaisasuurmannikt.khk.ee/wordpress
License:     GP1
License URI: https://kaisasuurmannikt.khk.ee/wordpress

Copyright 2021 PLUGIN_KAISA_SUURMANN (email : kaisa.suurmann@khk.ee)
(My Second plugin WP Renym) is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
(My Second plugin WP Renym) is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with (My Second plugin WP Renym). If not, see (http://kaisasuurmannikt.khk.ee/wordpress).
*/

/*Use this function to replace a single word*/
function renym_wordpress_typo_fix( $text ) {
	return str_replace( 'wordpress', 'WordPress', $text );
}
add_filter( 'the_content', 'renym_wordpress_typo_fix' );

/*Or use this function to replace multiple words or phrases at once*/
function renym_content_replace( $content ) {
	$search  = array( 'wordpress', 'goat', 'Easter', '70', 'sensational' );
	$replace = array( 'WordPress', 'coffee', 'Easter holidays', 'seventy', 'extraordinary' );
	return str_replace( $search, $replace, $content );
}
add_filter( 'the_content', 'renym_content_replace' );

/*Use this function to add a note at the end of your content*/
function renym_content_footer_note( $content ) {
	$content .= '<footer class="renym-content-footer">Thank you for reading this tutorial. Maybe next time I will let you buy me a coffee! For more WordPress tutorials visit our <a href="http://wpexplorer.com/blog" title="WPExplorer Blog">Blog</a></footer>';
	return $content;
}
add_filter( 'the_content', 'renym_content_footer_note' );

?>