<?php

add_action( 'wp_head', 'add_custom_meta_desription', 4 );
function add_custom_meta_desription(){
    $post = get_post();
    $post_seo_description = get_post_meta( get_the_id(), '_yoast_wpseo_metadesc', true);
    ?>
<!-- BEGIN SEO -->
<link rel="author" href="https://plus.google.com/u/0/+LorenzoCarbonell"/>
<link rel="publisher" href="https://plus.google.com/u/0/+LorenzoCarbonell"/>
<meta name="description" content="<?php echo $post_seo_description;?>" />
<link rel="canonical" href="<?php echo get_permalink();?>" />

<meta property="og:locale" content="es_ES" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo $post->post_title;?>" />
<meta property="og:description" content="<?php echo $post_seo_description;?>" />

<meta property="og:url" content="<?php echo get_permalink();?>" />
<meta property="og:site_name" content="<?php bloginfo();?>" />
<meta property="article:publisher" content="https://www.facebook.com/elatareao" />
<meta property="article:author" content="https://www.facebook.com/elatareao" />
<meta property="fb:app_id" content="365868317587" />
<meta property="og:image" content="<?php echo get_imagen_destacada('medium');?>"/>
<meta property="og:image:secure_url" content="<?php echo get_imagen_destacada('full');?>"/>

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@atareao" />
<meta name="twitter:creator" content="@atareao" />
<meta name="twitter:domain" content="https://twitter.com/atareao" />
<meta name="twitter:title" content="<?php echo $post->post_title;?>" />
<meta name="twitter:description" content="<?php echo $post_seo_description;?>"/>
<meta name="twitter:image" content="<?php echo get_imagen_destacada('full');?>" />
<meta itemprop="image" content="<?php echo get_imagen_destacada('full');?>" />

<script type="application/ld+json">
{"@context":"<?php echo escape_for_schema('http://schema.org/');?>",
 "@type":"BlogPosting",
 "mainEntityOfPage":{"@type":"WebSite",
                     "@id":"#website",
                     "@url":"<?php echo escape_for_schema(get_site_url().'/');?>",
                     "name":"Lorenzo Carbonell",
                     "potentialAction":{ "@type":"SearchAction",
                                         "target":"<?php echo escape_for_schema(get_site_url().'/?s={search_term_string}');?>",
                                         "query-input":"required name=search_term_string"
                                       }
                    },
 "url":"<?php echo escape_for_schema(get_permalink());?>",
 "headline":"<?php echo $post->post_title;?>",
 "datePublished":"<?php echo $post->post_date;?>",
 "dateModified":"<?php echo $post->post_modified;?>",
 "publisher":{"@type":"Person",
              "name":"<?php bloginfo();?>",
              "url":"<?php echo escape_for_schema(get_site_url().'/');?>",
              "sameAs": [ "<?php echo escape_for_schema('https://twitter.com/atareao');?>",
                          "<?php echo escape_for_schema('https://www.facebook.com/elatareao');?>",
                          "<?php echo escape_for_schema('https://www.linkedin.com/in/lorenzocarbonell/');?>"],
              "image":{"@type":"ImageObject",
                    "url":"https:\/\/secure.gravatar.com\/avatar\/4bf7baee328461d0ad61a9781526d7f6?s=96&d=mm&r=g",
                    "height":96,
                    "width":96
                   }
          },
 "articleSection":"<?php echo get_the_category()[0]->name;?>",
 "description":"<?php echo $post_seo_description;?>",
 "author": {"@type": "Person",
            "name": "<?php bloginfo();?>",
            "url": "<?php echo escape_for_schema(get_site_url().'/');?>",
            "sameAs": [ "<?php echo escape_for_schema('https://twitter.com/atareao');?>",
                        "<?php echo escape_for_schema('https://www.facebook.com/elatareao');?>",
                        "<?php echo escape_for_schema('https://www.linkedin.com/in/lorenzocarbonell/');?>"],
            "image":{"@type":"ImageObject",
                     "url":"https:\/\/secure.gravatar.com\/avatar\/4bf7baee328461d0ad61a9781526d7f6?s=96&d=mm&r=g",
                     "height":96,
                     "width":96
                   }
          }
}
</script>
<!-- END SEO -->
    <?php
}

function get_imagen_destacada($size='large') {
    //$size = thumbnail | medium | large | full
    //thumbnail: si necesitamos la ruta de la miniatura
    //medium: tamaño mediano
    //large: tamaño grande
    //full: 
    global $post;
    if ( has_post_thumbnail($post->ID)) {
        $thumbID = get_post_thumbnail_id( $post->ID );
        $imgDestacada = wp_get_attachment_image_src( $thumbID, $size );
        return $imgDestacada[0]; // 0 = ruta, 1 = altura, 2 = anchura, 3 = boolean
    }else{
        $first_img = '';
        $post_content = get_post_field('post_content', $post_id);
        //$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)(-\d*x\d*)(\.[^\'"]*)[\'"].*>/i', $post_content, $matches);
        if(count($matches [1])){
            $first_img = $matches[1][0] . $matches[3][0];
            //$first_img = var_dump($matches);
            //$output = preg_match_all('/(.*)(-\d*x\d*)(\..*)/i', $first_img, $matches);
            //if(count($matches[0])){
                //$first_img = $matches[0][1].$matches[0][3];
            //}
        }
        if(strpos($first_img,'/s288/')!=FALSE){
            $first_img = str_replace('/s288/','/s100/',$first_img);
        }
        return $first_img;
    }
}

