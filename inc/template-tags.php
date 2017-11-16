<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package atareao_201709
 */

if ( ! function_exists( 'atareao_201709_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function atareao_201709_posted_on() {
	    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	    $time_string_publicado = sprintf( $time_string,
	        esc_attr( get_the_date( 'c' ) ),
	        esc_html( get_the_date('l\, j \d\e F \d\e Y') )
	    );
	    if (strtotime(get_the_modified_date('Y-m-d')) > strtotime(get_the_date('Y-m-d'))){
	        $time_string_actualizado = sprintf( $time_string,
	            esc_attr( get_the_modified_date( 'c' ) ),
	            esc_html( get_the_modified_date('l\, j \d\e F \d\e Y') )
	        );
	        printf( __( '<i><span class="posted-on">Publicado el %1$s. </span><strong><span class="posted-on">Actualizado el %2$s</span></strong><span class="byline"> por %3$s</span>. %4$s</i>', 'atareao_theme_v2' ),
	            sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
	                esc_url( get_permalink() ),
	                $time_string_publicado
	            ),
	            sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
	                esc_url( get_permalink() ),
	                $time_string_actualizado
	            ),
	            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
	                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	                esc_html( get_the_author() )
	            ),
	            atareao_theme_v2_getPostViews()
	        );

	    }else{
	        printf( __( '<i><span class="posted-on">Publicado el %1$s</span><span class="byline"> por %2$s</span>. %3$s</i>', 'atareao_theme_v2' ),
	            sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
	                esc_url( get_permalink() ),
	                $time_string_publicado
	            ),
	            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
	                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	                esc_html( get_the_author() )
	            ),
	            atareao_theme_v2_getPostViews()
	        );
	    }
	    if ( is_single() ) {
	        echo ' <a href="'.get_the_permalink().'#disqus_thread">Deja un comentario</a>';
	        if (time() - max(strtotime(get_the_date('Y-m-d')), strtotime(get_the_modified_date('Y-m-d'))) > (365 * 24 * 3600)) {
				echo "<div class='information danger'><p><span class='icono24 atencion'></span>Este artículo se publicó hace <strong>mas de un año</strong>. Ten en cuenta que con las nuevas versiones y las actualizaciones constantes de software, es fácil, que este <strong>artículo</strong> esté <strong>desactualizado</strong>. Si estás interesado en que lo <strong>actualice</strong>, envíame un correo a través del <a href=''>formulario de contacto</a>.</p></div>";
	    	}
	    }
	}
endif;

if ( ! function_exists( 'atareao_201709_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function atareao_201709_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'atareao_201709' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'atareao_201709' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'atareao_201709' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'atareao_201709' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'atareao_201709' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'atareao_201709' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
