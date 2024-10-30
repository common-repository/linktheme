<?php
/*
Plugin Name: linktheme
Plugin URI: http://thinktag.co.uk/static/wordpress.html
Description: An easy way to host a blog theme party.  Requires free signup to the thinktag.co.uk console, available only in Canada, US, UK and EU (for the moment)
Version: 1
Author: wp-thinktag
Author URI: http://www.thinktag.co.uk
License: GPL2
*/
 
function linktheme_css() {
    wp_enqueue_style( 'linktheme_style', plugins_url( 'style.css', __FILE__ ) );  
    
}

function linktheme_script() {

    if (!is_admin()) {
	
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-widget'); 	
        wp_enqueue_script('jquery-ui-mouse'); 	
        wp_enqueue_script('jquery-ui-draggable'); 	
        wp_enqueue_script('jquery-ui-droppable'); 	
        wp_enqueue_script('jquery-ui-selectable'); 	
        wp_enqueue_script('jquery-ui-position'); 	
        wp_enqueue_script('jquery-ui-tooltip'); 	
        wp_enqueue_script('jquery-ui-resizable'); 	
        wp_enqueue_script('jquery-effects-core'); 	
        wp_enqueue_script('jquery-effects-blind'); 	
        wp_enqueue_script('jquery-effects-fade'); 	
        wp_enqueue_script('jquery-effects-fold'); 	
        wp_enqueue_script('jquery-effects-core');
        wp_enqueue_script('jquery-effects-pulsate'); 	
        wp_enqueue_script('jquery-effects-scale'); 	
        wp_enqueue_script('jquery-effects-slide'); 	
        wp_enqueue_script('jquery-effects-transfer'); 
        
        wp_enqueue_script( 'jquery_easing', plugins_url( 'jquery.easing.1.3.js', __FILE__ ), 'jquery-ui-core', '1.3', false );  
        wp_enqueue_script( 'jquery_booklet', plugins_url( 'jquery.booklet.latest.min.js', __FILE__ ), 'jquery-ui-core', '1.4.4', false );  
        
    }
}

function linktheme_shortcode( $atts ) { 
    
    extract( shortcode_atts( array( 'id' => '0', 'width' => '500', 'height' => '300' ), $atts ) );    
    $output .= '<div class="linkedTheme">';
    $output .= '</div>';
    
    $output .= '<script type="text/javascript">';
    $output .= 'jQuery(document).ready(function($) { '; 
    $output .= '	$.getJSON("//thinktag.co.uk/spring/theme/getThemeEntries/' . $id . '", function( data ) { ';
    $output .= '	   var items=""; ';
    $output .= '	   $.each( data, function( i, row) { ';
    $output .= '               items +=  "<div><a href=\'" + row.url + "\'>" + row.title + "</a><p><img src=\'"+ row.badge + "\'/></p></div>" ; ';
    $output .= '           }); ';
    $output .= '           $(".linkedTheme").html(items); ';
    $output .= '           $(".linkedTheme").booklet({ ';
    $output .= '                width: ' . $width  . ', ';
    $output .= '                height:' . $height . ' ';
    $output .= '           }); ';
    $output .= '        }); ';
    $output .= '}); '; 
    $output .= '</script>';
        
    
    return $output;    
}

      
   

add_action('wp_head', 'linktheme_css');

add_action( 'wp_enqueue_scripts', 'linktheme_script' );

add_shortcode( 'linktheme', 'linktheme_shortcode' );

?>
