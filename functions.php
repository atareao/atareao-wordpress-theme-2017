<?php
/**
 * atareao_201709 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package atareao_201709
 */

if ( ! function_exists( 'atareao_201709_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function atareao_201709_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on atareao_201709, use a find and replace
		 * to change 'atareao_201709' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'atareao_201709', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'atareao_201709' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'atareao_201709_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'atareao_201709_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function atareao_201709_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'atareao_201709_content_width', 640 );
}
add_action( 'after_setup_theme', 'atareao_201709_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function atareao_201709_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'atareao_201709' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'atareao_201709' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'atareao_201709_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function my_init() {
    if (!is_admin()) {
        wp_deregister_script('jquery'); 
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, '3.2.1'); 
        wp_enqueue_script('jquery');
    }
}
//add_action('init', 'my_init');
function atareao_201709_scripts() {
    // CSS
	wp_enqueue_style( 'atareao_201709-style', get_stylesheet_uri() );
    // Google Fonts
    // wp_enqueue_style( 'wpb-google-fonts', 'http://fonts.googleapis.com/css?family=Roboto', false ); 
    //wp_deregister_script('jquery');
    //wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('atareao_theme_v2_atareaojs', get_template_directory_uri() . '/js/atareao.js', array('jquery'), null, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
    }
    if (is_page('donar')){
        wp_enqueue_script('blockchain', "https://blockchain.info/Resources/wallet-legacy/pay-now-button.js", array('jquery'), '201606', true );
    }
    if (is_page('radio-linux')){
        wp_enqueue_script('player', get_template_directory_uri() . '/js/player.js', array('jquery'), '201706', true );
        wp_enqueue_style('radio-style',  get_template_directory_uri() . '/radio-style.css', array(),'201706');
        wp_enqueue_style('atareao_theme_v2-awesome-font', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
    }
}
add_action( 'wp_enqueue_scripts', 'atareao_201709_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/atareao-basico.php';

require get_template_directory() . '/inc/atareao-extras.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function atareao_theme_v2_get_first_image_from_post($post_id, $width, $height) {
    if ( has_post_thumbnail($post_id)) {
        $first_img = get_the_post_thumbnail($post_id);
    }else{
        $first_img = '';
        $post_content = get_post_field('post_content', $post_id);
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
        if(count($matches [1])){
            $first_img = $matches[1][0];
        }
        if(strpos($first_img,'/s288/')!=FALSE){
            $first_img = str_replace('/s288/','/s100/',$first_img);
        }
    }
    $title = get_the_title($post_id);
    if(($first_img)and(!empty($first_img))){
        return '<img class="atareao_theme_v2-img" src="'.$first_img.'" alt="'.$title.'" title="'.$title.'"/>';
    }else{
        $first_img = get_template_directory_uri ()."/images/no_image.png";
        return '<img class="atareao_theme_v2-img" src="'.$first_img.'" alt="'.$title.'" title="'.$title.'"/>';
    }
}
function atareao_theme_v2_posted_on_sv(){
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    $time_string_publicado = sprintf( $time_string,
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date('j \d\e F \d\e Y') )
    );
    $count = atareao_theme_v2_getPostViews_short();
    if($count > 0){
        printf( __( '<span class="icono16 calendario-icon"></span>  <span class="posted-on-info">%1$s</span>  <span class="icono16 ojo-icon"></span>  <span class="posted-on-info">%2$s</span>', 'atareao_theme_v2' ),
            sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
                esc_url( get_permalink() ),
                $time_string_publicado
            ),
            sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
                esc_url( get_permalink() ),
                atareao_theme_v2_getPostViews_short()
            )
        );
    }else{
        printf( __( '<span class="icono16 calendario-icon"></span>  <span class="posted-on-info">%1$s</span>', 'atareao_theme_v2' ),
            sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
                esc_url( get_permalink() ),
                $time_string_publicado
            )
        );
    }
}
/**
 * My own pagination
 */
