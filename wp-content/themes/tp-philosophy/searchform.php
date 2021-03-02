<?php
/**
 * The template for displaying search form
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

?>

<form action="<?php echo esc_url( home_url('/') ); ?>" role="search" method="get" class="search-form">
	<label>
		 <span class="screen-reader-text"><?php printf( esc_html__( 'Search for: %s','tp-philosophy' ), get_search_query() ); ?></span>
		<input type="search" name="s" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'tp-philosophy' ); ?>" value="<?php echo get_search_query(); ?>" >
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php esc_html_e('Search', 'tp-philosophy' ); ?></span></button>	
</form>