<?php
/**
 * Plugin Name: Fictioneer Fast Requests
 * Description: Skips plugins for faster requests.
 * Version: 1.1.0
 * Author: Tetrakern
 * Author URI: https://github.com/Tetrakern
 * Donate link: https://ko-fi.com/tetrakern
 * License: GNU General Public License v3.0 or later
 * License URI: http://www.gnu.org/licenses/gpl.html
 */

// Check if AJAX request
if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['fcn_fast_ajax'] ) ) {
  add_filter( 'option_active_plugins', 'fictioneer_exclude_plugins' );
}

$request_uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );

// Check REST Request
if ( strpos( $request_uri, 'wp-json/fictioneer/' ) !== false ) {
  add_filter( 'option_active_plugins', 'fictioneer_exclude_plugins' );
}

/**
 * Filters the list of active plugins
 *
 * @since 1.0.0
 * @since 1.1.0 - Made more generic.
 *
 * @param array $plugins  An array of active plugin paths.
 *
 * @return array Filtered array of active plugins.
 */

function fictioneer_exclude_plugins( $plugins ) {
  // Setup
  $allow_list = array(
    'advanced-database-cleaner/advanced-db-cleaner.php' // Example!
  );

  // Filter and continue
  return array_intersect( $plugins, $allow_list );
}

// Check if AJAX comment request
if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['fcn_fast_comment_ajax'] ) ) {
  add_filter( 'option_active_plugins', 'fictioneer_exclude_plugins_while_commenting' );
}

/**
 * Filters the list of active plugins when commenting
 *
 * @since 1.0.0
 *
 * @param array $plugins  An array of active plugin paths.
 *
 * @return array Filtered array of active plugins.
 */

function fictioneer_exclude_plugins_while_commenting( $plugins ) {
  // Setup
  $allow_list = array(
    'w3-total-cache/w3-total-cache.php', // W3 Total Cache
    'wp-super-cache/wp-cache.php', // WP Super Cache
    'wp-rocket/wp-rocket.php', // WP Rocket
    'litespeed-cache/litespeed-cache.php', // LiteSpeed Cache
    'wp-fastest-cache/wpFastestCache.php', // WP Fastest Cache
    'cache-enabler/cache-enabler.php', // Cache Enabler
    'hummingbird-performance/wp-hummingbird.php', // Hummingbird
    'wp-optimize/wp-optimize.php', // WP-Optimize - Clean, Compress, Cache
    'sg-cachepress/sg-cachepress.php', // SG Optimizer (SiteGround)
    'breeze/breeze.php', // Breeze (by Cloudways)
    'nitropack/nitropack.php' // NitroPack
  );

  // Filter and continue
  return array_intersect( $plugins, $allow_list );
}
