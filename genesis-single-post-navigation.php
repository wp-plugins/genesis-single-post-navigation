<?php
/**
 * Main plugin file. This plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style.
 * The plugin requires the use of the Genesis Theme Framework.
 *
 * @package GenesisSinglePostNavigation
 * @author David Decker
 *
 * Plugin Name: Genesis Single Post Navigation
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/genesis-single-post-navigation/
 * Description: This plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style. The plugin requires the use of the Genesis Theme Framework.
 * Version: 1.3
 * Author: David Decker - DECKERWEB
 * Author URI: http://deckerweb.de/
 * License: GPLv2
 * Text Domain: gspn
 * Domain Path: /languages/
 */

/**
 * Load the text domain for translation of the plugin
 * 
 * @since 1.2
 */
load_plugin_textdomain( 'gspn', false, 'genesis-single-post-navigation/languages' );

register_activation_hook( __FILE__, 'gspn_activation_check' );

/**
 * Checks for activated Genesis Framework and its minimum version before allowing plugin to activate
 *
 * @author Nathan Rice
 * @uses gspn_truncate()
 * @since 1.2
 * @version 0.2
 */
function gspn_activation_check() {

    $latest = '1.7';

    $theme_info = get_theme_data( get_template_directory() . '/style.css' );

    if ( basename( get_template_directory() ) != 'genesis' ) {
        deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate ourself
        wp_die( sprintf( __( 'Sorry, you can&rsquo;t activate unless you have installed the %1$sGenesis Framework%2$s', 'gspn' ), '<a href="http://deckerweb.de/go/genesis/" target="_new">', '</a>' ) );
    }

    $version = gspn_truncate( $theme_info['Version'], 3 );

    if ( version_compare( $version, $latest, '<' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate ourself
        wp_die( sprintf( __( 'Sorry, you can&rsquo;t activate without %1$sGenesis Framework %2$s%3$s or greater', 'gspn' ), '<a href="http://deckerweb.de/go/genesis/" target="_new">', $latest, '</a>' ) );
    }
}

/**
 * Used to cutoff a string to a set length if it exceeds the specified length
 *
 * @author Nick Croft
 * @since 1.2
 * @version 0.2
 * @param string $str Any string that might need to be shortened
 * @param string $length Any whole integer
 * @return string
 */
function gspn_truncate( $str, $length=10 ) {

    if ( strlen( $str ) > $length ) {
        return substr( $str, 0, $length );
    } else {
        $res = $str;
    }

    return $res;
}

add_action( 'wp_enqueue_scripts', 'genesis_single_post_navigation_stylesheet' );
/**
 * Enqueue single post navigation stylesheet
 * 
 * @since 1.0
 * @version 1.1
 */
function genesis_single_post_navigation_stylesheet() {

	wp_enqueue_style( 'genesis_single_post_navigation', plugins_url( '/css/single-post-navigation.css', __FILE__ ), false, '1.3', 'screen' );

}

add_action( 'genesis_after', 'single_prev_next_links' );
/**
 * Add single post navigation links
 * 
 * @since 1.0
 */
function single_prev_next_links() {

	if ( is_single() ) { ?>

		<div class="gspn-area">

			<div id="gspn-prevpost">
				<?php previous_post_link( '%link', '&raquo;' ); ?>
			</div><!-- .gspn-prevpost -->

			<div id="gspn-nextpost">
				<?php next_post_link( '%link', '&laquo;' ); ?>
			</div><!-- .gspn-nextpost -->

		</div><!-- .gspn-area -->

	<?php }

}

/**
 * This function gets the present plugin version.
 *
 * @author: PepLamb
 * @since 1.2
 */
function gspn_plugin_get_version() {
    if ( !function_exists( 'get_plugins' ) )
       require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
    $plugin_file = basename( ( __FILE__ ) );
    return $plugin_folder[$plugin_file]['Version'];
}

/**
 * This function gets the plugin name.
 *
 * @author: PepLamb
 * @since 1.2
 */
function gspn_plugin_get_plugin_name() {
    if ( !function_exists( 'get_plugins' ) )
       require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
    $plugin_file = basename( ( __FILE__ ) );
    return $plugin_folder[$plugin_file]['Name'];
}

/**
 * This function displays the update nag at the top of the
 * dashboard if there is a plugin update available.
 *
 * @author: PepLamb
 * @since 1.2
 */
function gspn_update_nag() {
    
    $slug = "genesis-single-post-navigation";
    $file = "$slug/$slug.php";
    
    if ( !function_exists( 'plugins_api' ) )
        include(ABSPATH . "wp-admin/includes/plugin-install.php");
    $info = plugins_api( 'plugin_information', array( 'slug' => $slug ) );
    
    if ( !current_user_can('update_plugins') )
        return false;
    if ( stristr( trim($info->version), trim( gspn_plugin_get_version() ) ) )
        return false;
    
    $plugin_name = gspn_plugin_get_plugin_name();
    if( function_exists( 'self_admin_url' ) ) {
        $update_url = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file, 'upgrade-plugin_' . $file);
    }
    else {// to support wp version < 3.1.0
        $update_url = wp_nonce_url( get_bloginfo( 'wpurl' )."/wp-admin/".( 'update.php?action=upgrade-plugin&plugin=' ) . $file, 'upgrade-plugin_' . $file);
    }
    
    echo '<div id="update-nag">';
    printf( __( 'Plugin <a href="http://genesisthemes.de/en/wp-plugins/genesis-single-post-navigation/" target="_new">%s v%s</a> is available! <a href="%s">You can update now</a>. <strong>Please backup and safe your <em style="color: red;">existing</em> CSS customizations before!</strong><br /><em>Thanks for using that plugin! &mdash;David Decker, plugin developer</em>', 'gspn' ), $plugin_name, $info->version, $update_url );
    echo '</div><!-- #update-nag -->';
}
add_action( 'admin_notices', 'gspn_update_nag' );
