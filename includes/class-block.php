<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Domain_Search_Block {
    public static function init() {
        add_action( 'init', [ __CLASS__, 'register_block' ] );
    }

    public static function register_block() {
        register_block_type( DOMAIN_SEARCH_PLUGIN_DIR . 'build' );
    }
}

Domain_Search_Block::init();