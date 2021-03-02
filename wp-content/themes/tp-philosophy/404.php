<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

get_header(); ?>
	<div class="wrapper page-section">
		<section class="error-404 not-found">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/uploads/404-300.png">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'tp-philosophy' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'tp-philosophy' ); ?></p>

				<?php
					get_search_form();
				?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</div>
<?php
get_footer();
