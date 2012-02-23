<?php

/*
* Plugin Name: JSON only
* Author: Russell Fair
* Version: 0.0.1
	plugin uri: http://q21.co/json-only
	description: a simple plugin that will return a JSON object of the requested post. Includes title, content and meta
	author uri: http://q21.co
*/


add_action('template_redirect' , 'jsonrequest_template_redirect');
function jsonrequest_template_redirect() {
    global $query_string, $post;
    $post_id = $post->ID;
    if(isset($_REQUEST['json'])) :  
        if( have_posts() ) : 
            while( have_posts() ) : the_post();
                $output[]= array( 'title' => get_the_title(), 'content' => esc_html( get_the_content() ), 'meta' => get_post_custom() );
            endwhile;
        endif; 
        die ( json_encode( $output ) ); 
    else: return;
    endif;
} // end template_redirect
