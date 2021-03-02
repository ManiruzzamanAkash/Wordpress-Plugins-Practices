<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

$options = tp_philosophy_get_theme_options();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		$thumbnail_image_src = tp_philosophy_get_thumbnail_source();

		$thumbnail_inline_style = '';
		
		if( !empty( $thumbnail_image_src ) ){

			$thumbnail_inline_style = 'style="background-image: url('. esc_url( $thumbnail_image_src ) .')"';
		}
	?>
    <div class="featured-image" <?php echo $thumbnail_inline_style; ?>>
        <div class="blue-overlay"></div>
      	<div class="hover-content">
        	<a href="<?php the_permalink(); ?>" class="view-more"><span data-hover="<?php echo esc_attr( $options['read_more_text'] ); ?>"><?php echo esc_html( $options['read_more_text'] ); ?></span></a>
      	</div><!--.hover-content-->
    </div><!--.featured-image-->

    <div class="blog-wrapper">
      	<div class="blog-content">
	      	<?php 
		      	if ( is_single() ) :
					the_title( '<h4 class="entry-title">', '</h4>' );
				else :
					the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
				endif;
			?>
        	<div class="seperator"></div>
        	<p><?php the_excerpt(); ?></p>
      	</div><!--.blog-content-->
        <?php if ( 'post' === get_post_type() ) : ?>
          	<div class="article-entry-meta">
            	<?php tp_philosophy_posted_on(); ?>
          	</div><!--article / entry-meta-->
        <?php endif; ?>
    </div><!--.blog-wrapper-->
</article><!--#post-1-->