<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

if ( ! function_exists( 'tp_philosophy_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function tp_philosophy_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s"><a href="%5$s">%2$s</a></time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$year = get_the_date( __( 'Y', 'tp-philosophy' ) );
		$month = get_the_date( __( 'm', 'tp-philosophy' ) );
		$day = get_the_date( __( 'd', 'tp-philosophy' ) );

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() ),
			esc_url( get_day_link( $year, $month, $day ) )
		);

		$byline = esc_html__( 'by:', 'tp-philosophy' ) . get_the_author();

		echo $time_string . ' / <span>' . esc_html( $byline ) . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'tp_philosophy_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function tp_philosophy_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'tp-philosophy' ) );
			if ( $categories_list && tp_philosophy_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'tp-philosophy' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'tp-philosophy' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'tp-philosophy' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( esc_html__( 'Leave a Comment', 'tp-philosophy' ). '<span class="screen-reader-text"> '. esc_html__( 'on', 'tp-philosophy' ) .' %s</span>', array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'tp-philosophy' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

add_action( 'philosphy_pro_entry_footer', 'tp_philosophy_entry_footer' );

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function tp_philosophy_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'tp_philosophy_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'tp_philosophy_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so tp_philosophy_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so tp_philosophy_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in tp_philosophy_categorized_blog.
 */
function tp_philosophy_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'tp_philosophy_categories' );
}
add_action( 'edit_category', 'tp_philosophy_category_transient_flusher' );
add_action( 'save_post',     'tp_philosophy_category_transient_flusher' );
