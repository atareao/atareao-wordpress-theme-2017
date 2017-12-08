<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package atareao_201709
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php
	$description = '';
	if (is_page('inicio')){
		$description = 'Linux para legos.';
	}
	if ($description != ''){
		echo '<meta name="description" content="'.$description.'"/>
	<meta property="og:description" content="'.$description.'"/>
	<meta name="twitter:description" content="'.$description.'"/>';
	}
	?>
	<?php wp_head(); ?>
<?php if ( ! is_user_logged_in () ) { ?>
<!-- Google Analytics On. -->
<script type="text/javascript">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

	__gaTracker('create', 'UA-11534648-1', 'auto');
	__gaTracker('set', 'forceSSL', true);
	__gaTracker('require', 'displayfeatures');
	__gaTracker('require', 'linkid', 'linkid.js');
	__gaTracker('send','pageview');

</script>
<?php } else {
echo '<!-- Google Analytics Off. -->';
}?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead">
		<div id="header-content">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<div class="logo"></div>
					<div class="site-data">
						<h1 class="site-title for-desktop"><?php echo get_bloginfo( 'title', 'display'); ?></h1>
						<p class="site-description for-desktop"><?php echo get_bloginfo( 'description', 'display'); ?></p>
					</div>
				</a>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'      => 'navbar-list',
					) );
				?>
			</nav><!-- #site-navigation -->
		</div><!--.header-content-->
	</header><!-- #masthead -->
	<div id="main-content">
		<div id="main-content-content">
