<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package atareao_201709
 */

get_header(); ?>
	<div id="primary" class="content-area twelve lg-nine columns">
		<main id="main" class="site-main">
			<div class="mainbox">
                <section class="error-404 not-found">
                    <div class="page-content">
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div>
        </main><!-- #main -->
    </div><!-- content-area-wrapper-->
<?php
get_sidebar();
get_footer();