function atareao_theme_pagination($currentpage = '', $pages = '', $range = 2){
     $showitems = ($range * 2)+1;
     global $paged;
     if($currentpage != ''){
         $paged = $currentpage;
     }
     if(empty($paged)) $paged = 1;
     if($pages == ''){
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages){
             $pages = 1;
         }
     }
     if(1 != $pages){
         echo "<nav class='paging-navigation xs-twelve columns' role='navigation'>\n";
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."' title='Página 1'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' title='Página ".($paged - 1)."'>&lsaquo;</a>";
         for ($i=1; $i <= $pages; $i++){
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                 echo ($paged == $i)? "<span class='current'>Página ".$i." de ".$pages."</span>":"<a href='".get_pagenum_link($i)."' title='Página ".($i)."' class='inactive' >".$i."</a>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."' title='Página ".($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."' title='Página ".($pages)."'>&raquo;</a>";
         echo "</div>\n";
         echo "</nav>\n";
     }
}
add_filter( 'get_search_form', 'atareao_search_form', 100 );
function atareao_search_form( $form ) {
    $form = '<form role="search" method="get" action="' . home_url( '/' ) . '" >
    <span class="screen-reader-text" for="s">' . _x( 'Search for:', 'label' ) . '</span>
    <input type="search" class="search-icon" value="' . get_search_query() . '" name="s" placeholder='.esc_attr_x( 'Buscar …', 'placeholder' ).' title="'.esc_attr_x( 'Search for:', 'label' ).'"/>
    <input class="u-hide" type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
    </form>';
    return $form;
}
function atareao_theme_v2_getPostViews_short(){
    $postID = get_the_ID();
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        $count = 0;
    }elseif (($count > 0) &&($count < 1000000)){
        $count = round($count /1000,1).'K';
    }elseif (($count > 999999) &&($count < 1000000000)){
        $count = round($count /1000000,1).'M';
    }else{
        $count = round($count /1000000000,1).'T';
    }
    return $count;
}
function atareao_theme_v2_getPostViews(){
    $postID = get_the_ID();
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        $count = 0;
    }
    if ($count == 0){
        $count = 'Eres el <strong>primero</strong> en leer este artículo.';
    }elseif($count == 1) {
        $count = 'Eres el <strong>segundo</strong> en leer este artículo.';
    }elseif(($count > 1) &&($count < 1000)){
        $count = 'Este artículo se ha leído <strong>'.$count.'</strong> veces.';
    }elseif (($count > 999) &&($count < 1000000)){
        $count = 'Este artículo se ha leído <strong>'.round($count /1000,1).'K</strong> veces.';
    }elseif (($count > 999999) &&($count < 1000000000)){
        $count = 'Este artículo se ha leído <strong>'.round($count /1000000,1).'M</strong> veces.';
    }else{
        $count = 'Este artículo se ha leído <strong>'.round($count /1000000000,1).'T</strong> veces.';
    }
    return $count;
}
add_action('template_redirect', 'atareao_theme_v2_setPostViews');
function atareao_theme_v2_setPostViews() {
    $user = wp_get_current_user();
    $allowed_roles = array('editor', 'administrator', 'author');
    if(!array_intersect($allowed_roles, $user->roles)){
        $postID = get_the_ID();
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}
function social_media_links(){
    $url = get_permalink();
    $encode_url = urlencode($url);
    $title = esc_attr(get_the_title());
    $window = 'onclick="javascript:var left = (screen.width/2)-(600/2);var top = (screen.height/2)-(300/2);window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600,left=\'+left+\',top=\'+top+\'\');return false;"';
    $facebook_link = '<a href="https://www.facebook.com/sharer/sharer.php?u='.$encode_url.'&t='.$title.'" data-share-url="'.$url.'" '.$window.'
    target="_blank" title="Compartir en Facebook" class="circle for-social-media-link facebook-icon bgc-facebook hvr-pulse"><span class="symbol facebook-white"></span></a>';
    $twitter_link='<a href="https://twitter.com/intent/tweet/?url='.$encode_url.'&via=atareao&text='.$title.'"'.$window.'
    target="_blank" title="Compartir en Twitter" class="circle for-social-media-link twitter-icon bgc-twitter hvr-pulse"><span class="symbol twitter-white"></span></a>';
    $google_plus_link = '<a href="https://plus.google.com/share?url='.$encode_url.'"'.$window.'
    target="_blank" title="Compartir en Google+" class="circle for-social-media-link google-plus-icon bgc-google-plus hvr-pulse"><span class="symbol google-plus-white"></span></a>';
    $sml = '<div class=social-medial-links>'.$facebook_link.' '.$twitter_link.' '.$google_plus_link.'</div>'; 
    echo $sml;
}
