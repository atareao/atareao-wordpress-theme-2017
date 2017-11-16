<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package atareao_201709
 */
/** Loads the WordPress Environment and tempnam(dir, prefix)plate */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
        category_menu();
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;
			/* Start the Loop */
			$index = 0;
			echo '<div class="articles">';
			while ( have_posts() ) : the_post();
				$index++;
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				if($index & 1){
					//echo '<div class=row>';
				}
				get_template_part( 'template-parts/content', get_post_format() );
				if(!($index & 1)){
					//echo '</div>';
				}
			endwhile;
			echo '</div>';
			//echo '<div class="row">';
			atareao_theme_pagination();
			//echo '</div>';
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();