function escape_for_schema($texto){
  return str_replace('/','\/', $texto);
}

add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );
function myplugin_add_meta_box() {

    $screens = array( 'post', 'page', 'tutorial', 'capitulo', 'curso', 'leccion', 'aplicacion', 'analisis', 'podcast', 'software' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            'Opciones del artículo',
            'myplugin_meta_box_callback',
            $screen
        );
    }
}

function myplugin_meta_box_callback( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

    $post_seo_title = trim(get_the_title( $post->ID ));
    $post_seo_slug = $post->post_name;
    $post_seo_description = get_post_meta( get_the_id(), '_yoast_wpseo_metadesc', true); 

    echo '<label for="post_seo_title">';
    echo 'Título:';
    echo '</label> ';
    echo '<input type="text" id="post_seo_title" name="post_seo_title" value="' . esc_attr( $post_seo_title ) . '" size="60" />';
    echo '<div id="title_feedback"></div>';
    echo '<br/>';

    // echo '<label for="post_seo_slug">';
    // echo 'Url:';
    // echo '</label> ';
    // echo '<input type="text" id="post_seo_slug" name="post_seo_slug" value="' . esc_attr( $post_seo_slug ) . '"/>';
    // echo '<br/>';

    echo '<br/>';
    echo 'Descripción:';
    echo '<br/>';
    echo '<textarea name="post_seo_description" id="post_seo_description" rows="5" cols="50">' . esc_attr( $post_seo_description ) . '</textarea>';
    echo '<div id="description_feedback"></div>';
}

add_action( 'save_post', 'myplugin_save_meta_box_data' );
function myplugin_save_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) || 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( ! isset( $_POST['post_seo_description'] ) ) {
        return;
    }
    $post_seo_description = sanitize_text_field( $_POST['post_seo_description'] );
    update_post_meta( $post_id, '_yoast_wpseo_metadesc', $post_seo_description );
}

function sync_titles_and_slugs(){
?>  
    <script>
        jQuery(document).ready(function(){
            jQuery('#description_feedback').after('<div><span>Te quedan disponibles:</span> <input type=\'text\' value=\'0\' maxlength=\'3\' size=\'3\' id=\'excerpt_counter\' readonly=\'\' style=\'background:none;border:none;box-shadow:none;font-weight:bold; text-align:right;\'></div>');
            jQuery('#excerpt_counter').val(156-jQuery('#post_seo_description').val().length);
            jQuery('#post_seo_description').keyup( function() {
                var lo=156-jQuery('#post_seo_description').val().length;
                jQuery('#excerpt_counter').val(lo);
                if(lo<0){
                    jQuery('#excerpt_counter').css('color', 'red');
                }else{
                    jQuery('#excerpt_counter').css('color', 'black');
                }
            });
            jQuery('#title').after('<div><span>Te quedan disponibles:</span> <input type=\'text\' value=\'0\' maxlength=\'3\' size=\'3\' id=\'title_counter\' readonly=\'\' style=\'background:none;border:none;box-shadow:none;font-weight:bold; text-align:right;\'></div>');
            jQuery('#title_feedback').after('<div><span>Te quedan disponibles:</span> <input type=\'text\' value=\'0\' maxlength=\'3\' size=\'3\' id=\'title_counter2\' readonly=\'\' style=\'background:none;border:none;box-shadow:none;font-weight:bold; text-align:right;\'></div>');
            jQuery('#title_counter').val(65-jQuery('#title').val().length);
            jQuery('#title_counter2').val(65-jQuery('#title').val().length);
            jQuery('#post_seo_title').keyup( function() {
                jQuery('#title').val(jQuery('#post_seo_title').val());
                var lo=65-jQuery('#title').val().length;
                jQuery('#title_counter').val(lo);
                if(lo<0){
                    jQuery('#title_counter').css('color', 'red');
                }else{
                    jQuery('#title_counter').css('color', 'black');
                }                               
            });
            jQuery('#title').keyup( function() {
                jQuery('#post_seo_title').val(jQuery('#title').val());
                var lo=65-jQuery('#title').val().length;
                jQuery('#title_counter').val(lo);
                jQuery('#title_counter2').val(lo);
                if(lo<0){
                    jQuery('#title_counter').css('color', 'red');
                }else{
                    jQuery('#title_counter').css('color', 'black');
                }                               
            });
        });
    </script>
<?php
}
add_action( 'admin_head-post.php', 'sync_titles_and_slugs');
add_action( 'admin_head-post-new.php', 'sync_titles_and_slugs');

add_filter( 'manage_posts_columns', 'modify_post_table' );
function modify_post_table( $column ) {
    $column['post_type'] = 'Tipo de post';
    return $column;
}

add_filter( 'manage_posts_custom_column', 'modify_post_table_row', 10, 2 );
function modify_post_table_row( $column_name, $post_id ) {
    $custom_fields = get_post_custom( $post_id );
    switch ($column_name) {
        case 'post_type' :
            $data = get_post_meta( $post_id, '_yoast_wpseo_metadesc', true );
            echo '<div id="post_type-'.$post_id.'>'.$data.'</div>';
                    
            //echo '<a style="font-weight:bold;" href="<?php echo admin_url(); ?>post.php?post=<? echo get_the_ID(); ?>&action=edit"><?php echo $data; ?></a><?php
            break;
        default:
    }
}
