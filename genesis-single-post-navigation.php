<?php
/**
 * Main plugin file. This plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style.
 * You can customize link direction and some parameters via your child theme.
 * The plugin requires the use of the Genesis Theme Framework.
 *
 * @package GenesisSinglePostNavigation
 * @author David Decker
 *
 * Plugin Name: Genesis Single Post Navigation
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/genesis-single-post-navigation/
 * Description: This plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style. You can customize link direction and some parameters via your child theme. The plugin requires the use of the Genesis Theme Framework.
 * Version: 1.4
 * Author: David Decker - DECKERWEB
 * Author URI: http://deckerweb.de/
 * License: GPLv2
 * Text Domain: gspn
 * Domain Path: /languages/
 */

/**
 * Setting constants
 *
 * @since 1.4
 */
define( 'GSPN_VERSION', '1.4' );
define( 'GSPN_PLUGIN_BASEDIR', dirname( plugin_basename( __FILE__ ) ) );


/**
 * Load the text domain for translation of the plugin
 * 
 * @since 1.2
 */
load_plugin_textdomain( 'gspn', false, GSPN_PLUGIN_BASEDIR . '/languages' );


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


add_filter( 'plugin_row_meta', 'ddw_gspn_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since 1.2
 */
function ddw_gspn_plugin_links( $gspn_links, $gspn_file ) {

	if ( !current_user_can( 'install_plugins' ) )
		return $gspn_links;

	if ( $gspn_file == GSPN_PLUGIN_BASEDIR . '/genesis-single-post-navigation.php' ) {
		$gspn_links[] = '<a href="http://wordpress.org/extend/plugins/genesis-single-post-navigation/faq/" target="_new" title="' . __( 'FAQ', 'gspn' ) . '">' . __( 'FAQ', 'gspn' ) . '</a>';
		$gspn_links[] = '<a href="http://wordpress.org/tags/genesis-single-post-navigation?forum_id=10" target="_new" title="' . __( 'Support', 'gspn' ) . '">' . __( 'Support', 'gspn' ) . '</a>';
		$gspn_links[] = '<a href="' . __( 'http://genesisthemes.de/en/donate/', 'gspn' ) . '" target="_new" title="' . __( 'Donate', 'gspn' ) . '">' . __( 'Donate', 'gspn' ) . '</a>';
	}

	return $gspn_links;
}


add_action( 'wp_enqueue_scripts', 'ddw_gspn_stylesheet' );
/**
 * Enqueue single post navigation stylesheet
 * 
 * @since 1.0
 * @version 1.3
 */
function ddw_gspn_stylesheet() {

	wp_enqueue_style( 'genesis_single_post_navigation', plugins_url( '/css/single-post-navigation.css', __FILE__ ), false, GSPN_VERSION, 'screen' );

}


/**
 * Create "previous post link" and add filters for it
 * Set default values for args - so it could be overwritten via child theme
 *
 * @since 1.4
 */
function gspn_previous_post_link() {

	$args = array (
		'format'       		=> '%link',     // Link format (default: %link)
		'link'                	=> '&raquo;',   // Link string (default: &raquo;)
		'in_same_cat'        	=> FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories' 	=> ''           // Exclude categories (default: empty)
	);

	$args = apply_filters( 'gspn_previous_link_args', $args );

	previous_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
}


/**
 * Create "next post link" and add filters for it
 * Set default values for args - so it could be overwritten via child theme
 *
 * @since 1.4
 */
function gspn_next_post_link() {

	$args = array (
		'format'       		=> '%link',     // Link format (default: %link)
		'link'                	=> '&laquo;',   // Link string (default: &laquo;)
		'in_same_cat'        	=> FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories' 	=> ''           // Exclude categories (default: empty)
	);

	$args = apply_filters( 'gspn_next_link_args', $args );

	next_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
}


add_action( 'genesis_after', 'ddw_gspn_single_prev_next_links' );
/**
 * Output single post navigation links for display
 * 1) Check for constant, on TRUE reverse link direction
 * 2) In link areas/containers check for custom filters and apply on success
 * 
 * @since 1.0
 * @version 1.1
 */
function ddw_gspn_single_prev_next_links() {

	if ( is_single() && defined( 'GSPN_REVERSE_LINK_DIRECTION' ) ) {  // Check for constant TRUE, then reverse links

		?>
		<div class="gspn-area">

			<div id="gspn-nextpost-reverse">
				<?php
					// Check for custom filters for "next post link" parameters
					if ( has_filter( 'gspn_next_post_link', 'custom_gspn_next_link' ) ) {
						custom_gspn_next_link();

					} else {  // If nothing is found apply default parameters
						gspn_next_post_link();
					}
				?>
			</div><!-- #gspn-nextpost-reverse -->

			<div id="gspn-prevpost-reverse">
				<?php
					// Check for custom filters for "previous post link" parameters
					if ( has_filter( 'gspn_previous_post_link', 'custom_gspn_previous_link' ) ) {
						custom_gspn_previous_link();

					} else {  // If nothing is found apply default parameters
						gspn_previous_post_link();
					}
				?>
			</div><!-- #gspn-prevpost-reverse -->

		</div><!-- .gspn-area -->
		<?php

	} elseif ( is_single() ) {  // Check for constant is FALSE, so DON'T reverse links (default behavior)

		?>
		<div class="gspn-area">

			<div id="gspn-prevpost">
				<?php
					// Check for custom filters for "previous post link" parameters
					if ( has_filter( 'gspn_previous_post_link', 'custom_gspn_previous_link' ) ) {
						custom_gspn_previous_link();

					} else {  // If nothing is found apply default parameters
						gspn_previous_post_link();
					}
				?>
			</div><!-- #gspn-prevpost -->

			<div id="gspn-nextpost">
				<?php
					// Check for custom filters for "next post link" parameters
					if ( has_filter( 'gspn_next_post_link', 'custom_gspn_next_link' ) ) {
						custom_gspn_next_link();

					} else {  // If nothing is found apply default parameters
						gspn_next_post_link();
					}
				?>
			</div><!-- #gspn-nextpost -->

		</div><!-- .gspn-area -->
		<?php

	}  // end elseif

}  // end of function ddw_gspn_single_prev_next_links


/**
 * This function gets the present plugin version.
 *
 * @author: PepLamb
 * @since 1.2
 */
function ddw_gspn_plugin_get_version() {
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
function ddw_gspn_plugin_get_plugin_name() {
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
function ddw_gspn_update_nag() {
    
    $slug = "genesis-single-post-navigation";
    $file = "$slug/$slug.php";
    
    if ( !function_exists( 'plugins_api' ) )
        include(ABSPATH . "wp-admin/includes/plugin-install.php");
    $info = plugins_api( 'plugin_information', array( 'slug' => $slug ) );
    
    if ( !current_user_can('update_plugins') )
        return false;
    if ( stristr( trim($info->version), trim( ddw_gspn_plugin_get_version() ) ) )
        return false;
    
    $plugin_name = ddw_gspn_plugin_get_plugin_name();
    if( function_exists( 'self_admin_url' ) ) {
        $update_url = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file, 'upgrade-plugin_' . $file);
    }
    else {// to support wp version < 3.1.0
        $update_url = wp_nonce_url( get_bloginfo( 'wpurl' )."/wp-admin/".( 'update.php?action=upgrade-plugin&plugin=' ) . $file, 'upgrade-plugin_' . $file);
    }
    
    echo '<div id="update-nag">';
    printf( __( 'Plugin <a href="http://genesisthemes.de/en/wp-plugins/genesis-single-post-navigation/" target="_new">%s v%s</a> is available! <a href="%s">You can update now</a>. <strong>Please backup and save your <em style="color: red;">existing</em> CSS customizations before!</strong><br /><em>Thanks for using that plugin! &mdash;David Decker, plugin developer</em>', 'gspn' ), $plugin_name, $info->version, $update_url );
    echo '</div><!-- #update-nag -->';
}
add_action( 'admin_notices', 'ddw_gspn_update_nag' );
