<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-areas page-section no-padding-bottom">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title entry-title">
			<?php
				$comments_number = absint(get_comments_number());
				if ( '1' === $comments_number ) {
					printf( _x( 'One Comment', 'comments title', 'tp-philosophy' ));
				} else {
					printf(
						/* translators: 1: number of comments */
						_nx(
							'%1$s Comment',
							'%1$s Comments',
							$comments_number,
							'comments title',
							'tp-philosophy'
						),
						number_format_i18n( $comments_number )
					);
				}
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tp-philosophy' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'tp-philosophy' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'tp-philosophy' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 50,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tp-philosophy' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'tp-philosophy' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'tp-philosophy' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tp-philosophy' ); ?></p>
	<?php
	endif;
	?>

</div><!-- #comments -->

<?php
/*
 * Modifying default comment form 
 *
 * @since TP Philosophy 0.1
 */

if ( ! function_exists( 'tp_philosophy_alter_comment_form_fields' ) ) {
	/**
	* Alter the comment form fields
	* @param  array Array of fields to be customized
	* @return array Array of customized fields
	*/

	function tp_philosophy_alter_comment_form_fields($fields){
		$fields['author'] = '<p class="comment-form-author">
            <input id="author" name="author" type="text" value="" placeholder="'.esc_attr__( 'Name *', 'tp-philosophy' ) .'" size="30" maxlength="245" aria-required="true" required="required">
          </p>';
		$fields['email'] 	= '<p class="comment-form-email">
            <input id="email" name="email" type="email" value="" placeholder="'.esc_attr__( 'Email *', 'tp-philosophy' ) .'" size="30" maxlength="100" aria-describedby="email-notes" aria-required="true" required="required">
          </p>';
		$fields['url'] 	= '<p class="comment-form-url">
            <input id="comment-form-url" name="comment-form-url" type="comment-form-url" value="" placeholder="'.esc_attr__( 'Website','tp-philosophy' ).'" size="30" maxlength="100" aria-describedby="email-notes">
          </p>';

		return $fields;
	}
}
add_filter('comment_form_default_fields','tp_philosophy_alter_comment_form_fields');

$args = array(
		'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title entry-title">',
		'title_reply_after' => '</h2>'
	);

comment_form( $args );