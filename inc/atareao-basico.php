<?php

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

add_filter( 'emoji_svg_url', '__return_false' );

function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) ){
        $src = remove_query_arg( 'ver', $src );
    }elseif (strpos($src,'&#038;ver=')) {
        $src = split('&#038;ver=',$src)[0];
    }elseif (strpos($src,'&ver=')) {
        $src = split('&ver=',$src)[0];
    }
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

/**
 * Remove jQuery migrate script
 */
add_filter( 'wp_default_scripts', 'barrjoneslegal_remove_jquery_migrate' );
function barrjoneslegal_remove_jquery_migrate( &$scripts ) {
  if ( ! is_admin() ) :
    $scripts->remove( 'jquery' );
    $scripts->add( 'jquery', false, array( 'jquery-core' ), false );
  endif;
}

add_action('init', 'disable_embeds_init', 9999);
function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('after_setup_theme', 'atareao_theme_v2_footer_enqueue_scripts');
function atareao_theme_v2_footer_enqueue_scripts() {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}
/**/
add_action( 'send_headers', 'atareao_theme_v2_add_header_seguridad' );
function atareao_theme_v2_add_header_seguridad() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1;mode=block' );
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
function add_async_attribute($tag) {
    $scripts_to_defer = array('jquery.min.js', 'atareao.js', 'count.js', 'jquery.playlist.js');
    foreach($scripts_to_defer as $defer_script){
        if(true == strpos($tag, $defer_script ) )
            return str_replace( ' src', ' async="async" src', $tag );
    }
    return $tag;
}

/**
 * Insert highslide
 */
 /*
 add_filter('wp_get_attachment_link', 'rc_add_rel_attribute');
function rc_add_rel_attribute($link) {
    global $post;
    return str_replace('<a href', '<a class="highslide" href', $link);
}
* */
/**
 * Attach a class to linked images' parent anchors
 * e.g. a img => a.img img
 */
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ) {
  // Separate classes with spaces, e.g. 'img image-link'
  $classes_for_a = 'highslide';
  // check if there are already classes assigned to the anchor
  if ( preg_match('/<a.*? class=".*?">/', $html) ) {
    $html = preg_replace('/(<a.*? class=".*?)(".\?>)/', '$1 ' . $classes_for_a . '$2', $html);    
  }
  else {
    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes_for_a . '" >', $html);
  }
  /*
  $classes_for_i = 'aligncenter';
  if ( preg_match('/<img.*? class=".*?"/', $html) ) {
    $html = preg_replace('/(<img.*? class=".*?)(".*\/>)/', '$1 ' . $classes_for_i . '$2', $html);
  }
  else {
    $html = preg_replace('/(<img.*?)>/', '$1 class="' . $classes_for_i . '" />', $html);
  }
  */ 
  return $html;
}

add_filter('image_send_to_editor', 'give_linked_images_class', 10, 8);

