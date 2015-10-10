<?php
/*
Plugin Name: Mimeo Shortcode
Plugin URI: http://www.kmhcreative.com/labs/mimeo
Description: A WordPress plugin that lets you use a shortcode to mirror the content of one page into another.
Version: 0.1
Author: K.M. Hansen
Author URI: http://www.kmhcreative.com
License: GPLv3
*/

/*  Copyright 2012-2014  K.M. Hansen  (email : software@kmhcreative.com)

	This allows you to mirror the content of one page into another by page_id.
	
	Why?  So a page can effectively have two "parents" and therefore be found under
	any of the parents but you still only have ONE page to maintain.

    Usage: [mimeo id="8" title="true"]
    Where "8" is the page id to mirror, title optional (true = mirror title into new page)
*/

function get_post_page_content( $atts ) {
			extract( shortcode_atts( array(
				'id' => null,
				'title' => false,
			), $atts ) );
	ob_start();
			$the_query = new WP_Query( 'page_id='.$id );
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
			        if($title == true){
			        the_title();
			        }
			        the_content();
			}
			wp_reset_postdata();
	$page = ob_get_contents();
	ob_end_clean();
	return $page;
}
add_shortcode( 'mimeo', 'get_post_page_content', 99 );
	
?>