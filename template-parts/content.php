<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package atareao_201709
 */

?>
<?php 
$id = get_the_ID();
if(get_post_type()=='capitulo'){
	$parent_id = get_parent_id($id, 'tutorial');
}elseif(get_post_type()=='leccion'){
	$parent_id = get_parent_id($id, 'curso');
}elseif(get_post_type()=='analisis'){
	$parent_id = get_parent_id($id, 'aplicacion');
}
if ( is_singular() ){
	echo '<div id="article-container-alone">';
}else{
	echo '<div id="article-container">';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;?>
		<div class="entry-meta">
			<?php
			if ( is_singular() ){
				atareao_201709_posted_on();
				social_media_links();
			}else{
				atareao_theme_v2_posted_on_sv();
			}?>
		</div><!-- .entry-meta -->
		<?php
		post_badget($parent_id);

		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( is_singular() ){
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'atareao_201709' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atareao_201709' ),
				'after'  => '</div>',
			) );
		}else{
			echo atareao_theme_v2_get_first_image_from_post(get_the_ID(), 560, 560);
			echo "<div class='entry-description'><p>";
			echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ;
			echo '</p><p><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">Sigue leyendo ...</a></p>';
			echo "</div>";
		}
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php 
		if (is_singular()){
			atareao_201709_entry_footer();
		}
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
</div>
<?php 
if ( !is_singular() ){
	/*echo '</div>';*/
}
?>
