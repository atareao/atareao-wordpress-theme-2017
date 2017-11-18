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
	<?php wp_enqueue_script("jquery"); ?>
	<?php wp_head(); ?>
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
