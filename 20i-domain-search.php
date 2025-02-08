<?php
/**
 * Plugin Name:       20i Domain Search
 * Plugin URI:        https://example.com
 * Description:       Plugin for searching available domains using 20i API.
 * Version:           1.0.0
 * Author:            Lukas Pivonka
 * Author URI:        https://example.com
 * License:           GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Zabrání přímému přístupu k souboru.
}

// Definujeme cestu k pluginu
define( 'DOMAIN_SEARCH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
// Načtení hlavního souboru pluginu při aktivaci pluginu
require_once DOMAIN_SEARCH_PLUGIN_DIR . 'includes/class-block.php';
require_once DOMAIN_SEARCH_PLUGIN_DIR . 'includes/class-rest-api.php';

// Funkce pro inicializaci pluginu
function domain_search_init() {
    error_log( '20i Domain Search plugin aktivován!' );
}
add_action( 'init', 'domain_search_init' );