<?php
/*
Plugin Name: Genesis Single Post Navigation
Plugin URI: http://genesisthemes.de/plugins/genesis-single-post-navigation/
Description: This plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style. The plugin requires the use of the Genesis Theme Framework.
Version: 1.1
Author: David Decker - DECKERWEB
Author URI: http://deckerweb.de/
*/

// Add single post navigation stylesheet
add_action( 'wp_print_styles', 'genesis_single_post_navigation_stylesheet' );
function genesis_single_post_navigation_stylesheet() {
	wp_deregister_style('genesis_single_post_navigation'); // de-register
	wp_register_style('genesis_single_post_navigation', plugins_url('/css/single-post-navigation.css', __FILE__), false, '1.1', 'screen'); // re-register
	wp_enqueue_style( 'genesis_single_post_navigation' ); // load
}

// Add single post navigation links
add_action( 'genesis_after', 'single_prev_next_links' );
function single_prev_next_links() {
	if ( is_single() ) { ?>
		<div class="gspn-area">
			<div id="gspn-prevpost">
				<?php previous_post_link( '%link', '&raquo;' ); ?>
			</div>
			<div id="gspn-nextpost">
				<?php next_post_link( '%link', '&laquo;' ); ?>
			</div>
		</div>
	<?php }
}

?>
